<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\TehsilList; // Changed to TehsilList
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
}
