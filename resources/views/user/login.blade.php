@extends('layouts.app')

@section('title', 'User Login - Bharat Integrity Forum News')
@section('meta_description',
    'Login to your Bharat Integrity Forum News account to access your dashboard and manage your
    profile.')

@section('content')

    {{-- ================= PAGE HERO ================= --}}
    <section class="page-hero">
        <div class="container hero-inner">
            <span class="hero-badge">SECURE LOGIN</span>
            <h1 class="hero-title">Welcome <span class="text-gold">Back</span></h1>
            <p class="lead hero-lead">Login to your Bharat Integrity Forum News account to access your dashboard and continue
                your journey with us.</p>
        </div>
    </section>

    {{-- ================= LOGIN FORM ================= --}}
    <section class="login-section">
        <div class="container">
            <div class="form-wrap">

                <div id="formAlert" class="form-alert" style="display:none;"></div>

                <form id="loginForm" novalidate autocomplete="off">
                    @csrf

                    <div class="form-grid">

                        {{-- Mobile Number --}}
                        <div class="form-group">
                            <label for="login">Mobile Number <span class="req">*</span></label>
                            <input type="tel" id="login" name="login" class="form-control"
                                placeholder="10-digit mobile number" inputmode="numeric" maxlength="10"
                                value="{{ old('login') }}" autofocus>
                            <span class="field-msg" id="login-msg"></span>
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label for="password">Password <span class="req">*</span></label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Enter your password">
                                <button type="button" class="toggle-password" id="togglePassword"
                                    aria-label="Toggle password visibility">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="field-msg" id="password-msg"></span>
                        </div>

                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <span class="checkmark"></span>
                            <span>Remember Me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary submit-btn" disabled>
                        <span>Login Now</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>

                    <p class="register-link">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        * {
            box-sizing: border-box;
        }



        .container {
            /* max-width: 1200px;
                margin: 0 auto; */
            /* padding: 0 20px; */
        }

        .req {
            color: #e74c3c;
        }

        /* ===================================================== */
        /* =================   PAGE HERO   ======================= */
        /* ===================================================== */
        .page-hero {
            background: linear-gradient(135deg, #0d1526 0%, #14213d 100%);
            padding: 70px 0 110px;
            color: #fff;
            text-align: center;
        }

        .hero-inner {
            max-width: 640px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #f5a623;
            margin-bottom: 14px;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.2;
            color: #fff;
            margin: 0 0 14px;
            letter-spacing: -0.5px;
        }

        .text-gold {
            color: #f5a623;
        }

        .hero-lead {
            font-size: 15.5px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin: 0;
        }

        /* ===================================================== */
        /* =================   LOGIN FORM   ======================= */
        /* ===================================================== */
        .login-section {
            padding: 0 0 80px;
            background: #eef1f5;
        }

        .form-wrap {
            max-width: 620px;
            margin: -70px auto 0;
            background: #fff;
            border-radius: 20px;
            padding: 40px 40px 36px;
            box-shadow: 0 20px 50px rgba(16, 25, 46, 0.12);
            position: relative;
            z-index: 2;
            margin-top: 30px;
        }

        .form-grid {
            display: grid;
            gap: 20px 24px;
            margin-bottom: 6px;
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13.5px;
            font-weight: 700;
            color: #16213e;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 14px;
            border: 1.5px solid #e1e4ea;
            border-radius: 10px;
            font-size: 14.5px;
            color: #16213e;
            background: #fff;
            width: 100%;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #a7adba;
        }

        .form-control:focus {
            outline: none;
            border-color: #f5a623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
        }

        .form-control.is-valid {
            border-color: #2ecc71;
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .field-msg {
            font-size: 12px;
            margin-top: 5px;
            min-height: 16px;
            display: block;
            font-weight: 500;
            color: #e74c3c;
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper .form-control {
            padding-right: 42px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: #a7adba;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .toggle-password:hover {
            color: #16213e;
            background: rgba(0, 0, 0, 0.04);
        }

        .toggle-password.active svg {
            stroke: #f5a623;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 4px 0 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13.5px;
            color: #555;
            cursor: pointer;
            position: relative;
        }

        .checkbox-label input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 1.5px solid #d0d5dd;
            border-radius: 5px;
            display: inline-block;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .checkbox-label input:checked~.checkmark {
            background: #16213e;
            border-color: #16213e;
        }

        .checkbox-label input:checked~.checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
        }

        .forgot-link {
            color: #f5a623;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 700;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            border-radius: 30px;
            background: #ccced2;
            color: #fff;
            transition: all 0.3s ease;
        }

        .submit-btn:not(:disabled) {
            background: linear-gradient(135deg, #f5a623, #e0841a);
            box-shadow: 0 8px 20px rgba(245, 166, 35, 0.3);
        }

        .submit-btn:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(245, 166, 35, 0.4);
        }

        .submit-btn:disabled {
            cursor: not-allowed;
        }

        .submit-btn svg {
            transition: transform 0.3s ease;
        }

        .submit-btn:not(:disabled):hover svg {
            transform: translateX(4px);
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2.5px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.6s linear infinite;
            vertical-align: middle;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13.5px;
            color: #888;
        }

        .register-link a {
            color: #f5a623;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .form-alert {
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            margin-bottom: 18px;
            font-weight: 500;
            display: none;
        }

        .form-alert.success {
            background: #f0fdf4;
            color: #1e8449;
            border: 1px solid #bbf7d0;
            display: block;
        }

        .form-alert.error {
            background: #fef2f2;
            color: #c0392b;
            border: 1px solid #fecaca;
            display: block;
        }

        /* ===================================================== */
        /* ==================   RESPONSIVE   ===================== */
        /* ===================================================== */
        @media (max-width: 768px) {
            .page-hero {
                padding: 50px 0 90px;
            }

            .hero-title {
                font-size: 32px;
            }

            .form-wrap {
                padding: 32px 24px;
                margin-top: -55px;
                border-radius: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 26px;
            }

            .hero-lead {
                font-size: 14px;
            }

            .form-wrap {
                padding: 24px 18px;
                margin-top: 45px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ============================================================
               MOBILE NUMBER INPUT (digits only, 10 max)
            ============================================================ */
            const loginInput = document.getElementById('login');
            loginInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            /* ============================================================
               TOGGLE PASSWORD VISIBILITY
            ============================================================ */
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');

            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('active');

                const svg = this.querySelector('svg');
                svg.innerHTML = type === 'text' ?
                    '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>' :
                    '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            });

            /* ============================================================
               LIVE VALIDATION
            ============================================================ */
            const fields = {
                login: {
                    validate: v => /^[6-9]\d{9}$/.test(v),
                    msg: 'Enter a valid 10-digit mobile number'
                },
                password: {
                    validate: v => v.length >= 6,
                    msg: 'Password must be at least 6 characters'
                }
            };

            const submitBtn = document.getElementById('submitBtn');
            const formAlert = document.getElementById('formAlert');

            function validateField(name) {
                const el = document.getElementById(name);
                const msgEl = document.getElementById(name + '-msg');
                const rule = fields[name];
                const value = el.value;
                const valid = rule.validate(value);

                if (valid) {
                    el.classList.remove('is-invalid');
                    el.classList.add('is-valid');
                    msgEl.textContent = '';
                } else {
                    el.classList.remove('is-valid');
                    el.classList.add('is-invalid');
                    msgEl.textContent = value ? rule.msg : '';
                }
                return valid;
            }

            function checkFormValid() {
                let allValid = true;
                Object.keys(fields).forEach(name => {
                    const el = document.getElementById(name);
                    if (!fields[name].validate(el.value)) allValid = false;
                });
                submitBtn.disabled = !allValid;
                return allValid;
            }

            Object.keys(fields).forEach(name => {
                const el = document.getElementById(name);
                el.addEventListener('input', function() {
                    validateField(name);
                    checkFormValid();
                });
                el.addEventListener('blur', function() {
                    validateField(name);
                    checkFormValid();
                });
            });

            /* ============================================================
               FORM SUBMISSION
            ============================================================ */
            const form = document.getElementById('loginForm');

            function showAlert(message, type) {
                formAlert.textContent = message;
                formAlert.className = 'form-alert ' + type;
                formAlert.style.display = 'block';
            }

            function hideAlert() {
                formAlert.style.display = 'none';
                formAlert.className = 'form-alert';
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                hideAlert();

                if (!checkFormValid()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please fill all fields correctly.',
                        confirmButtonColor: '#f5a623',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner"></span> Logging in...';

                const formData = new FormData(form);

                fetch("{{ route('login.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(async (response) => {
                        const data = await response.json().catch(() => ({}));
                        if (!response.ok) {
                            const error = new Error(data.message ||
                                'Invalid credentials. Please try again.');
                            error.reason = data.reason || 'unknown';
                            throw error;
                        }
                        return data;
                    })
                    .then((data) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful!',
                            text: data.message || 'Welcome back! Redirecting to dashboard...',
                            timer: 1800,
                            timerProgressBar: true,
                            confirmButtonColor: '#2ecc71',
                            confirmButtonText: 'OK',
                            willClose: () => {
                                window.location.href = data.redirect || '/dashboard';
                            }
                        });
                        submitBtn.innerHTML = 'Redirecting...';
                    })
                    .catch((err) => {
                        // Different icon/title based on WHY the login failed
                        const alertConfig = {
                            blocked: {
                                icon: 'error',
                                title: 'Account Blocked'
                            },
                            pending: {
                                icon: 'info',
                                title: 'Approval Pending'
                            },
                            reject: {
                                icon: 'error',
                                title: 'Registration Rejected'
                            },
                            invalid_credentials: {
                                icon: 'error',
                                title: 'Login Failed'
                            }
                        };

                        const config = alertConfig[err.reason] || {
                            icon: 'error',
                            title: 'Login Failed'
                        };

                        Swal.fire({
                            icon: config.icon,
                            title: config.title,
                            text: err.message || 'Invalid credentials. Please try again.',
                            confirmButtonColor: '#e74c3c',
                            confirmButtonText: 'OK'
                        });

                        submitBtn.disabled = false;
                        submitBtn.innerHTML =
                            '<span>Login Now</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
                    });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    const active = document.activeElement;
                    if (active && (active.id === 'login' || active.id === 'password')) {
                        e.preventDefault();
                        form.dispatchEvent(new Event('submit'));
                    }
                }
            });

        });
    </script>
@endpush
