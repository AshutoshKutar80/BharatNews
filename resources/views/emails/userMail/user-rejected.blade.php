<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Rejected</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1a202c;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .email-wrapper {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .email-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1), 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .email-container:hover {
            transform: translateY(-2px);
        }

        /* Header Section */
        .header {
            background: linear-gradient(135deg, #fc8181 0%, #e53e3e 50%, #c53030 100%);
            padding: 45px 30px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .reject-icon {
            font-size: 64px;
            margin-bottom: 15px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            animation: shake 2s infinite;
        }

        @keyframes shake {

            0%,
            100% {
                transform: rotate(0deg);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: rotate(-5deg);
            }

            20%,
            40%,
            60%,
            80% {
                transform: rotate(5deg);
            }
        }

        .header h1 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            margin: 10px 0 5px;
            letter-spacing: -0.5px;
        }

        .header .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 300;
        }

        /* Body Section */
        .body-content {
            padding: 40px 35px 35px;
        }

        .greeting {
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .greeting span {
            color: #e53e3e;
        }

        .alert-box {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
            border-left: 4px solid #e53e3e;
            padding: 20px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .alert-box p {
            color: #2d3748;
            font-size: 16px;
            margin: 0;
        }

        .alert-box strong {
            color: #e53e3e;
        }

        /* Remark Section */
        .remark-box {
            background: #fffaf0;
            border: 1px solid #fbd38d;
            border-left: 4px solid #ed8936;
            padding: 20px 25px;
            border-radius: 8px;
            margin: 20px 0 25px;
        }

        .remark-box .remark-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #dd6b20;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remark-box .remark-text {
            color: #2d3748;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 12px;
            background: white;
            border-radius: 6px;
            margin: 5px 0 0;
        }

        /* Next Steps Grid */
        .steps-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin: 25px 0 30px;
        }

        .step-item {
            background: #f7fafc;
            padding: 15px 12px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .step-item:hover {
            background: #edf2f7;
            transform: scale(1.02);
        }

        .step-item .step-number {
            display: inline-block;
            background: #e53e3e;
            color: white;
            width: 28px;
            height: 28px;
            line-height: 28px;
            border-radius: 50%;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .step-item .step-icon {
            font-size: 28px;
            display: block;
            margin: 5px 0;
        }

        .step-item span {
            display: block;
            font-size: 13px;
            color: #4a5568;
            font-weight: 500;
        }

        /* Action Buttons */
        .button-container {
            text-align: center;
            margin: 30px 0 25px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: #ffffff;
            padding: 14px 45px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(49, 130, 206, 0.3);
            letter-spacing: 0.3px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(49, 130, 206, 0.4);
            background: linear-gradient(135deg, #3182ce 0%, #2b6cb0 100%);
        }

        .btn-secondary {
            display: inline-block;
            background: transparent;
            color: #4a5568;
            padding: 12px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            font-size: 14px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            transform: translateY(-2px);
        }

        /* Account Details Card */
        .details-card {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px 25px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }

        .details-title {
            font-size: 14px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #edf2f7;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #718096;
            font-size: 14px;
        }

        .detail-value {
            color: #2d3748;
            font-weight: 500;
            font-size: 14px;
        }

        .status-badge-rejected {
            background: #e53e3e;
            color: white;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Important Notice */
        .notice-box {
            background: #ebf8ff;
            border: 1px solid #90cdf4;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 20px 0;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notice-box .notice-icon {
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .notice-box .notice-text {
            color: #2c5282;
            font-size: 14px;
            margin: 0;
        }

        .notice-box .notice-text strong {
            color: #1a365d;
        }

        /* Footer Section */
        .footer {
            background: #f7fafc;
            padding: 25px 35px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-content {
            text-align: center;
        }

        .footer p {
            font-size: 13px;
            color: #718096;
            margin: 5px 0;
        }

        .footer .company {
            font-weight: 600;
            color: #4a5568;
        }

        .social-links {
            margin: 15px 0 10px;
        }

        .social-links a {
            color: #718096;
            text-decoration: none;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #4299e1;
        }

        .footer-divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(135deg, #fc8181, #e53e3e);
            margin: 12px auto;
            border-radius: 2px;
        }

        .footer small {
            color: #a0aec0;
        }

        .footer .support-email {
            color: #4299e1;
            text-decoration: none;
            font-weight: 600;
        }

        .footer .support-email:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 35px 20px 30px;
            }

            .header h1 {
                font-size: 26px;
            }

            .reject-icon {
                width: 80px;
                height: 80px;
                line-height: 80px;
                font-size: 50px;
            }

            .body-content {
                padding: 25px 20px;
            }

            .greeting {
                font-size: 20px;
            }

            .steps-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .step-item {
                padding: 12px;
            }

            .step-item span {
                font-size: 12px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 12px 25px;
                font-size: 14px;
                display: block;
            }

            .detail-row {
                flex-direction: column;
                padding: 6px 0;
            }

            .detail-value {
                margin-top: 2px;
            }

            .footer {
                padding: 20px;
            }

            .notice-box {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

        @media (max-width: 400px) {
            .steps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="header">
                <div class="header-content">
                    <div class="reject-icon">❌</div>
                    <h1>Account Rejected</h1>
                    <p class="subtitle">Your registration application could not be approved</p>
                </div>
            </div>

            <!-- Body -->
            <div class="body-content">
                <h2 class="greeting">Hello, <span>{{ $user->name }}</span></h2>

                <div class="alert-box">
                    <p>⚠️ <strong>Important Notice:</strong> We regret to inform you that your account registration has
                        been rejected by our administrator.</p>
                </div>

                @if ($remark)
                    <div class="remark-box">
                        <div class="remark-label">📝 Reason for Rejection:</div>
                        <div class="remark-text">{{ $remark }}</div>
                    </div>
                @endif

                <p style="color: #4a5568; margin-bottom: 20px;">
                    While this decision is final, here are your options moving forward:
                </p>

                <!-- Next Steps Grid -->
                <div class="steps-grid">
                    <div class="step-item">
                        <span class="step-number">1</span>
                        <span class="step-icon">📋</span>
                        <span>Review the reason provided</span>
                    </div>
                    <div class="step-item">
                        <span class="step-number">2</span>
                        <span class="step-icon">💬</span>
                        <span>Contact support for clarification</span>
                    </div>
                    <div class="step-item">
                        <span class="step-number">3</span>
                        <span class="step-icon">🔄</span>
                        <span>Reapply after addressing issues</span>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="notice-box">
                    <span class="notice-icon">💡</span>
                    <div class="notice-text">
                        <strong>Need help?</strong> Our support team is available to provide more details about this
                        decision and guide you through the next steps. We're here to assist you.
                    </div>
                </div>

                <!-- Account Details -->
                <div class="details-card">
                    <div class="details-title">📋 Application Details</div>

                    <div class="detail-row">
                        <span class="detail-label">Applicant Name</span>
                        <span class="detail-value">{{ $user->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Application Status</span>
                        <span class="detail-value">
                            <span class="status-badge-rejected">❌ Rejected</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Reviewed By</span>
                        <span class="detail-value">{{ $admin->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Reviewed At</span>
                        <span class="detail-value">{{ $user->status_updated_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="button-container">
                    <a href="mailto:{{ config('mail.support_email', 'support@example.com') }}" class="btn-primary">
                        📧 Contact Support
                    </a>
                    <a href="{{ url('/register') }}" class="btn-secondary">
                        🔄 Reapply for Membership
                    </a>
                </div>

                <p style="color: #4a5568; text-align: center; font-size: 14px; margin-top: 20px;">
                    We appreciate your interest in Bharat Integrity Forum News and wish you the best.
                </p>

                <p style="color: #4a5568; margin-top: 20px; font-size: 15px;">
                    Best regards,<br>
                    <strong style="color: #2d3748; font-size: 16px;">Bharat Integrity Forum News Team</strong>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-content">
                    <div class="social-links">
                        <a href="#" title="Facebook">📘</a>
                        <a href="#" title="Twitter">🐦</a>
                        <a href="#" title="Instagram">📸</a>
                        <a href="#" title="LinkedIn">💼</a>
                        <a href="#" title="YouTube">▶️</a>
                    </div>

                    <div class="footer-divider"></div>

                    <p>
                        <span class="company">Bharat Integrity Forum News</span> —
                        Committed to fair and transparent processes
                    </p>

                    <p>
                        <small>
                            This is an automated notification. Please do not reply to this email.
                            <br>
                            For support, contact: <a
                                href="mailto:{{ config('mail.support_email', 'support@example.com') }}"
                                class="support-email">{{ config('mail.support_email', 'support@example.com') }}</a>
                        </small>
                    </p>

                    <p style="margin-top: 10px; font-size: 11px; color: #a0aec0;">
                        &copy; {{ date('Y') }} Bharat Integrity Forum News. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
