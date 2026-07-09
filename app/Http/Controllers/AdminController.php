<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\TempPayment;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\ProductApprovedMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * ==========================================================
     *  DASHBOARD
     * ==========================================================
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),

            'pending_users' => User::where('role', 'user')
                ->where('status', 'pending')
                ->count(),

            'approved_users' => User::where('role', 'user')
                ->where('status', 'approved')
                ->count(),

            'rejected_users' => User::where('role', 'user')
                ->where('status', 'reject')
                ->count(),

            'blocked_users' => User::where('role', 'user')
                ->where('status', 'blocked')
                ->count(),


            'pending_payments'   => TempPayment::count(),
            'success_payments'   => Payment::where('status', 'success')->count(),
            'revenue'            => Payment::where('status', 'success')->sum('amount'),

            'purchased_total'    => PurchasedProduct::count(),
            'purchased_pending'  => PurchasedProduct::where('is_approved', false)->count(),
            'purchased_approved' => PurchasedProduct::where('is_approved', true)->count(),
        ];

        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
        $recentPayments = Payment::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPayments'));
    }

    /**
     * ==========================================================
     *  USERS
     * ==========================================================
     */
    public function users(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = User::query()
            ->where('role', 'user')
            ->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('mobile', 'like', "%{$term}%")
                    ->orWhere('city', 'like', "%{$term}%");
            });
        }

        $users = $query->paginate(5)->withQueryString();

        return view('admin.users.index', compact('users', 'status'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->status_updated_at = now();
        $user->admin_remark = null;
        $user->save();

        Log::info('Admin approved user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return back()->with('success', "User '{$user->name}' has been approved.");
    }

    public function rejectUser(Request $request, $id)
    {
        $request->validate([
            'remark' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->status_updated_at = now();
        $user->admin_remark = $request->remark;
        $user->save();

        Log::info('Admin rejected user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return back()->with('success', "User '{$user->name}' has been rejected.");
    }

    public function blockUser(Request $request, $id)
    {
        $request->validate([
            'remark' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::findOrFail($id);
        $user->status = 'blocked';
        $user->status_updated_at = now();
        if ($request->filled('remark')) {
            $user->admin_remark = $request->remark;
        }
        $user->save();

        Log::info('Admin blocked user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return back()->with('success', "User '{$user->name}' has been blocked.");
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->status_updated_at = now();
        $user->save();

        Log::info('Admin unblocked user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return back()->with('success', "User '{$user->name}' has been unblocked.");
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'min:3', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'state'    => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'tehsil'   => ['required', 'string', 'max:100'],
            'city'     => ['required', 'string', 'max:100'],
            'pincode'  => ['required', 'digits:6'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        // mobile intentionally excluded - never mass assigned here
        $user->fill($data);
        $user->save();

        Log::info('Admin updated user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return redirect()->route('admin.users')->with('success', "User '{$user->name}' updated successfully.");
    }

    /**
     * ==========================================================
     *  PAYMENTS  (temp_payments + payments)
     * ==========================================================
     */
    public function payments(Request $request)
    {
        $tab = $request->query('tab', 'pending');

        $tempPayments = TempPayment::latest()->paginate(5, ['*'], 'temp_page');
        // dd($tempPayments);


        return view('admin.payments.index', compact('tempPayments', 'tab'));
    }

    public function successPayments()
    {
        $successPayments = Payment::where('status', 'success')->latest()->paginate(5, ['*'], 'success_page');
        return view('admin.payments.success', compact('successPayments'));
    }

    /**
     * Approve a pending/initiated temp payment: moves it into the
     * permanent `payments` table (and creates the matching
     * purchased_products row) using the exact same logic the payment
     * gateway webhook uses, then removes it from temp_payments.
     */
    public function approveTempPayment($id)
    {
        $tempPayment = TempPayment::findOrFail($id);

        $paymentController = new PaymentController();
        $paymentController->adminApprove($tempPayment);

        Log::info('Admin manually approved temp payment', [
            'txn_ref' => $tempPayment->txn_ref,
            'admin_id' => Auth::id(),
        ]);

        return back()->with('success', "Payment '{$tempPayment->txn_ref}' approved and moved to successful payments.");
    }

    public function deleteTempPayment($id)
    {
        $tempPayment = TempPayment::findOrFail($id);
        $ref = $tempPayment->txn_ref;
        $tempPayment->delete();

        Log::info('Admin deleted temp payment', ['txn_ref' => $ref, 'admin_id' => Auth::id()]);

        return back()->with('success', "Temp payment '{$ref}' removed.");
    }

    /**
     * ==========================================================
     *  PURCHASED PRODUCTS
     * ==========================================================
     */
    public function purchasedProducts(Request $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = PurchasedProduct::with('user')->latest();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                ->orWhere('product_type', 'like', "%{$search}%")
                ->orWhere('txn_ref', 'like', "%{$search}%")
                ->orWhere('tracking_id', 'like', "%{$search}%")
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%");
                });
            });
        }

        $products = $query->paginate(5)->withQueryString();

        return view('admin.purchased-products.index', compact('products', 'status', 'search'));
    }

    public function approvePurchasedProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tracking_id' => ['required', 'string', 'max:100'],
            'remark'      => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $product = PurchasedProduct::findOrFail($id);
        $product->tracking_id = $request->tracking_id;
        $product->remark = $request->remark;
        $product->is_approved = true;
        $product->approved_at = now();
        $product->approved_by = Auth::id();
        $product->save();

        // Send email notification
        try {
            // Assuming the product has a user relationship
            // If you have a user_id field in PurchasedProduct
            if ($product->user && $product->user->email) {
                Mail::to($product->user->email)->send(new ProductApprovedMail($product));
                
                Log::info('Product approval email sent', [
                    'purchased_product_id' => $product->id,
                    'email' => $product->user->email,
                    'tracking_id' => $product->tracking_id,
                ]);
            } else {
                // If no user relationship, you might want to send to a default email
                // or log a warning
                Log::warning('No email found for product approval notification', [
                    'purchased_product_id' => $product->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send product approval email', [
                'purchased_product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
            // Continue with the process even if email fails
        }

        Log::info('Admin approved purchased product', [
            'purchased_product_id' => $product->id,
            'tracking_id' => $product->tracking_id,
            'admin_id' => Auth::id(),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchased product approved successfully.',
                'product' => $product,
            ]);
        }

        return back()->with('success', "Purchased product #{$product->id} approved with tracking ID {$product->tracking_id}.");
    }
}