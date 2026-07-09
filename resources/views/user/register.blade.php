@extends('layouts.app')

@section('title', 'User Register - Bharat Integrity Forum News')
@section('meta_description',
    'Register as a user with Bharat Integrity Forum News and get started with our media
    services.')
@section('meta_keywords', 'register, sign up, Bharat Integrity Forum')

@section('content')

    {{-- ================= PAGE HERO ================= --}}
    <section class="page-hero">
        <div class="container hero-inner">
            <span class="eyebrow-gold">Join Us</span>
            <h1 class="hero-title">Create your <span class="text-gold">account</span></h1>
            <p class="lead hero-lead">Register with Bharat Integrity Forum News and become part of our community.</p>
        </div>
        <div class="hero-blob hero-blob--top"></div>
        <div class="hero-blob hero-blob--bottom"></div>
    </section>

    {{-- ================= REGISTER FORM ================= --}}
    <section class="register-section">
        <div class="container">
            <div class="form-wrap">

                <div id="formAlert" class="form-alert" style="display:none;"></div>

                <form id="registerForm" novalidate autocomplete="off">
                    @csrf

                    <div class="form-grid">

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Full Name <span class="req">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your full name">
                            <span class="field-msg" id="name-msg"></span>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email Address <span class="req">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="you@example.com">
                            <span class="field-msg" id="email-msg"></span>
                        </div>

                        {{-- Mobile --}}
                        <div class="form-group">
                            <label for="mobile">Mobile Number <span class="req">*</span></label>
                            <input type="text" id="mobile" name="mobile" class="form-control"
                                placeholder="10-digit mobile number" maxlength="10">
                            <span class="field-msg" id="mobile-msg"></span>
                        </div>

                        {{-- Password with Show/Hide Button --}}
                        <div class="form-group">
                            <label for="password">Password <span class="req">*</span></label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Minimum 6 characters">
                                <button type="button" class="toggle-password" id="togglePassword"
                                    aria-label="Toggle password visibility">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="field-msg" id="password-msg"></span>
                        </div>

                        {{-- Confirm Password with Show/Hide Button --}}
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password <span class="req">*</span></label>
                            <div class="password-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Confirm your password">
                                <button type="button" class="toggle-password" id="toggleConfirmPassword"
                                    aria-label="Toggle confirm password visibility">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="field-msg" id="password_confirmation-msg"></span>
                        </div>

                        {{-- State --}}
                        <div class="form-group">
                            <label for="state">State <span class="req">*</span></label>
                            <select id="state" name="state" class="form-control">
                                <option value="">Select State</option>
                            </select>
                            <span class="field-msg" id="state-msg"></span>
                        </div>

                        {{-- District --}}
                        <div class="form-group">
                            <label for="district">District <span class="req">*</span></label>
                            <select id="district" name="district" class="form-control" disabled>
                                <option value="">Select State First</option>
                            </select>
                            <span class="field-msg" id="district-msg"></span>
                        </div>

                        {{-- Tehsil/Sub-District --}}
                        <div class="form-group">
                            <label for="tehsil">Tehsil/Sub-District <span class="req">*</span></label>
                            <select id="tehsil" name="tehsil" class="form-control" disabled>
                                <option value="">Select District First</option>
                            </select>
                            <span class="field-msg" id="tehsil-msg"></span>
                        </div>

                        {{-- City --}}
                        <div class="form-group">
                            <label for="city">City <span class="req">*</span></label>
                            <input type="text" id="city" name="city" class="form-control"
                                placeholder="Enter your city">
                            <span class="field-msg" id="city-msg"></span>
                        </div>

                        {{-- Pincode --}}
                        <div class="form-group">
                            <label for="pincode">Pincode <span class="req">*</span></label>
                            <input type="text" id="pincode" name="pincode" class="form-control"
                                placeholder="6-digit pincode" maxlength="6">
                            <span class="field-msg" id="pincode-msg"></span>
                        </div>

                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary submit-btn" disabled>
                        Register Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>

                    <p class="login-link">
                        Already have an account? <a href="{{ route('login') }}">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    {{-- ================= SUCCESS MODAL ================= --}}
    <div id="successModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <button class="modal-close" id="closeSuccessModal">&times;</button>
            <div class="modal-icon modal-icon--success">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                    stroke-width="2">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
            </div>
            <h3 class="modal-title">Registration Successful!</h3>
            <p class="modal-note">
                Your account has been created successfully. You can now login to access your dashboard.
            </p>
            <div id="trackingCodeWrap" style="display:none;" class="tracking-code-box">
                <strong>Your Tracking Code:</strong><br>
                <span id="trackingCodeDisplay"></span>
                <p style="font-size:12px; color:#999; margin-top:8px;">Please save this code for future reference.</p>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary modal-pay-btn">
                Login Now
            </a>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ===================================================== */
        /* =================   BASE STYLES   ==================== */
        /* ===================================================== */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #e74c3c;
            color: #fff;
            padding: 14px 35px;
        }

        .btn-primary:hover:not(:disabled) {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
        }

        .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .eyebrow-gold {
            color: #f39c12;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: 14px;
            display: inline-block;
        }

        .text-gold {
            color: #f39c12;
        }

        /* ===================================================== */
        /* =================   PAGE HERO   ====================== */
        /* ===================================================== */
        .page-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 80px 0 70px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            max-width: 720px;
            margin: 15px auto 20px;
            font-size: 44px;
            font-weight: 700;
            line-height: 1.2;
            color: #ccc;
        }

        .hero-lead {
            max-width: 600px;
            margin: 0 auto;
            font-size: 18px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
        }

        .hero-blob--top {
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: rgba(231, 76, 60, 0.1);
        }

        .hero-blob--bottom {
            bottom: -80px;
            left: -30px;
            width: 200px;
            height: 200px;
            background: rgba(243, 156, 18, 0.08);
        }

        /* ===================================================== */
        /* =================   REGISTER FORM   =================== */
        /* ===================================================== */
        .register-section {
            padding: 70px 0;
            background: #f8f9fa;
        }

        .form-wrap {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        }

        .form-alert {
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-alert.success {
            background: rgba(46, 204, 113, 0.1);
            color: #1e8449;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .form-alert.error {
            background: rgba(231, 76, 60, 0.1);
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group--full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .req {
            color: #e74c3c;
        }

        .opt {
            color: #999;
            font-weight: 400;
            font-size: 12px;
        }

        /* Password Wrapper with Show/Hide Button */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper .form-control {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: #999;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            width: 36px;
            height: 36px;
        }

        .toggle-password:hover {
            color: #333;
            background: rgba(0, 0, 0, 0.05);
        }

        .toggle-password:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.15);
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .toggle-password.active svg {
            stroke: #e74c3c;
        }

        .form-control {
            padding: 13px 16px;
            border: 1.5px solid #e2e4e8;
            border-radius: 10px;
            font-size: 15px;
            color: #333;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            width: 100%;
        }

        .form-control:focus {
            outline: none;
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .form-control.is-valid {
            border-color: #2ecc71;
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .form-control:disabled {
            background: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .field-msg {
            font-size: 12.5px;
            margin-top: 6px;
            min-height: 16px;
        }

        .field-msg.error {
            color: #e74c3c;
        }

        .field-msg.success {
            color: #2ecc71;
        }

        .submit-btn {
            width: 100%;
            margin-top: 30px;
            padding: 15px;
            font-size: 16px;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 4px;
            font-size: 12px;
            min-height: 20px;
            font-weight: 500;
        }

        /* Terms */
        .terms-group {
            margin-top: 10px;
        }

        .terms-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 400;
            color: #555;
            cursor: pointer;
        }

        .terms-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #e74c3c;
        }

        .terms-link {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .login-link a {
            color: #e74c3c;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* ===================================================== */
        /* =================   SUCCESS MODAL   ================== */
        /* ===================================================== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 15, 25, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
            backdrop-filter: blur(4px);
        }

        .modal-box {
            background: #fff;
            border-radius: 18px;
            padding: 40px 35px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 14px;
            right: 16px;
            background: none;
            border: none;
            font-size: 28px;
            line-height: 1;
            color: #999;
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: #333;
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(46, 204, 113, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
        }

        .modal-icon svg {
            animation: checkmark 0.5s ease;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .modal-title {
            font-size: 21px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .modal-note {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .modal-pay-btn {
            width: 100%;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .tracking-code-box {
            background: #f8f9fa;
            border: 1px dashed #ccc;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            color: #333;
            margin-bottom: 18px;
            word-break: break-all;
        }

        .tracking-code-box strong {
            color: #1a1a2e;
        }

        /* ===================================================== */
        /* ==================   RESPONSIVE   ===================== */
        /* ===================================================== */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 28px !important;
            }

            .form-wrap {
                padding: 30px 22px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .register-section {
                padding: 40px 0;
            }

            .page-hero {
                padding: 60px 0 50px;
            }

            .toggle-password {
                right: 8px;
                width: 32px;
                height: 32px;
            }

            .toggle-password svg {
                width: 18px;
                height: 18px;
            }
        }

        @media (max-width: 480px) {
            .page-hero {
                padding: 40px 0 35px;
            }

            .hero-title {
                font-size: 24px !important;
            }

            .hero-lead {
                font-size: 15px;
            }

            .form-wrap {
                padding: 20px 15px;
                border-radius: 12px;
            }

            .modal-box {
                padding: 30px 20px;
            }

            .form-control {
                padding: 11px 14px;
                font-size: 14px;
            }

            .terms-label {
                font-size: 13px;
            }
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        select.form-control {
            appearance: auto;
            -webkit-appearance: auto;
            -moz-appearance: auto;
        }

        .form-control:focus-visible {
            outline: 2px solid #e74c3c;
            outline-offset: 1px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ============================================================
               TOGGLE PASSWORD VISIBILITY
            ============================================================ */
            function togglePasswordVisibility(inputId, buttonId) {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);

                if (!input || !button) return;

                button.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);

                    // Toggle active class for styling
                    this.classList.toggle('active');

                    // Change icon (optional - you can use different SVGs)
                    const svg = this.querySelector('svg');
                    if (type === 'text') {
                        // Eye open (showing password)
                        svg.innerHTML = `
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                            <line x1="1" y1="1" x2="23" y2="23"/>
                        `;
                    } else {
                        // Eye closed (hiding password)
                        svg.innerHTML = `
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        `;
                    }
                });
            }

            // Initialize toggle buttons
            togglePasswordVisibility('password', 'togglePassword');
            togglePasswordVisibility('password_confirmation', 'toggleConfirmPassword');

            /* ============================================================
               POPULATE STATES, DISTRICTS, AND TEHSILS
            ============================================================ */
            const stateSelect = document.getElementById('state');
            const districtSelect = document.getElementById('district');
            const tehsilSelect = document.getElementById('tehsil');

            // Get states data from PHP
            const states = @json($states);

            // Populate states
            stateSelect.innerHTML = '<option value="">Select State</option>';
            states.forEach(state => {
                const opt = document.createElement('option');
                opt.value = state;
                opt.textContent = state;
                stateSelect.appendChild(opt);
            });

            // Handle state change - fetch districts
            stateSelect.addEventListener('change', function() {
                const selectedState = this.value;

                // Reset district and tehsil dropdowns
                resetDistrictDropdown();
                resetTehsilDropdown();

                if (!selectedState) {
                    districtSelect.disabled = true;
                    districtSelect.innerHTML = '<option value="">Select State First</option>';
                    validateField('state');
                    validateField('district');
                    validateField('tehsil');
                    return;
                }

                // Show loading state
                districtSelect.disabled = true;
                districtSelect.innerHTML = '<option value="">Loading districts...</option>';

                // Fetch districts
                fetch(`/get-districts/${encodeURIComponent(selectedState)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Select District</option>';

                        if (data.districts && data.districts.length > 0) {
                            data.districts.forEach(district => {
                                const opt = document.createElement('option');
                                opt.value = district;
                                opt.textContent = district;
                                districtSelect.appendChild(opt);
                            });
                            districtSelect.disabled = false;
                        } else {
                            districtSelect.innerHTML =
                                '<option value="">No districts available</option>';
                            districtSelect.disabled = true;
                        }

                        validateField('district');
                    })
                    .catch(error => {
                        console.error('Error fetching districts:', error);
                        districtSelect.innerHTML = '<option value="">Error loading districts</option>';
                        districtSelect.disabled = true;
                    });
            });

            // Handle district change - fetch tehsils
            districtSelect.addEventListener('change', function() {
                const selectedDistrict = this.value;

                resetTehsilDropdown();

                if (!selectedDistrict) {
                    tehsilSelect.disabled = true;
                    tehsilSelect.innerHTML = '<option value="">Select District First</option>';
                    validateField('tehsil');
                    return;
                }

                // Show loading state
                tehsilSelect.disabled = true;
                tehsilSelect.innerHTML = '<option value="">Loading tehsils...</option>';

                // Fetch tehsils
                fetch(`/get-tehsils/${encodeURIComponent(selectedDistrict)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        tehsilSelect.innerHTML = '<option value="">Select Tehsil</option>';

                        if (data.tehsils && data.tehsils.length > 0) {
                            data.tehsils.forEach(tehsil => {
                                const opt = document.createElement('option');
                                opt.value = tehsil;
                                opt.textContent = tehsil;
                                tehsilSelect.appendChild(opt);
                            });
                            tehsilSelect.disabled = false;
                        } else {
                            tehsilSelect.innerHTML = '<option value="">No tehsils available</option>';
                            tehsilSelect.disabled = true;
                        }

                        validateField('tehsil');
                    })
                    .catch(error => {
                        console.error('Error fetching tehsils:', error);
                        tehsilSelect.innerHTML = '<option value="">Error loading tehsils</option>';
                        tehsilSelect.disabled = true;
                    });
            });

            function resetDistrictDropdown() {
                districtSelect.innerHTML = '<option value="">Select State First</option>';
                districtSelect.disabled = true;
            }

            function resetTehsilDropdown() {
                tehsilSelect.innerHTML = '<option value="">Select District First</option>';
                tehsilSelect.disabled = true;
            }

            /* ============================================================
               PASSWORD STRENGTH INDICATOR
            ============================================================ */
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            const confirmPasswordMsg = document.getElementById('password_confirmation-msg');

            // Create password strength indicator
            const passwordStrength = document.createElement('div');
            passwordStrength.className = 'password-strength';

            // Insert after password field
            if (passwordField) {
                passwordField.parentNode.insertBefore(passwordStrength, passwordField.nextSibling);
            }

            function checkPasswordStrength(password) {
                if (password.length === 0) {
                    passwordStrength.innerHTML = '';
                    return;
                }

                let strength = 0;
                let message = '';
                let color = '';

                // Length check
                if (password.length >= 6) strength += 1;
                if (password.length >= 10) strength += 1;

                // Contains number
                if (/\d/.test(password)) strength += 1;

                // Contains uppercase and lowercase
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;

                // Contains special character
                if (/[^a-zA-Z0-9]/.test(password)) strength += 1;

                // Determine strength
                if (strength <= 2) {
                    message = 'Weak';
                    color = '#e74c3c';
                } else if (strength <= 3) {
                    message = 'Fair';
                    color = '#f39c12';
                } else if (strength <= 4) {
                    message = 'Good';
                    color = '#3498db';
                } else {
                    message = 'Strong';
                    color = '#2ecc71';
                }


            }

            /* ============================================================
               PASSWORD MATCH CHECK - REAL TIME
            ============================================================ */
            function checkPasswordMatch() {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;

                if (confirmPassword === '') {
                    confirmPasswordField.classList.remove('is-valid', 'is-invalid');
                    if (confirmPasswordMsg) {
                        confirmPasswordMsg.textContent = '';
                        confirmPasswordMsg.className = 'field-msg';
                    }
                    return;
                }

                if (password === confirmPassword) {
                    confirmPasswordField.classList.remove('is-invalid');
                    confirmPasswordField.classList.add('is-valid');
                    if (confirmPasswordMsg) {
                        confirmPasswordMsg.innerHTML = '✓ Passwords match!';
                        confirmPasswordMsg.className = 'field-msg success';
                    }
                    return true;
                } else {
                    confirmPasswordField.classList.remove('is-valid');
                    confirmPasswordField.classList.add('is-invalid');
                    if (confirmPasswordMsg) {
                        confirmPasswordMsg.innerHTML = '✗ Passwords do not match';
                        confirmPasswordMsg.className = 'field-msg error';
                    }
                    return false;
                }
            }

            /* ============================================================
               LIVE VALIDATION
            ============================================================ */
            const fields = {
                name: {
                    required: true,
                    validate: v => v.trim().length >= 3,
                    msg: 'Enter at least 3 characters'
                },
                email: {
                    required: true,
                    validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
                    msg: 'Enter a valid email address'
                },
                mobile: {
                    required: true,
                    validate: v => v === '' || /^[6-9]\d{9}$/.test(v),
                    msg: 'Enter a valid 10-digit mobile number'
                },
                password: {
                    required: true,
                    validate: v => v.length >= 6,
                    msg: 'Minimum 6 characters required'
                },
                password_confirmation: {
                    required: true,
                    validate: function(v) {
                        const password = document.getElementById('password');
                        return password && v === password.value && v !== '';
                    },
                    msg: 'Passwords do not match'
                },
                state: {
                    required: true,
                    validate: v => v !== '',
                    msg: 'Please select a state'
                },
                district: {
                    required: true,
                    validate: v => v !== '',
                    msg: 'Please select a district'
                },
                tehsil: {
                    required: true,
                    validate: v => v !== '',
                    msg: 'Please select a tehsil'
                },
                city: {
                    required: true,
                    validate: v => v.trim().length >= 2,
                    msg: 'Enter a valid city name'
                },
                pincode: {
                    required: true,
                    validate: v => /^[1-9][0-9]{5}$/.test(v),
                    msg: 'Enter a valid 6-digit pincode'
                }
            };

            const submitBtn = document.getElementById('submitBtn');
            const formAlert = document.getElementById('formAlert');

            function validateField(name) {
                const el = document.getElementById(name);
                const msgEl = document.getElementById(name + '-msg');
                const rule = fields[name];

                if (!el) return true;

                const value = el.value;

                if (!rule.required && value.trim() === '') {
                    el.classList.remove('is-valid', 'is-invalid');
                    if (msgEl) {
                        msgEl.textContent = '';
                        msgEl.className = 'field-msg';
                    }
                    return true;
                }

                const valid = rule.validate(value);

                if (valid) {
                    el.classList.remove('is-invalid');
                    el.classList.add('is-valid');
                    if (msgEl) {
                        msgEl.textContent = '';
                        msgEl.className = 'field-msg success';
                    }
                } else {
                    el.classList.remove('is-valid');
                    el.classList.add('is-invalid');
                    if (msgEl) {
                        msgEl.textContent = rule.msg;
                        msgEl.className = 'field-msg error';
                    }
                }
                return valid;
            }

            function checkFormValid() {
                let allValid = true;
                Object.keys(fields).forEach(name => {
                    const el = document.getElementById(name);
                    if (!el) return;

                    const rule = fields[name];
                    if (rule.required) {
                        if (!rule.validate(el.value)) {
                            allValid = false;
                        }
                    } else {
                        if (el.value.trim() !== '' && !rule.validate(el.value)) {
                            allValid = false;
                        }
                    }
                });
                submitBtn.disabled = !allValid;
                return allValid;
            }

            // Attach validation events for all fields
            Object.keys(fields).forEach(name => {
                const el = document.getElementById(name);
                if (!el) return;

                el.addEventListener('input', function() {
                    validateField(name);
                    checkFormValid();
                });
                el.addEventListener('change', function() {
                    validateField(name);
                    checkFormValid();
                });
            });

            // Password specific events
            if (passwordField) {
                passwordField.addEventListener('input', function() {
                    checkPasswordStrength(this.value);
                    validateField('password');

                    if (confirmPasswordField.value !== '') {
                        checkPasswordMatch();
                    }
                    checkFormValid();
                });
            }

            if (confirmPasswordField) {
                confirmPasswordField.addEventListener('input', function() {
                    checkPasswordMatch();
                    checkFormValid();
                });

                confirmPasswordField.addEventListener('blur', function() {
                    if (this.value !== '') {
                        checkPasswordMatch();
                    }
                });
            }

            // Initial validation
            checkFormValid();

            /* ============================================================
               FORM SUBMISSION
            ============================================================ */
            const form = document.getElementById('registerForm');
            const successModal = document.getElementById('successModal');

            function showAlert(message, type) {
                formAlert.textContent = message;
                formAlert.className = 'form-alert ' + type;
                formAlert.style.display = 'block';
            }

            function closeSuccessModal() {
                successModal.style.display = 'none';
            }

            if (document.getElementById('closeSuccessModal')) {
                document.getElementById('closeSuccessModal').addEventListener('click', closeSuccessModal);
            }

            if (successModal) {
                successModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeSuccessModal();
                    }
                });
            }

            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (passwordField.value !== confirmPasswordField.value) {
                        showAlert('Passwords do not match. Please check.', 'error');
                        confirmPasswordField.focus();
                        return;
                    }

                    if (!checkFormValid()) {
                        showAlert('Please fill all required fields correctly.', 'error');
                        return;
                    }

                    formAlert.style.display = 'none';

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Registering...';

                    const formData = new FormData(form);

                    fetch("{{ route('register.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(async (response) => {
                            const data = await response.json().catch(() => ({}));
                            if (!response.ok) {
                                throw new Error(data.message ||
                                    'Something went wrong. Please try again.');
                            }
                            return data;
                        })
                        .then((data) => {
                            if (data.tracking) {
                                document.getElementById('trackingCodeDisplay').textContent = data
                                    .tracking;
                                document.getElementById('trackingCodeWrap').style.display = 'block';
                            }
                            successModal.style.display = 'flex';
                            form.reset();
                            resetDistrictDropdown();
                            resetTehsilDropdown();
                            document.querySelectorAll('.form-control').forEach(el => {
                                el.classList.remove('is-valid', 'is-invalid');
                            });
                            document.querySelectorAll('.field-msg').forEach(el => {
                                el.textContent = '';
                                el.className = 'field-msg';
                            });
                            passwordStrength.innerHTML = '';
                            submitBtn.disabled = true;
                            submitBtn.textContent = 'Register Now';
                        })
                        .catch((err) => {
                            showAlert(err.message || 'Registration failed. Please try again.',
                                'error');
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Register Now';
                        });
                });
            }

            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && successModal && successModal.style.display === 'flex') {
                    closeSuccessModal();
                }
            });

        });
    </script>
@endpush
