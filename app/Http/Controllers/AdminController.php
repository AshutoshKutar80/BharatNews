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
use App\Mail\UserApprovedMail;
use App\Mail\UserRejectedMail;
use App\Mail\UserBlockedMail;
use App\Mail\UserUnblockedMail;
use App\Models\State;
use App\Models\TehsilList;

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

    public function approveUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $admin = Auth::user();

            // Check if remark is provided via AJAX
            if ($request->has('admin_remark')) {
                $user->admin_remark = $request->admin_remark;
            }

            $user->status = 'approved';
            $user->status_updated_at = now();
            $user->save();

            // Send email notification
            try {
                Mail::to($user->email)->send(new UserApprovedMail($user, $admin));
                Log::info('Approval email sent to user', ['user_id' => $user->id, 'email' => $user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send approval email', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            }

            Log::info('Admin approved user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

            // Check if AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "User '{$user->name}' has been approved.",
                    'new_status' => 'approved',
                    'user' => $user
                ]);
            }

            return back()->with('success', "User '{$user->name}' has been approved.");
        } catch (\Exception $e) {
            Log::error('Error approving user', ['user_id' => $id, 'error' => $e->getMessage()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to approve user: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to approve user.');
        }
    }

    public function rejectUser(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'admin_remark' => ['nullable', 'string', 'max:500'],
            ]);

            $user = User::findOrFail($id);
            $admin = Auth::user();

            $user->status = 'rejected';
            $user->status_updated_at = now();
            if ($request->has('admin_remark') && !empty($request->admin_remark)) {
                $user->admin_remark = $request->admin_remark;
            }
            $user->save();

            // Send email notification
            try {
                Mail::to($user->email)->send(new UserRejectedMail($user, $admin, $request->admin_remark));
                Log::info('Rejection email sent to user', ['user_id' => $user->id, 'email' => $user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send rejection email', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            }

            Log::info('Admin rejected user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "User '{$user->name}' has been rejected.",
                    'new_status' => 'rejected',
                    'user' => $user
                ]);
            }

            return back()->with('success', "User '{$user->name}' has been rejected.");
        } catch (\Exception $e) {
            Log::error('Error rejecting user', ['user_id' => $id, 'error' => $e->getMessage()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to reject user: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to reject user.');
        }
    }

    public function blockUser(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'admin_remark' => ['nullable', 'string', 'max:500'],
            ]);

            $user = User::findOrFail($id);
            $admin = Auth::user();

            $user->status = 'blocked';
            $user->status_updated_at = now();
            if ($request->has('admin_remark') && !empty($request->admin_remark)) {
                $user->admin_remark = $request->admin_remark;
            }
            $user->save();

            // Send email notification
            try {
                Mail::to($user->email)->send(new UserBlockedMail($user, $admin, $request->admin_remark));
                Log::info('Block email sent to user', ['user_id' => $user->id, 'email' => $user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send block email', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            }

            Log::info('Admin blocked user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "User '{$user->name}' has been blocked.",
                    'new_status' => 'blocked',
                    'user' => $user
                ]);
            }

            return back()->with('success', "User '{$user->name}' has been blocked.");
        } catch (\Exception $e) {
            Log::error('Error blocking user', ['user_id' => $id, 'error' => $e->getMessage()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to block user: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to block user.');
        }
    }

    public function unblockUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $admin = Auth::user();

            $user->status = 'approved';
            $user->status_updated_at = now();
            $user->admin_remark = null;
            $user->save();

            try {
                Mail::to($user->email)->send(new UserUnblockedMail($user, $admin));
                Log::info('Unblock email sent to user', ['user_id' => $user->id, 'email' => $user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send unblock email', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            }

            Log::info('Admin unblocked user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "User '{$user->name}' has been unblocked.",
                    'new_status' => 'approved',
                    'user' => $user
                ]);
            }

            return back()->with('success', "User '{$user->name}' has been unblocked.");
        } catch (\Exception $e) {
            Log::error('Error unblocking user', ['user_id' => $id, 'error' => $e->getMessage()]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to unblock user: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to unblock user.');
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        $states = State::select('states')
            ->distinct()
            ->where('status', 1)
            ->orderBy('states')
            ->pluck('states');

        $districts = State::where('states', $user->state)
            ->where('status', 1)
            ->orderBy('district')
            ->pluck('district');

        $stateDistrict = State::where('district', $user->district)
            ->where('status', 1)
            ->first();

        $tehsils = [];
        if ($stateDistrict) {
            $tehsils = TehsilList::where('disid', $stateDistrict->id)
                ->orderBy('tehsil')
                ->pluck('tehsil');
        }

        return view('admin.users.edit', compact('user', 'states', 'districts', 'tehsils'));
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
        $user->fill($data);
        $user->save();

        Log::info('Admin updated user', ['user_id' => $user->id, 'admin_id' => Auth::id()]);

        return redirect()->route('admin.users')->with('success', "User '{$user->name}' updated successfully.");
    }


    /**
     * Get districts for a given state
     */
    public function getDistricts($state)
    {
        $districts = State::where('states', $state)
            ->where('status', 1)
            ->orderBy('district')
            ->pluck('district');

        return response()->json([
            'districts' => $districts
        ]);
    }

    /**
     * Get tehsils for a given district
     */
    public function getTehsils($district)
    {
        $stateDistrict = State::where('district', $district)
            ->where('status', 1)
            ->first();

        if (!$stateDistrict) {
            return response()->json(['tehsils' => []]);
        }

        $tehsils = TehsilList::where('disid', $stateDistrict->id)
            ->orderBy('tehsil')
            ->pluck('tehsil');

        return response()->json([
            'tehsils' => $tehsils
        ]);
    }

    // temp_payments
    public function payments(Request $request)
    {
        $tab = $request->query('tab', 'pending');
        $search = $request->query('search');

        $tempPayments = TempPayment::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                    ->orWhere('user_email', 'like', "%{$search}%")
                    ->orWhere('txn_ref', 'like', "%{$search}%")
                    ->orWhere('product_type', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(5, ['*'], 'temp_page')
            ->appends(['search' => $search, 'tab' => $tab]);

        return view('admin.payments.index', compact('tempPayments', 'tab', 'search'));
    }

    //success_payment
    public function successPayments(Request $request)
    {
        $search = $request->query('search');

        $successPayments = Payment::where('status', 'success')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('user_name', 'like', "%{$search}%")
                        ->orWhere('user_email', 'like', "%{$search}%")
                        ->orWhere('txn_ref', 'like', "%{$search}%")
                        ->orWhere('order_id', 'like', "%{$search}%")
                        ->orWhere('product_type', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5, ['*'], 'success_page')
            ->appends(['search' => $search]);

        return view('admin.payments.success', compact('successPayments', 'search'));
    }

    public function approveTempPayment($id)
    {
        $tempPayment = TempPayment::findOrFail($id);

        $paymentController = new PaymentController();
        $result = $paymentController->adminApprove($tempPayment);

        return $result['success']
            ? back()->with('success', $result['message'])
            : back()->with('error', $result['message']);
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

        try {
            if ($product->user && $product->user->email) {
                Mail::to($product->user->email)->send(new ProductApprovedMail($product));

                Log::info('Product approval email sent', [
                    'purchased_product_id' => $product->id,
                    'email' => $product->user->email,
                    'tracking_id' => $product->tracking_id,
                ]);
            } else {
                Log::warning('No email found for product approval notification', [
                    'purchased_product_id' => $product->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send product approval email', [
                'purchased_product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
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
