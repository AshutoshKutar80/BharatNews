@extends('layouts.app')

@section('title', 'Our Services')
@section('meta_description',
    'Services offered by Bharat Integrity Forum News - reporting, digital media coverage, and
    reporter ID registration.')

@section('content')

    {{-- ================= PAGE HERO ================= --}}
    <section class="hero" style="padding:60px 0 70px;">
        <div class="container" style="text-align:center;">
            <span class="eyebrow">Our Services</span>
            <h1 style="max-width:720px;margin:0 auto;">Trustworthy media services <span>for every need</span></h1>
            <p class="lead" style="margin:16px auto 0;">
                From news coverage to reporter ID cards — Bharat Integrity Forum News
                is your partner for every media need.
            </p>
        </div>
    </section>

    {{-- ================= SERVICES GRID ================= --}}
    <section class="bg-white-alt">
        <div class="container">
            <div class="grid-3">
                <div class="service-card reveal">
                    <span class="num">01</span>
                    <h4>News Reporting</h4>
                    <p>Verified, impartial coverage straight from the ground.</p>
                </div>
                <div class="service-card reveal delay-1">
                    <span class="num">02</span>
                    <h4>Digital Media Coverage</h4>
                    <p>Wider reach through website, social media, and video.</p>
                </div>
                <div class="service-card reveal delay-2">
                    <span class="num">03</span>
                    <h4>Press Release Publishing</h4>
                    <p>Authentic publishing for organizations and individuals.</p>
                </div>
                <div class="service-card reveal">
                    <span class="num">04</span>
                    <h4>Advertising &amp; Promotion</h4>
                    <p>Helping your brand reach the right audience.</p>
                </div>
                <div class="service-card reveal delay-1">
                    <span class="num">05</span>
                    <h4>Reporter Registration</h4>
                    <p>The chance to become a reporter with an official ID card.</p>
                </div>
                <div class="service-card reveal delay-2">
                    <span class="num">06</span>
                    <h4>Franchise / Partnership</h4>
                    <p>Partner with us in your own district or state.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= REPORTER PLANS ================= --}}
    <section id="reporter">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow">Become a Reporter</span>
                <h2>Choose the plan that fits your needs</h2>
                <p>After payment, send your details to our WhatsApp number.</p>
            </div>
            <div class="grid-3">
                <div class="plan-card reveal">
                    <h4>Reporter ID</h4>
                    <div class="price">₹1,000<span>/one-time</span></div>
                    <ul>
                        <li>Official reporter ID card</li>
                        <li>Digital identity card</li>
                        <li>Basic verification support</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline" style="width:100%;justify-content:center;">Apply Now</a>
                </div>
                <div class="plan-card featured reveal delay-1">
                    <h4>Reporter ID + Mic</h4>
                    <div class="price">₹3,500<span>/one-time</span></div>
                    <ul>
                        <li>Official reporter ID card</li>
                        <li>Branded interview microphone</li>
                        <li>Priority verification support</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary" style="width:100%;justify-content:center;">Apply Now</a>
                </div>
                <div class="plan-card reveal delay-2">
                    <h4>Wireless Mic + Reporter ID</h4>
                    <div class="price">₹7,999<span>/one-time</span></div>
                    <ul>
                        <li>Official reporter ID card</li>
                        <li>Wireless microphone setup</li>
                        <li>Full field-kit support</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline" style="width:100%;justify-content:center;">Apply Now</a>
                </div>
            </div>
        </div>
    </section>


@endsection
