<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\TehsilList; // Changed to TehsilList
use App\Models\Contact;
use App\Models\Payment;
use App\Models\TempPayment;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function register()
    {
        $states = State::select('states')
            ->distinct()
            ->where('status', 1)
            ->orderBy('states')
            ->pluck('states');

        return view('user.register', compact('states'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required', 'string', 'min:3', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email'],
            'mobile'       => ['required', 'nullable', 'digits:10'],
            'password'     => ['required', 'string', 'min:6', 'confirmed'],
            'state'        => ['required', 'string', 'max:100'],
            'district'     => ['required', 'string', 'max:100'],
            'tehsil'       => ['required', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:100'],
            'pincode'      => ['required', 'digits:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['password'] = $data['password'];
        $data['status'] = 'pending';
        $data['created_at'] = now();
        $data['updated_at'] = now();
        User::create($data);

        return response()->json([
            'message'  => 'Registration submitted successfully.',
        ], 201);
    }

    public function showLoginForm()
    {
        return view('user.login');
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'digits:10'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Mobile number is required',
            'login.digits' => 'Enter a valid 10-digit mobile number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $mobile = preg_replace('/\D/', '', $request->input('login'));

        $user = User::where('mobile', $mobile)->first();

        if ($user && $user->password === $request->password) {

            Auth::login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            $redirect = match ($user->role) {
                'admin' => route('admin.dashboard'),
                default => route('dashboard'),
            };

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => $redirect,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid mobile number or password. Please try again.'
        ], 401);
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Generate a unique tracking / reference code, e.g. BIF-7K3F9QZ1
     */
    protected function generateTrackingCode(): string
    {
        do {
            $code = 'BIF-' . strtoupper(Str::random(8));
        } while (User::where('tracking', $code)->exists());

        return $code;
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

    /* =====================================================
     |  READ-ONLY PROFILE / CONTACTS / PAYMENTS / PRODUCTS
     |  These pages only ever DISPLAY data for the logged in
     |  user. No update/delete actions are exposed here.
     |===================================================== */

    /**
     * Read-only profile page for the logged in user.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    /**
     * List of the logged in user's own contact / support submissions.
     */
    public function contacts()
    {
        $contacts = Contact::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.contacts', compact('contacts'));
    }

    /**
     * Payment history for the logged in user, grouped by status
     * (pending, success, failed) and merged from both the
     * finalised `payments` table and the `temp_payments` table
     * (for attempts that never completed).
     */
    public function payments()
    {
        $userId = Auth::id();

        $payments = Payment::where('user_id', $userId)->get()->map(function ($p) {
            $details = Payment::getProductDetails($p->product_type);

            return (object) [
                'source'       => 'payment',
                'product_type' => $p->product_type,
                'product_name' => $details['name'] ?? $p->product_type,
                'amount'       => $p->amount,
                'txn_ref'      => $p->txn_ref,
                'order_id'     => $p->order_id,
                'status'       => $p->status,
                'date'         => $p->paid_at ?? $p->created_at,
            ];
        });

        $tempPayments = TempPayment::where('user_id', $userId)->get()->map(function ($t) {
            $details = Payment::getProductDetails($t->product_type);

            return (object) [
                'source'       => 'temp_payment',
                'product_type' => $t->product_type,
                'product_name' => $details['name'] ?? $t->product_type,
                'amount'       => $t->amount,
                'txn_ref'      => $t->txn_ref,
                'order_id'     => $t->order_id,
                'status'       => $t->status,
                'date'         => $t->created_at,
            ];
        });

        $allPayments = $payments->merge($tempPayments)->sortByDesc('date')->values();

        $pendingStatuses = ['pending', 'initiated', 'processing'];
        $failedStatuses  = ['failed', 'expired'];

        $pending = $allPayments->whereIn('status', $pendingStatuses)->values();
        $success = $allPayments->where('status', 'success')->values();
        $failed  = $allPayments->whereIn('status', $failedStatuses)->values();

        return view('user.payments', compact('allPayments', 'pending', 'success', 'failed'));
    }

    /**
     * Purchased / approved products for the logged in user.
     */
    public function products()
    {
        $products = PurchasedProduct::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->map(function ($product) {
                $product->details = Payment::getProductDetails($product->product_type);
                return $product;
            });

        return view('user.products', compact('products'));
    }
}