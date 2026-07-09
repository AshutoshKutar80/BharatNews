@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
    <div class="container"
        style="padding: 60px 15px; min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div
            style="background: #ffffff; border-radius: 24px; box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03); padding: 40px; max-width: 550px; width: 100%; text-center: center; text-align: center; border: 1px solid #f1f5f9;">

            <!-- Success Animated Checkmark Banner -->
            <div style="margin-bottom: 25px;">
                <div
                    style="background: #e8fbf1; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <span style="font-size: 50px; line-height: 1;">✅</span>
                </div>
                <h1 style="color: #10b981; font-size: 32px; font-weight: 800; margin: 0 0 10px 0; letter-spacing: -0.5px;">
                    Payment Successful!</h1>
                <p style="font-size: 16px; color: #64748b; margin: 0;">Your transaction has been completed successfully.</p>
            </div>

            <!-- Amount Display -->
            <div
                style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px dashed #e2e8f0;">
                <span
                    style="font-size: 14px; text-transform: uppercase; tracking-spacing: 1px; color: #94a3b8; font-weight: 600;">Amount
                    Paid</span>
                <div style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 5px;">
                    ₹{{ number_format($payment->amount ?? ($tempPayment->amount ?? 0), 2) }}
                </div>
            </div>

            <!-- Order Details Grid -->
            <div
                style="text-align: left; background: #ffffff; border: 1px solid #f1f5f9; border-radius: 16px; padding: 20px; margin-bottom: 25px;">
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-weight: 500;">Order ID</span>
                    <strong
                        style="color: #334155; font-family: monospace; font-size: 15px;">{{ $payment->txn_ref ?? $tempPayment->txn_ref }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #64748b; font-weight: 500;">Product</span>
                    <strong
                        style="color: #334155;">{{ ucwords(str_replace('_', ' ', $payment->product_type ?? $tempPayment->product_type)) }}</strong>
                </div>
            </div>

            <!-- WhatsApp Action Box -->
            <div
                style="margin-bottom: 35px; padding: 20px; background: linear-gradient(135deg, #e8fbf1 0%, #d1fae5 100%); border-radius: 18px; border: 1px solid #a7f3d0;">
                <p style="color: #065f46; font-size: 15px; margin: 0 0 15px 0; font-weight: 500; line-height: 1.5;">
                    📱 <strong>Action Required:</strong> Please send your payment confirmation screenshot on WhatsApp to
                    activate your service instantly.
                </p>
                <a href="https://wa.me/919250073334?text=Hi,%20I%20have%20successfully%20made%20the%20payment%20of%20₹{{ $payment->amount ?? $tempPayment->amount }}%20for%20{{ urlencode($payment->product_type ?? $tempPayment->product_type) }}.%20My%20Order%20ID%20is:%20{{ $payment->txn_ref ?? $tempPayment->txn_ref }}.%20Please%20verify."
                    target="_blank"
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
            </div>

        </div>
    </div>
@endsection
