<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply from Bharat Integrity Forum</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .header p {
            color: #94a3b8;
            margin: 5px 0 0;
            font-size: 14px;
        }

        .content {
            padding: 40px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .message-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #e74c3c;
            margin: 20px 0;
        }

        .reply-box {
            background: #f0fdf4;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2ecc71;
            margin: 20px 0;
        }

        .divider {
            border: none;
            border-top: 2px solid #e2e8f0;
            margin: 25px 0;
        }

        .footer {
            background: #f8fafc;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer p {
            color: #94a3b8;
            font-size: 13px;
            margin: 5px 0;
        }

        .badge {
            display: inline-block;
            background: #e74c3c;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 30px;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            background: #e74c3c;
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #c0392b;
        }

        @media (max-width: 480px) {
            .container {
                margin: 20px;
            }

            .content {
                padding: 20px;
            }

            .header {
                padding: 20px;
            }

            .footer {
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📰 Bharat Integrity Forum</h1>
            <p>Truth • Impartial • Trustworthy</p>
        </div>

        <div class="content">
            <div class="badge">Reply to Your Inquiry</div>

            <p class="greeting">Dear {{ $contact->name }},</p>

            <p>Thank you for contacting Bharat Integrity Forum. We appreciate your interest and have carefully reviewed
                your inquiry.</p>

            <div class="message-box">
                <strong style="color: #475569;">Your Original Message:</strong>
                <p style="margin-top: 10px; color: #1e293b;">{{ $contact->message }}</p>
                <div style="font-size: 13px; color: #94a3b8; margin-top: 10px;">
                    <strong>Subject:</strong> {{ ucfirst(str_replace('-', ' ', $contact->subject)) }}
                </div>
            </div>

            <div class="reply-box">
                <strong style="color: #065f46;">Our Reply:</strong>
                <p style="margin-top: 10px; color: #1e293b;">{{ $reply }}</p>
            </div>

            <hr class="divider">

            <p style="font-size: 14px; color: #475569;">
                If you have any further questions, please don't hesitate to reply to this email or contact us directly.
            </p>

            <div style="text-align: center; margin: 25px 0;">
                <a href="mailto:info@bharatintegrityforum.news" class="btn">Reply to This Email</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>Bharat Integrity Forum News</strong></p>
            <p>Sikandra, Agra, Uttar Pradesh, 282010</p>
            <p>📧 info@bharatintegrityforum.news | 📞 +91 9250073334</p>
            <p style="margin-top: 10px; font-size: 12px; color: #cbd5e1;">
                This is an automated reply from our support team. Please do not reply directly to this email.
            </p>
        </div>
    </div>
</body>

</html>
