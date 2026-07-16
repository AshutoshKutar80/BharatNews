{{-- resources/views/payment/failed.blade.php --}}

@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
    <div class="container"
        style="padding: 60px 15px; min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div
            style="background: #ffffff; border-radius: 24px; box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03); padding: 40px; max-width: 500px; width: 100%; text-align: center; border: 1px solid #f1f5f9;">

            <!-- Error Banner -->
            <div style="margin-bottom: 25px;">
                <div
                    style="background: #fef2f2; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <span style="font-size: 50px; line-height: 1;">❌</span>
                </div>
                <h1 style="color: #dc2626; font-size: 32px; font-weight: 800; margin: 0 0 10px 0; letter-spacing: -0.5px;">
                    Payment Failed</h1>
                <p style="font-size: 16px; color: #64748b; margin: 0;">Your payment could not be processed successfully.</p>
            </div>

            <!-- Order Details -->
            <div
                style="text-align: left; background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Order ID</span>
                    <strong
                        style="color: #334155; font-family: monospace; font-size: 15px;">{{ $tempPayment->txn_ref ?? 'N/A' }}</strong>
                </div>
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Product</span>
                    <strong
                        style="color: #334155;">{{ ucwords(str_replace('_', ' ', $tempPayment->product_type ?? '')) }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #64748b; font-weight: 500;">Amount</span>
                    <strong
                        style="color: #334155;">₹{{ number_format($tempPayment->total_amount ?? ($tempPayment->amount ?? 0), 2) }}</strong>
                </div>
                @if (isset($tempPayment) && $tempPayment->is_upgrade)
                    <div
                        style="display: flex; justify-content: space-between; margin-top: 12px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-weight: 500;">Type</span>
                        <strong style="color: #9b59b6;">🔄 Upgrade</strong>
                    </div>
                @endif
            </div>

            <!-- Error Message -->
            <div
                style="background: #fef2f2; border-radius: 12px; padding: 15px; margin-bottom: 25px; border: 1px solid #fca5a5;">
                <p style="color: #dc2626; font-size: 14px; margin: 0;">
                    <strong>⚠️ Something went wrong:</strong><br>
                    {{ $tempPayment->raw_response['message'] ?? 'Your payment was declined or cancelled. Please try again.' }}
                </p>
            </div>

            <!-- Try Again Options -->
            <div style="margin-bottom: 25px;">
                <h4 style="color: #1a1a2e; font-size: 16px; margin: 0 0 15px 0;">What would you like to do?</h4>
                <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('services') }}#reporter" class="btn"
                        style="background: #3b82f6; color: white; text-decoration: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2); transition: all 0.2s;">
                        🔄 Try Again
                    </a>
                    <a href="{{ route('services') }}" class="btn"
                        style="background: transparent; color: #64748b; border: 1px solid #cbd5e1; text-decoration: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 15px; transition: all 0.2s;">
                        Browse Services
                    </a>
                </div>
            </div>

            <!-- Help Section -->
            <div style="background: #f0f7ff; border-radius: 12px; padding: 15px; border: 1px solid #93c5fd;">
                <p style="color: #1e40af; font-size: 14px; margin: 0 0 5px 0;">
                    <strong>💡 Need help?</strong>
                </p>
                <p style="color: #1e40af; font-size: 13px; margin: 0;">
                    Contact us on WhatsApp at <strong>+91 9250073334</strong>
                </p>
            </div>

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
