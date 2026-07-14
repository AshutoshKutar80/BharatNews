<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approved</title>
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
            background: linear-gradient(135deg, #48bb78 0%, #38a169 50%, #2f855a 100%);
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

        .success-icon {
            font-size: 64px;
            margin-bottom: 15px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
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
            color: #48bb78;
        }

        .message-box {
            background: linear-gradient(135deg, #f0fff4 0%, #e6fffa 100%);
            border-left: 4px solid #48bb78;
            padding: 20px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .message-box p {
            color: #2d3748;
            font-size: 16px;
            margin: 0;
        }

        .message-box strong {
            color: #38a169;
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0 30px;
        }

        .feature-item {
            background: #f7fafc;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .feature-item:hover {
            background: #edf2f7;
            transform: scale(1.02);
        }

        .feature-icon {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
        }

        .feature-item span {
            display: block;
            font-size: 13px;
            color: #4a5568;
            font-weight: 500;
        }

        .button-container {
            text-align: center;
            margin: 30px 0 25px;
        }

        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: #ffffff;
            padding: 14px 45px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 161, 105, 0.3);
            letter-spacing: 0.3px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 161, 105, 0.4);
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
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

        .status-badge {
            background: #48bb78;
            color: white;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
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
            background: linear-gradient(135deg, #48bb78, #38a169);
            margin: 12px auto;
            border-radius: 2px;
        }

        .footer small {
            color: #a0aec0;
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

            .success-icon {
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

            .features-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .feature-item {
                padding: 12px;
            }

            .feature-item span {
                font-size: 12px;
            }

            .btn-primary {
                padding: 12px 30px;
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
        }

        @media (max-width: 400px) {
            .features-grid {
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
                    <div class="success-icon">✅</div>
                    <h1>Account Approved!</h1>
                    <p class="subtitle">Your account is now active and ready to use</p>
                </div>
            </div>

            <!-- Body -->
            <div class="body-content">
                <h2 class="greeting">Hello, <span>{{ $user->name }}</span> 👋</h2>

                <div class="message-box">
                    <p>🎉 <strong>Congratulations!</strong> We are pleased to inform you that your account has been
                        successfully approved by our administrator.</p>
                </div>

                <p style="color: #4a5568; margin-bottom: 20px;">
                    You now have full access to all available features. Here's what you can do:
                </p>

                <!-- Features Grid -->
                <div class="features-grid">
                    <div class="feature-item">
                        <span class="feature-icon">🔐</span>
                        <span>Secure Login</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📊</span>
                        <span>Access Dashboard</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📱</span>
                        <span>Mobile Access</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🤝</span>
                        <span>Community Features</span>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="details-card">
                    <div class="details-title">📋 Account Details</div>

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
                            <span class="status-badge">✅ Approved</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Approved By</span>
                        <span class="detail-value">{{ $admin->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Approved At</span>
                        <span class="detail-value">{{ $user->status_updated_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="button-container">
                    <a href="{{ url('/login') }}" class="btn-primary">
                        🚀 Login to Your Account
                    </a>
                </div>

                <p style="color: #4a5568; text-align: center; font-size: 14px;">
                    Thank you for being a part of our community! We look forward to serving you.
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
                        Empowering users worldwide
                    </p>

                    <p>
                        <small>
                            This is an automated notification. Please do not reply to this email.
                            <br>
                            If you need assistance, contact our support team.
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
