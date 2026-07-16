{{-- resources/views/payment/success.blade.php --}}

@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
    <div class="container"
        style="padding: 60px 15px; min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div
            style="background: #ffffff; border-radius: 24px; box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03); padding: 40px; max-width: 600px; width: 100%; text-align: center; border: 1px solid #f1f5f9;">

            <!-- Success Animated Checkmark Banner -->
            <div style="margin-bottom: 25px;">
                <div
                    style="background: #e8fbf1; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <span style="font-size: 50px; line-height: 1;">✅</span>
                </div>
                <h1 style="color: #10b981; font-size: 32px; font-weight: 800; margin: 0 0 10px 0; letter-spacing: -0.5px;">
                    Payment Successful!</h1>
                <p style="font-size: 16px; color: #64748b; margin: 0;">Your transaction has been completed successfully.</p>

                <!-- Upgrade Success Badge -->
                @if (isset($payment) && $payment->is_upgrade)
                    <div
                        style="margin-top: 12px; background: linear-gradient(135deg, #f0f7ff, #e8d5f5); padding: 10px 20px; border-radius: 12px; border: 2px solid #9b59b6; display: inline-block;">
                        <span style="font-size: 14px; color: #6c3483; font-weight: 700;">
                            🔄 Plan Upgraded Successfully!
                        </span>
                    </div>
                @endif
            </div>

            <!-- Amount Display with GST Breakdown -->
            <div
                style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                <span
                    style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 600;">Payment
                    Details</span>

                <div style="margin-top: 10px; text-align: left;">
                    <!-- Base Amount -->
                    <div style="display: flex; justify-content: space-between; padding: 6px 0;">
                        <span style="color: #64748b; font-size: 14px;">
                            {{ isset($payment) && $payment->is_upgrade ? 'Difference Amount' : 'Base Price' }}
                        </span>
                        <span style="font-weight: 600; color: #1a1a2e; font-size: 14px;">
                            ₹{{ number_format($payment->amount ?? 0, 2) }}
                        </span>
                    </div>

                    <!-- GST -->
                    <div
                        style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px dashed #e2e8f0;">
                        <span style="color: #64748b; font-size: 14px;">GST (18%)</span>
                        <span style="font-weight: 600; color: #9b59b6; font-size: 14px;">
                            + ₹{{ number_format($payment->gst_amount ?? 0, 2) }}
                        </span>
                    </div>

                    <!-- Total -->
                    <div style="display: flex; justify-content: space-between; padding: 12px 0 0 0; margin-top: 5px;">
                        <span style="font-size: 16px; font-weight: 700; color: #1a1a2e;">
                            {{ isset($payment) && $payment->is_upgrade ? 'Upgrade Total' : 'Total Paid' }}
                        </span>
                        <span style="font-size: 22px; font-weight: 800; color: #e74c3c;">
                            ₹{{ number_format($payment->total_amount ?? ($payment->amount ?? 0), 2) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Upgrade Information -->
            @if (isset($payment) && $payment->is_upgrade)
                <div
                    style="background: linear-gradient(135deg, #f0f7ff, #e8d5f5); border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 2px solid #9b59b6;">
                    <h4
                        style="color: #6c3483; margin: 0 0 12px 0; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>🔄</span> Upgrade Details
                    </h4>
                    <div style="text-align: left; font-size: 14px;">
                        <div
                            style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid rgba(155, 89, 182, 0.2);">
                            <span style="color: #4a235a;">Previous Plan</span>
                            <span style="font-weight: 600; color: #4a235a;">
                                @php
                                    $upgradedFrom = \App\Models\PurchasedProduct::find($payment->upgraded_from);
                                @endphp
                                {{ $upgradedFrom ? $upgradedFrom->product_name : 'N/A' }}
                            </span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid rgba(155, 89, 182, 0.2);">
                            <span style="color: #4a235a;">New Plan</span>
                            <span style="font-weight: 600; color: #4a235a;">
                                {{ $payment->product_name ?? ucwords(str_replace('_', ' ', $payment->product_type)) }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 5px 0;">
                            <span style="color: #4a235a;">Upgrade Status</span>
                            <span style="font-weight: 700; color: #28a745;">✅ Completed</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Order Details Grid -->
            <div
                style="text-align: left; background: #ffffff; border: 1px solid #f1f5f9; border-radius: 16px; padding: 20px; margin-bottom: 25px;">
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Order ID</span>
                    <strong
                        style="color: #334155; font-family: monospace; font-size: 15px;">{{ $payment->txn_ref ?? $payment->order_id }}</strong>
                </div>
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Product</span>
                    <strong
                        style="color: #334155;">{{ $payment->product_name ?? ucwords(str_replace('_', ' ', $payment->product_type ?? '')) }}</strong>
                </div>
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Payment Date</span>
                    <strong
                        style="color: #334155;">{{ $payment->paid_at ? $payment->paid_at->format('d M Y, h:i A') : 'N/A' }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #64748b; font-weight: 500;">Status</span>
                    <strong style="color: #10b981;">✅ Successful</strong>
                </div>
            </div>

            <!-- WhatsApp Action Box -->
            <div
                style="margin-bottom: 35px; padding: 20px; background: linear-gradient(135deg, #e8fbf1 0%, #d1fae5 100%); border-radius: 18px; border: 1px solid #a7f3d0;">
                <p style="color: #065f46; font-size: 15px; margin: 0 0 15px 0; font-weight: 500; line-height: 1.5;">
                    📱 <strong>Action Required:</strong> Please send your payment confirmation screenshot on WhatsApp to
                    activate your service instantly.
                </p>

                @php
                    $message = 'Hi, I have successfully made the payment';
                    $message .= ' of ₹' . number_format($payment->total_amount ?? ($payment->amount ?? 0), 2);
                    $message .=
                        ' for ' .
                        ($payment->product_name ?? ucwords(str_replace('_', ' ', $payment->product_type ?? '')));
                    if (isset($payment) && $payment->is_upgrade) {
                        $message .= ' (Upgrade)';
                    }
                    $message .= '. My Order ID is: ' . ($payment->txn_ref ?? $payment->order_id);
                    $message .= '. Please verify.';
                @endphp

                <a href="https://wa.me/919250073334?text={{ urlencode($message) }}" target="_blank"
                    style="display: inline-flex; align-items: center; justify-content: center; background: #25D366; color: white; text-decoration: none; padding: 12px 25px; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3); transition: all 0.2s ease;">
                    <span style="margin-right: 8px;">💬</span> Send Confirmation (+91 9250073334)
                </a>
            </div>

            <!-- Navigation Buttons -->
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('services') }}#reporter" class="btn"
                    style="background: #3b82f6; color: white; text-decoration: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2); transition: all 0.2s;">
                    Back to Services
                </a>
                <a href="{{ route('dashboard') }}" class="btn"
                    style="background: transparent; color: #64748b; border: 1px solid #cbd5e1; text-decoration: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 15px; transition: all 0.2s;">
                    Go to Dashboard
                </a>
                <a href="{{ route('user.products') }}" class="btn"
                    style="background: #9b59b6; color: white; text-decoration: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 12px rgba(155, 89, 182, 0.2); transition: all 0.2s;">
                    View My Products
                </a>
            </div>

            <!-- Help Text -->
            <p style="margin-top: 25px; font-size: 13px; color: #94a3b8;">
                Having issues? <a href="{{ route('contact') }}"
                    style="color: #3b82f6; text-decoration: none; font-weight: 600;">Contact Support</a>
            </p>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 576px) {
            .container>div {
                padding: 25px !important;
            }

            h1 {
                font-size: 24px !important;
            }

            .btn {
                padding: 12px 20px !important;
                font-size: 13px !important;
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .btn+.btn {
                margin-top: 8px;
            }

            .btn-group {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
@endpush
