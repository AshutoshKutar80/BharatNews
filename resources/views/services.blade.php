@extends('layouts.app')

@section('title', 'Our Services - Bharat Integrity Forum News')
@section('meta_description',
    'Professional media services including news reporting, digital media coverage, reporter ID
    registration, press release publishing, advertising, and franchise partnerships.')
@section('meta_keywords',
    'services, news reporting, media coverage, reporter ID, press release, advertising, franchise,
    Bharat Integrity Forum')

@section('content')

    {{-- ================= PAGE HERO ================= --}}
    <section class="page-hero">
        <div class="container hero-inner">
            <span class="eyebrow eyebrow-gold">What We Offer</span>
            <h1 class="hero-title">
                Trustworthy media services <span class="text-gold">for every need</span>
            </h1>
            <p class="lead hero-lead">
                From news coverage to reporter ID cards — Bharat Integrity Forum News is your partner for every media need.
            </p>
            <div class="hero-actions">
                <a href="#services" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v8M8 12h8" />
                    </svg>
                    Explore Services
                </a>
                <a href="#reporter" class="btn btn-outline">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                    </svg>
                    Become a Reporter
                </a>
            </div>
        </div>
        <!-- Decorative elements -->
        <div class="hero-blob hero-blob--top"></div>
        <div class="hero-blob hero-blob--bottom"></div>
    </section>

    {{-- ================= SERVICES STATS ================= --}}
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="reveal stat-item">
                    <div class="stat-number">500+</div>
                    <p class="stat-label">News Reports Published</p>
                </div>
                <div class="reveal delay-1 stat-item">
                    <div class="stat-number">100+</div>
                    <p class="stat-label">Registered Reporters</p>
                </div>
                <div class="reveal delay-2 stat-item">
                    <div class="stat-number">50+</div>
                    <p class="stat-label">Media Partners</p>
                </div>
                <div class="reveal delay-3 stat-item">
                    <div class="stat-number">98%</div>
                    <p class="stat-label">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SERVICES GRID ================= --}}
    <section class="bg-white-alt services-section" id="services">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow-red">Our Core Services</span>
                <h2 class="section-title">Comprehensive Media Solutions</h2>
                <p class="section-sub">Professional services designed to meet all your media and reporting needs</p>
            </div>

            <div class="grid-3 services-grid">

                {{-- Service 1 --}}
                <div class="service-card reveal service-card--red">
                    <span class="num num--red">01</span>
                    <div class="service-icon service-icon--red">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h4 class="service-title">News Reporting</h4>
                    <p class="service-desc">Verified, impartial coverage straight from the ground. Our team delivers
                        accurate and timely news reports.</p>
                    <a href="#contact" class="service-link service-link--red">Learn More →</a>
                </div>

                {{-- Service 2 --}}
                <div class="service-card reveal delay-1 service-card--blue">
                    <span class="num num--blue">02</span>
                    <div class="service-icon service-icon--blue">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="2" />
                            <path d="M8 2v20M16 2v20M2 8h20M2 16h20" />
                        </svg>
                    </div>
                    <h4 class="service-title">Digital Media Coverage</h4>
                    <p class="service-desc">Wider reach through website, social media, and video. Amplify your message
                        across all digital platforms.</p>
                    <a href="#contact" class="service-link service-link--blue">Learn More →</a>
                </div>

                {{-- Service 3 --}}
                <div class="service-card reveal delay-2 service-card--green">
                    <span class="num num--green">03</span>
                    <div class="service-icon service-icon--green">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                            stroke-width="2">
                            <path d="M4 4h16v16H4z" />
                            <path d="M8 4v16M16 4v16M4 8h16M4 16h16" />
                        </svg>
                    </div>
                    <h4 class="service-title">Press Release Publishing</h4>
                    <p class="service-desc">Authentic publishing for organizations and individuals. Get your news
                        featured on our platform.</p>
                    <a href="#contact" class="service-link service-link--green">Learn More →</a>
                </div>

                {{-- Service 4 --}}
                <div class="service-card reveal service-card--orange">
                    <span class="num num--orange">04</span>
                    <div class="service-icon service-icon--orange">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f39c12"
                            stroke-width="2">
                            <path d="M12 2v20M2 12h20" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                    </div>
                    <h4 class="service-title">Advertising &amp; Promotion</h4>
                    <p class="service-desc">Helping your brand reach the right audience through targeted advertising and
                        promotional campaigns.</p>
                    <a href="#contact" class="service-link service-link--orange">Learn More →</a>
                </div>

                {{-- Service 5 --}}
                <div class="service-card reveal delay-1 service-card--purple">
                    <span class="num num--purple">05</span>
                    <div class="service-icon service-icon--purple">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9b59b6"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <path d="M8 10h8" />
                        </svg>
                    </div>
                    <h4 class="service-title">Reporter Registration</h4>
                    <p class="service-desc">The chance to become a reporter with an official ID card. Join our growing
                        network of journalists.</p>
                    <a href="#reporter" class="service-link service-link--purple">Book Now →</a>
                </div>

                {{-- Service 6 --}}
                <div class="service-card reveal delay-2 service-card--teal">
                    <span class="num num--teal">06</span>
                    <div class="service-icon service-icon--teal">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1abc9c"
                            stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <h4 class="service-title">Franchise / Partnership</h4>
                    <p class="service-desc">Partner with us in your own district or state. Expand your reach with our
                        trusted brand name.</p>
                    <a href="#contact" class="service-link service-link--teal">Partner Now →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= WHY CHOOSE US ================= --}}
    <section class="why-section">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow-red">Why Choose Us</span>
                <h2 class="section-title">Setting the Standard in Media Services</h2>
                <p class="section-sub">What makes Bharat Integrity Forum your trusted media partner</p>
            </div>

            <div class="why-grid">

                <div class="reveal why-card">
                    <div class="why-icon why-icon--red">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                            <path d="M8 12h8M12 8v8" />
                        </svg>
                    </div>
                    <h4 class="why-title">Verified Reporting</h4>
                    <p class="why-desc">Fact-checked and impartial news delivered with integrity</p>
                </div>

                <div class="reveal delay-1 why-card">
                    <div class="why-icon why-icon--blue">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="2" />
                            <path d="M8 2v20M16 2v20M2 8h20M2 16h20" />
                        </svg>
                    </div>
                    <h4 class="why-title">Wide Reach</h4>
                    <p class="why-desc">Multi-platform coverage across digital and social media</p>
                </div>

                <div class="reveal delay-2 why-card">
                    <div class="why-icon why-icon--green">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                            stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <h4 class="why-title">Professional Network</h4>
                    <p class="why-desc">Connect with experienced journalists and media professionals</p>
                </div>

                <div class="reveal delay-3 why-card">
                    <div class="why-icon why-icon--orange">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#f39c12"
                            stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <path d="M22 4L12 14.01l-3-3" />
                        </svg>
                    </div>
                    <h4 class="why-title">Trusted Brand</h4>
                    <p class="why-desc">Reliable and authentic media services with proven track record</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= REPORTER PLANS ================= --}}
    <section id="reporter" class="reporter-section">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow-red">Become a Reporter</span>
                <h2 class="section-title">Choose the plan that fits your needs</h2>
                <p class="section-sub">After payment, send your details to our WhatsApp number</p>
            </div>

            <div class="grid-3 plans-grid">

                {{-- Plan 1 --}}
                <div class="plan-card reveal">
                    <div class="plan-icon plan-icon--blue">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h4 class="plan-title">Reporter ID</h4>
                    <div class="price">
                        <span class="price-amount">₹999</span>
                        <span class="price-period">/one-time</span>
                    </div>
                    <ul class="plan-features">
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Digital identity card
                        </li>
                        <li class="no-border">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Basic verification support
                        </li>
                    </ul>
                    <button class="btn btn-outline plan-btn plan-btn--blue book-now-btn" data-product="reporter_id">
                        Book Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                {{-- Plan 2 (Featured) --}}
                <div class="plan-card featured reveal delay-1">
                    <div class="plan-badge">Most Popular</div>
                    <div class="plan-icon plan-icon--red">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <circle cx="8" cy="8" r="1" />
                        </svg>
                    </div>
                    <h4 class="plan-title">Reporter ID + Mic</h4>
                    <div class="price">
                        <span class="price-amount">₹3,499</span>
                        <span class="price-period">/one-time</span>
                    </div>
                    <ul class="plan-features">
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Branded interview microphone
                        </li>
                        <li class="no-border">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Priority verification support
                        </li>
                    </ul>
                    <button class="btn btn-primary plan-btn book-now-btn" data-product="reporter_mic">
                        Book Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                {{-- Plan 3 --}}
                <div class="plan-card reveal delay-2">
                    <div class="plan-icon plan-icon--purple">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#9b59b6"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <path d="M8 16l4-4" />
                        </svg>
                    </div>
                    <h4 class="plan-title">Wireless Mic + Reporter ID</h4>
                    <div class="price">
                        <span class="price-amount">₹7,999</span>
                        <span class="price-period">/one-time</span>
                    </div>
                    <ul class="plan-features">
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Wireless microphone setup
                        </li>
                        <li class="no-border">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Full field-kit support
                        </li>
                    </ul>
                    <button class="btn btn-outline plan-btn plan-btn--purple book-now-btn" data-product="wireless_mic">
                        Apply Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="whatsapp-note-wrap">
                <div class="whatsapp-note">
                    <p>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#25D366"
                            stroke-width="2" class="whatsapp-icon">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                        </svg>
                        Send payment confirmation on WhatsApp: <strong class="whatsapp-number">+91 9250073334</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>


    {{-- ================= TESTIMONIALS ================= --}}
    <section class="testimonials-section">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow-red">Testimonials</span>
                <h2 class="section-title">What Our Clients Say</h2>
                <p class="section-sub">Real feedback from real people</p>
            </div>

            <div class="testimonials-grid">
                <div class="reveal testimonial-card testimonial-card--red">
                    <div class="testimonial-head">
                        <div class="testimonial-avatar testimonial-avatar--red">AK</div>
                        <div>
                            <h5 class="testimonial-name">Amit Kumar</h5>
                            <p class="testimonial-role">Registered Reporter</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"The reporter ID process was seamless. The team at Bharat Integrity Forum
                        is professional and supportive."</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>

                <div class="reveal delay-1 testimonial-card testimonial-card--blue">
                    <div class="testimonial-head">
                        <div class="testimonial-avatar testimonial-avatar--blue">PS</div>
                        <div>
                            <h5 class="testimonial-name">Priya Sharma</h5>
                            <p class="testimonial-role">Media Partner</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Excellent digital media coverage! Our brand reached a wider audience
                        through their platform."</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>

                <div class="reveal delay-2 testimonial-card testimonial-card--green">
                    <div class="testimonial-head">
                        <div class="testimonial-avatar testimonial-avatar--green">RV</div>
                        <div>
                            <h5 class="testimonial-name">Rajesh Verma</h5>
                            <p class="testimonial-role">Franchise Partner</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Partnering with Bharat Integrity Forum was the best decision. Their
                        support and guidance are unmatched."</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA SECTION ================= --}}
    <section class="cta-section">
        <div class="container">
            <div class="cta-inner">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-text">Join Bharat Integrity Forum News today and take your media journey to the next level.
                </p>
                <div class="cta-actions">
                    <a href="#contact" class="btn btn-primary cta-btn">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Contact Us
                    </a>
                    <a href="#reporter" class="btn btn-outline cta-btn">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                        </svg>
                        Apply as Reporter
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.15s;
        }

        .delay-2 {
            transition-delay: 0.3s;
        }

        .delay-3 {
            transition-delay: 0.45s;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #e74c3c;
            color: #fff;
            padding: 14px 35px;
            border: none;
        }

        .btn-primary:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: #fff;
            padding: 14px 35px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline:hover {
            border-color: #fff;
            transform: translateY(-2px);
        }

        /* ===== Shared section heading ===== */
        .section-head {
            text-align: center;
            margin-bottom: 50px;
        }

        .eyebrow-red {
            color: #e74c3c;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 13px;
            display: inline-block;
        }

        .eyebrow-gold {
            color: #f39c12;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: 14px;
            display: inline-block;
        }

        .text-gold {
            color: #f39c12;
        }

        .section-title {
            font-size: 36px;
            margin: 10px 0 15px;
            color: #1a1a2e;
        }

        .section-sub {
            color: #666;
            max-width: 550px;
            margin: 0 auto;
            font-size: 16px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        /* ===================================================== */
        /* =================   PAGE HERO   ====================== */
        /* ===================================================== */
        .page-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 80px 0 70px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            max-width: 720px;
            margin: 15px auto 20px;
            font-size: 44px;
            font-weight: 700;
            line-height: 1.2;
            color: #ccc;
        }

        .hero-lead {
            max-width: 600px;
            margin: 0 auto;
            font-size: 18px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .hero-actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
        }

        .hero-blob--top {
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: rgba(231, 76, 60, 0.1);
        }

        .hero-blob--bottom {
            bottom: -80px;
            left: -30px;
            width: 200px;
            height: 200px;
            background: rgba(243, 156, 18, 0.08);
        }

        /* ===================================================== */
        /* =================   STATS   ========================== */
        /* ===================================================== */
        .stats-section {
            padding: 50px 0;
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            text-align: center;
        }

        .stat-number {
            font-size: 40px;
            font-weight: 700;
            color: #e74c3c;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        /* ===================================================== */
        /* ==============   SERVICES GRID   ====================== */
        /* ===================================================== */
        .services-section {
            padding: 80px 0;
        }

        .service-card {
            background: #fff;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid transparent;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .service-card--red {
            border-bottom-color: #e74c3c;
        }

        .service-card--blue {
            border-bottom-color: #3498db;
        }

        .service-card--green {
            border-bottom-color: #2ecc71;
        }

        .service-card--orange {
            border-bottom-color: #f39c12;
        }

        .service-card--purple {
            border-bottom-color: #9b59b6;
        }

        .service-card--teal {
            border-bottom-color: #1abc9c;
        }

        .num {
            font-size: 48px;
            font-weight: 800;
            position: absolute;
            top: 10px;
            right: 20px;
            line-height: 1;
        }

        .num--red {
            color: rgba(231, 76, 60, 0.08);
        }

        .num--blue {
            color: rgba(52, 152, 219, 0.08);
        }

        .num--green {
            color: rgba(46, 204, 113, 0.08);
        }

        .num--orange {
            color: rgba(243, 156, 18, 0.08);
        }

        .num--purple {
            color: rgba(155, 89, 182, 0.08);
        }

        .num--teal {
            color: rgba(26, 188, 156, 0.08);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .service-icon--red {
            background: rgba(231, 76, 60, 0.1);
        }

        .service-icon--blue {
            background: rgba(52, 152, 219, 0.1);
        }

        .service-icon--green {
            background: rgba(46, 204, 113, 0.1);
        }

        .service-icon--orange {
            background: rgba(243, 156, 18, 0.1);
        }

        .service-icon--purple {
            background: rgba(155, 89, 182, 0.1);
        }

        .service-icon--teal {
            background: rgba(26, 188, 156, 0.1);
        }

        .service-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 10px;
        }

        .service-desc {
            color: #666;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }

        .service-link {
            display: inline-block;
            margin-top: 18px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .service-link--red {
            color: #e74c3c;
        }

        .service-link--blue {
            color: #3498db;
        }

        .service-link--green {
            color: #2ecc71;
        }

        .service-link--orange {
            color: #f39c12;
        }

        .service-link--purple {
            color: #9b59b6;
        }

        .service-link--teal {
            color: #1abc9c;
        }

        /* ===================================================== */
        /* =================   WHY CHOOSE US   =================== */
        /* ===================================================== */
        .why-section {
            padding: 80px 0;
            background: #fff;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .why-card {
            text-align: center;
            padding: 30px 20px;
            background: #f8f9fa;
            border-radius: 16px;
            transition: all 0.3s;
        }

        .why-card:hover {
            transform: translateY(-5px);
        }

        .why-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .why-icon--red {
            background: rgba(231, 76, 60, 0.1);
        }

        .why-icon--blue {
            background: rgba(52, 152, 219, 0.1);
        }

        .why-icon--green {
            background: rgba(46, 204, 113, 0.1);
        }

        .why-icon--orange {
            background: rgba(243, 156, 18, 0.1);
        }

        .why-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .why-desc {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* ===================================================== */
        /* =================   REPORTER PLANS   =================== */
        /* ===================================================== */
        .reporter-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .plans-grid {
            max-width: 1000px;
            margin: 0 auto;
        }

        .plan-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
            position: relative;
        }

        .plan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .plan-card.featured {
            box-shadow: 0 10px 40px rgba(231, 76, 60, 0.15);
            border: 2px solid #e74c3c;
            transform: scale(1.02);
        }

        .plan-card.featured:hover {
            transform: scale(1.04);
            box-shadow: 0 25px 60px rgba(231, 76, 60, 0.25);
        }

        .plan-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #e74c3c;
            color: #fff;
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .plan-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .plan-icon--blue {
            background: rgba(52, 152, 219, 0.1);
        }

        .plan-icon--red {
            background: rgba(231, 76, 60, 0.1);
        }

        .plan-icon--purple {
            background: rgba(155, 89, 182, 0.1);
        }

        .plan-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 5px;
        }

        .price {
            margin: 15px 0 20px;
        }

        .price-amount {
            font-size: 36px;
            font-weight: 800;
            color: #e74c3c;
        }

        .price-period {
            color: #888;
            font-size: 14px;
            display: block;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 25px;
            text-align: left;
        }

        .plan-features li {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #555;
        }

        .plan-features li.no-border {
            border-bottom: none;
        }

        .plan-btn {
            width: 100%;
            justify-content: center;
            padding: 14px;
        }

        .btn-outline.plan-btn--blue {
            border-color: #3498db;
            color: #3498db;
        }

        .btn-outline.plan-btn--blue:hover {
            background: #3498db;
            color: #fff;
        }

        .btn-outline.plan-btn--purple {
            border-color: #9b59b6;
            color: #9b59b6;
        }

        .btn-outline.plan-btn--purple:hover {
            background: #9b59b6;
            color: #fff;
        }

        .whatsapp-note-wrap {
            text-align: center;
            margin-top: 40px;
        }

        .whatsapp-note {
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .whatsapp-note p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .whatsapp-icon {
            vertical-align: middle;
            margin-right: 8px;
        }

        .whatsapp-number {
            color: #25D366;
        }

        /* ===================================================== */
        /* =================   TESTIMONIALS   ==================== */
        /* ===================================================== */
        .testimonials-section {
            padding: 80px 0;
            background: #fff;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
            border-left: 4px solid transparent;
        }

        .testimonial-card--red {
            border-left-color: #e74c3c;
        }

        .testimonial-card--blue {
            border-left-color: #3498db;
        }

        .testimonial-card--green {
            border-left-color: #2ecc71;
        }

        .testimonial-head {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .testimonial-avatar--red {
            background: #e74c3c;
        }

        .testimonial-avatar--blue {
            background: #3498db;
        }

        .testimonial-avatar--green {
            background: #2ecc71;
        }

        .testimonial-name {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        .testimonial-role {
            font-size: 13px;
            color: #888;
            margin: 0;
        }

        .testimonial-text {
            color: #555;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }

        .testimonial-stars {
            margin-top: 12px;
            color: #f39c12;
        }

        /* ===================================================== */
        /* =================   CTA SECTION   ====================== */
        /* ===================================================== */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
        }

        .cta-inner {
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ccc;
        }

        .cta-text {
            color: #ccc;
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .cta-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 16px 45px;
            font-size: 16px;
        }

        /* ===================================================== */
        /* ==================   RESPONSIVE   ===================== */
        /* ===================================================== */
        @media (max-width: 992px) {

            .grid-3,
            .why-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .section-title {
                font-size: 28px !important;
            }

            .stats-grid {
                gap: 25px;
            }
        }

        @media (max-width: 768px) {

            .grid-3,
            .why-grid,
            .testimonials-grid {
                grid-template-columns: 1fr !important;
            }

            .hero-title {
                font-size: 28px !important;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .plan-card.featured {
                transform: scale(1) !important;
            }

            .plan-card.featured:hover {
                transform: scale(1.02) !important;
            }

            .section-title {
                font-size: 24px !important;
            }
        }

        @media (max-width: 576px) {

            .page-hero,
            .services-section,
            .why-section,
            .reporter-section,
            .testimonials-section,
            .cta-section {
                padding: 50px 0;
            }

            .stats-section {
                padding: 35px 0;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 20px;
            }

            .stat-number {
                font-size: 30px;
            }

            .hero-title {
                font-size: 24px !important;
            }

            .hero-lead {
                font-size: 15px;
            }

            .hero-actions,
            .cta-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-actions .btn,
            .cta-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .service-card,
            .plan-card,
            .why-card,
            .testimonial-card {
                padding: 25px 20px;
            }

            .plan-card.featured {
                transform: scale(1) !important;
            }

            .whatsapp-note {
                padding: 16px 20px;
            }

            .whatsapp-note p {
                font-size: 13px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reveal animations
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1
            });

            reveals.forEach(el => observer.observe(el));

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Animate stats counter (optional)
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = Math.ceil(target / 50);
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = target + '+';
                        clearInterval(timer);
                    } else {
                        stat.textContent = current + '+';
                    }
                }, 30);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Cashfree JS SDK -->
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reveal animations
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1
            });

            reveals.forEach(el => observer.observe(el));

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Animate stats counter
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = Math.ceil(target / 50);
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = target + '+';
                        clearInterval(timer);
                    } else {
                        stat.textContent = current + '+';
                    }
                }, 30);
            });

            // ============================================================
            // PAYMENT INTEGRATION
            // ============================================================
            const bookNowBtns = document.querySelectorAll('.book-now-btn');

            bookNowBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productType = this.dataset.product;
                    initiatePayment(productType);
                });
            });

            function initiatePayment(productType) {
                // Show loading
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we prepare your payment',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch("{{ route('payment.initiate') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            product_type: productType
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close();

                        if (!data.success) {
                            console.log(data.redirect);
                            if (data.redirect) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Login Required',
                                    text: 'Please login to continue with payment',
                                    confirmButtonColor: '#e74c3c',
                                    confirmButtonText: 'Login Now'
                                }).then(() => {
                                    window.location.href = data.redirect;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Payment Initiation Failed',
                                    text: data.message || 'Something went wrong. Please try again.',
                                    confirmButtonColor: '#e74c3c'
                                });
                            }
                            return;
                        }

                        // Get product name for display
                        const productNames = {
                            'reporter_id': 'Reporter ID',
                            'reporter_mic': 'Reporter ID + Mic',
                            'wireless_mic': 'Wireless Mic + Reporter ID'
                        };

                        // Show confirmation
                        Swal.fire({
                            icon: 'question',
                            title: 'Confirm Payment',
                            html: `
                            <div style="text-align: center; padding: 10px 0;">
                                <div style="font-size: 48px; margin-bottom: 15px;">💳</div>
                                <p style="font-size: 18px; font-weight: 600; color: #1a1a2e;">
                                    ${productNames[productType] || data.product_name}
                                </p>
                                <p style="font-size: 28px; font-weight: 800; color: #e74c3c; margin: 10px 0;">
                                    ₹${data.amount}
                                </p>
                                <p style="font-size: 14px; color: #888; margin-top: 10px;">
                                    You will be redirected to the payment gateway
                                </p>
                                <p style="font-size: 12px; color: #aaa; margin-top: 5px;">
                                    Order ID: ${data.order_id}
                                </p>
                            </div>
                        `,
                            confirmButtonColor: '#2ecc71',
                            confirmButtonText: '✅ Proceed to Pay',
                            showCancelButton: true,
                            cancelButtonColor: '#e74c3c',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Initialize Cashfree
                                const cashfree = new Cashfree({
                                    mode: "{{ config('services.cashfree.env') === 'production' ? 'production' : 'sandbox' }}"
                                });

                                // Open payment checkout
                                let checkoutOptions = {
                                    paymentSessionId: data.payment_session_id,
                                    redirectTarget: "_self"
                                };

                                cashfree.checkout(checkoutOptions);
                            }
                        });
                    })
                    .catch(error => {
                        Swal.close();
                        console.error('Payment error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.',
                            confirmButtonColor: '#e74c3c'
                        });
                    });
            }

            // Handle payment return page
            if (window.location.pathname.includes('/payment/callback')) {
                const urlParams = new URLSearchParams(window.location.search);
                const orderId = urlParams.get('order_id');

                if (orderId) {
                    let attempts = 0;
                    const maxAttempts = 10;

                    function checkPaymentStatus() {
                        attempts++;

                        fetch(`/payment/status/${orderId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '🎉 Payment Successful!',
                                        text: 'Thank you for your payment. Your reporter ID will be processed soon.',
                                        confirmButtonColor: '#2ecc71',
                                        confirmButtonText: 'Continue'
                                    }).then(() => {
                                        window.location.href = '/payment/success?order_id=' + orderId;
                                    });
                                } else if (data.status === 'failed') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Payment Failed',
                                        text: 'Your payment was not successful. Please try again.',
                                        confirmButtonColor: '#e74c3c',
                                        confirmButtonText: 'Try Again'
                                    }).then(() => {
                                        window.location.href = '/payment/failed?order_id=' + orderId;
                                    });
                                } else if (data.status === 'pending' || data.status === 'processing') {
                                    if (attempts < maxAttempts) {
                                        setTimeout(checkPaymentStatus, 3000);
                                    } else {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Still Processing',
                                            text: 'Payment is taking longer than expected. Please check your email or contact support.',
                                            confirmButtonColor: '#3498db'
                                        }).then(() => {
                                            window.location.href = '/payment/failed?order_id=' +
                                                orderId;
                                        });
                                    }
                                } else {
                                    window.location.href = '/payment/failed?order_id=' + orderId;
                                }
                            })
                            .catch(() => {
                                if (attempts < maxAttempts) {
                                    setTimeout(checkPaymentStatus, 3000);
                                } else {
                                    window.location.href = '/payment/failed?order_id=' + orderId;
                                }
                            });
                    }

                    // Start checking after 2 seconds
                    setTimeout(checkPaymentStatus, 2000);
                }
            }
        });
    </script>
@endpush
