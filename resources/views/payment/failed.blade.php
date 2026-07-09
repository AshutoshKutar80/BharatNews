@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
    <div class="container"
        style="padding: 60px 15px; min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div
            style="background: #ffffff; border-radius: 24px; box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03); padding: 40px; max-width: 550px; width: 100%; text-align: center; border: 1px solid #f1f5f9;">

            <!-- Error Indicator Banner -->
            <div style="margin-bottom: 25px;">
                <div
                    style="background: #fef2f2; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <span style="font-size: 50px; line-height: 1;">❌</span>
                </div>
                <h1 style="color: #ef4444; font-size: 32px; font-weight: 800; margin: 0 0 10px 0; letter-spacing: -0.5px;">
                    Payment Failed</h1>
                <p style="font-size: 16px; color: #64748b; margin: 0; line-height: 1.5;">Your transaction could not be
                    processed. Please check your details and try again.</p>
            </div>

            <!-- Order Details Box -->
            @if ($payment->txn_ref ?? $tempPayment->txn_ref)
                <div
                    style="text-align: left; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #64748b; font-weight: 500; font-size: 14px;">Order Reference ID</span>
                        <strong
                            style="color: #334155; font-family: monospace; font-size: 15px;">{{ $payment->txn_ref ?? $tempPayment->txn_ref }}</strong>
                    </div>
                </div>
            @endif

            <!-- Support Warning Box (Very Helpful for Users) -->
            <div
                style="margin-bottom: 35px; padding: 20px; background: #fffbeb; border-radius: 18px; border: 1px solid #fde68a; text-align: left;">
                <p style="color: #92400e; font-size: 14px; margin: 0; line-height: 1.5;">
                    💡 <strong>Note:</strong> If your money was deducted from your bank account, please do not panic. It
                    will either be refunded automatically within 3-5 business days or you can contact our support team.
                </p>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="https://wa.me/919250073334?text=Hi,%20my%20payment%20failed%20but%20amount%20was%20deducted.%20Order%20ID:%20{{ $payment->txn_ref ?? $tempPayment->txn_ref }}"
                        target="_blank"
                        style="color: #b45309; font-weight: 700; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 5px;">
                        💬 Need Help? Chat on WhatsApp
                    </a>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('services') }}#reporter" class="btn"
                    style="background: #ef4444; color: white; text-decoration: none; padding: 14px 30px; border-radius: 12px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); transition: all 0.2s;">
                    Try Again
                </a>
                <a href="{{ route('services') }}" class="btn"
                    style="background: transparent; color: #64748b; border: 1px solid #cbd5e1; text-decoration: none; padding: 14px 30px; border-radius: 12px; font-weight: 600; font-size: 15px; transition: all 0.2s;">
                    Back to Services
                </a>
            </div>

        </div>
    </div>
@endsection
