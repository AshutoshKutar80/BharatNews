<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Blocked</title>
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

        .block-icon {
            font-size: 64px;
            margin-bottom: 15px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
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

        /* Impact Cards */
        .impact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0 30px;
        }

        .impact-item {
            background: #f7fafc;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .impact-item:hover {
            background: #edf2f7;
            transform: scale(1.02);
        }

        .impact-item .impact-icon {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
        }

        .impact-item span {
            display: block;
            font-size: 13px;
            color: #4a5568;
            font-weight: 500;
        }

        .impact-item .impact-status {
            display: inline-block;
            color: #e53e3e;
            font-weight: 700;
            font-size: 12px;
            margin-top: 4px;
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

        .status-badge-blocked {
            background: #e53e3e;
            color: white;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Important Notice */
        .notice-box {
            background: #fffff0;
            border: 1px solid #f6e05e;
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
            color: #744210;
            font-size: 14px;
            margin: 0;
        }

        .notice-box .notice-text strong {
            color: #553c0a;
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
            color: #48bb78;
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

            .block-icon {
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

            .impact-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .impact-item {
                padding: 12px;
            }

            .impact-item span {
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
            .impact-grid {
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
                    <div class="block-icon">⛔</div>
                    <h1>Account Blocked</h1>
                    <p class="subtitle">Your account access has been temporarily suspended</p>
                </div>
            </div>

            <!-- Body -->
            <div class="body-content">
                <h2 class="greeting">Hello, <span>{{ $user->name }}</span></h2>

                <div class="alert-box">
                    <p>⚠️ <strong>Important Notice:</strong> We regret to inform you that your account has been blocked
                        by our administrator.</p>
                </div>

                @if ($remark)
                    <div class="remark-box">
                        <div class="remark-label">📝 Reason for Blocking:</div>
                        <div class="remark-text">{{ $remark }}</div>
                    </div>
                @endif

                <p style="color: #4a5568; margin-bottom: 20px;">
                    As a result of this action, the following features are temporarily unavailable:
                </p>

                <!-- Impact Grid -->
                <div class="impact-grid">
                    <div class="impact-item">
                        <span class="impact-icon">🚫</span>
                        <span>Account Access</span>
                        <span class="impact-status">❌ Blocked</span>
                    </div>
                    <div class="impact-item">
                        <span class="impact-icon">📝</span>
                        <span>Create/Edit Content</span>
                        <span class="impact-status">❌ Disabled</span>
                    </div>
                    <div class="impact-item">
                        <span class="impact-icon">💬</span>
                        <span>Comment & Interact</span>
                        <span class="impact-status">❌ Disabled</span>
                    </div>
                    <div class="impact-item">
                        <span class="impact-icon">📊</span>
                        <span>Dashboard Access</span>
                        <span class="impact-status">❌ Restricted</span>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="notice-box">
                    <span class="notice-icon">📌</span>
                    <div class="notice-text">
                        <strong>What you can do:</strong> If you believe this action was taken in error or would like
                        more information, please contact our support team. We're here to help and resolve any issues.
                    </div>
                </div>

                <!-- Account Details -->
                <div class="details-card">
                    <div class="details-title">📋 Account Status Details</div>

                    <div class="detail-row">
                        <span class="detail-label">Account Holder</span>
                        <span class="detail-value">{{ $user->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Account Status</span>
                        <span class="detail-value">
                            <span class="status-badge-blocked">⛔ Blocked</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Blocked By</span>
                        <span class="detail-value">{{ $admin->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Blocked At</span>
                        <span class="detail-value">{{ $user->status_updated_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="button-container">
                    <a href="mailto:{{ config('mail.support_email', 'support@example.com') }}" class="btn-primary">
                        📧 Contact Support
                    </a>
                    <a href="{{ url('/') }}" class="btn-secondary">
                        🏠 Visit Our Website
                    </a>
                </div>

                <p style="color: #4a5568; text-align: center; font-size: 14px; margin-top: 20px;">
                    We value your understanding and cooperation during this process.
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
                        Committed to fair and secure access
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
