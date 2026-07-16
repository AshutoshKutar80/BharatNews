<!DOCTYPE html>
<html>

<head>
    <title>Product Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Product Approved! ✅</h2>
        </div>

        <div class="content">
            <p>Dear Customer,</p>

            <p>We are pleased to inform you that your purchased product has been approved.</p>

            <div class="details">
                <p><span class="label">Product ID:</span> #{{ $product->id }}</p>
                <p><span class="label">Tracking ID:</span> <strong>{{ $product->tracking_id }}</strong></p>
                <p><span class="label">Approved Date:</span> {{ $product->approved_at->format('F d, Y H:i A') }}</p>

                @if ($product->remark)
                    <p><span class="label">Remark:</span> {{ $product->admin_remark }}</p>
                @endif
            </div>

            <p>You can track your product using the tracking ID provided above.</p>

            <p>Thank you for your business!</p>

            <p>Best regards,<br>
                {{ config('app.name') }} Team</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
