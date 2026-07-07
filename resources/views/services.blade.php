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
    <section class="page-hero"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 80px 0 70px; color: #fff; text-align: center; position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <span class="eyebrow"
                style="color: #f39c12; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; font-size: 14px; display: inline-block;">What
                We Offer</span>
            <h1
                style="max-width: 720px; margin: 15px auto 20px; font-size: 44px; font-weight: 700; line-height: 1.2; color:#ccc">
                Trustworthy media services <span style="color: #f39c12;">for every need</span>
            </h1>
            <p class="lead" style="max-width: 600px; margin: 0 auto; font-size: 18px; opacity: 0.9; line-height: 1.8;">
                From news coverage to reporter ID cards — Bharat Integrity Forum News is your partner for every media need.
            </p>
            <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="#services" class="btn btn-primary"
                    style="background: #e74c3c; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                    onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v8M8 12h8" />
                    </svg>
                    Explore Services
                </a>
                <a href="#reporter" class="btn btn-outline"
                    style="background: transparent; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                    onmouseover="this.style.borderColor='#fff'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                    </svg>
                    Become a Reporter
                </a>
            </div>
        </div>
        <!-- Decorative elements -->
        <div
            style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(231, 76, 60, 0.1); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; bottom: -80px; left: -30px; width: 200px; height: 200px; background: rgba(243, 156, 18, 0.08); border-radius: 50%;">
        </div>
    </section>

    {{-- ================= SERVICES STATS ================= --}}
    <section style="padding: 50px 0; background: #fff; border-bottom: 1px solid #f0f0f0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center;">
                <div class="reveal">
                    <div style="font-size: 40px; font-weight: 700; color: #e74c3c; margin-bottom: 5px;">500+</div>
                    <p style="color: #666; font-size: 14px; margin: 0;">News Reports Published</p>
                </div>
                <div class="reveal delay-1">
                    <div style="font-size: 40px; font-weight: 700; color: #e74c3c; margin-bottom: 5px;">100+</div>
                    <p style="color: #666; font-size: 14px; margin: 0;">Registered Reporters</p>
                </div>
                <div class="reveal delay-2">
                    <div style="font-size: 40px; font-weight: 700; color: #e74c3c; margin-bottom: 5px;">50+</div>
                    <p style="color: #666; font-size: 14px; margin: 0;">Media Partners</p>
                </div>
                <div class="reveal delay-3">
                    <div style="font-size: 40px; font-weight: 700; color: #e74c3c; margin-bottom: 5px;">98%</div>
                    <p style="color: #666; font-size: 14px; margin: 0;">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SERVICES GRID ================= --}}
    <section class="bg-white-alt" id="services" style="padding: 80px 0;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Our
                    Core Services</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Comprehensive Media Solutions</h2>
                <p style="color: #666; max-width: 550px; margin: 0 auto; font-size: 16px;">Professional services designed to
                    meet all your media and reporting needs</p>
            </div>

            <div class="grid-3" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">

                {{-- Service 1 --}}
                <div class="service-card reveal"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #e74c3c;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(231, 76, 60, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">01</span>
                    <div
                        style="background: rgba(231, 76, 60, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">News Reporting</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Verified, impartial coverage
                        straight from the ground. Our team delivers accurate and timely news reports.</p>
                    <a href="#contact"
                        style="display: inline-block; margin-top: 18px; color: #e74c3c; text-decoration: none; font-weight: 600; font-size: 14px;">Learn
                        More →</a>
                </div>

                {{-- Service 2 --}}
                <div class="service-card reveal delay-1"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #3498db;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(52, 152, 219, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">02</span>
                    <div
                        style="background: rgba(52, 152, 219, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="2" />
                            <path d="M8 2v20M16 2v20M2 8h20M2 16h20" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Digital Media
                        Coverage</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Wider reach through website,
                        social media, and video. Amplify your message across all digital platforms.</p>
                    <a href="#contact"
                        style="display: inline-block; margin-top: 18px; color: #3498db; text-decoration: none; font-weight: 600; font-size: 14px;">Learn
                        More →</a>
                </div>

                {{-- Service 3 --}}
                <div class="service-card reveal delay-2"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #2ecc71;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(46, 204, 113, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">03</span>
                    <div
                        style="background: rgba(46, 204, 113, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                            stroke-width="2">
                            <path d="M4 4h16v16H4z" />
                            <path d="M8 4v16M16 4v16M4 8h16M4 16h16" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Press Release
                        Publishing</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Authentic publishing for
                        organizations and individuals. Get your news featured on our platform.</p>
                    <a href="#contact"
                        style="display: inline-block; margin-top: 18px; color: #2ecc71; text-decoration: none; font-weight: 600; font-size: 14px;">Learn
                        More →</a>
                </div>

                {{-- Service 4 --}}
                <div class="service-card reveal"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #f39c12;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(243, 156, 18, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">04</span>
                    <div
                        style="background: rgba(243, 156, 18, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f39c12"
                            stroke-width="2">
                            <path d="M12 2v20M2 12h20" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Advertising &amp;
                        Promotion</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Helping your brand reach the
                        right audience through targeted advertising and promotional campaigns.</p>
                    <a href="#contact"
                        style="display: inline-block; margin-top: 18px; color: #f39c12; text-decoration: none; font-weight: 600; font-size: 14px;">Learn
                        More →</a>
                </div>

                {{-- Service 5 --}}
                <div class="service-card reveal delay-1"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #9b59b6;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(155, 89, 182, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">05</span>
                    <div
                        style="background: rgba(155, 89, 182, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9b59b6"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <path d="M8 10h8" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Reporter
                        Registration</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">The chance to become a reporter
                        with an official ID card. Join our growing network of journalists.</p>
                    <a href="#reporter"
                        style="display: inline-block; margin-top: 18px; color: #9b59b6; text-decoration: none; font-weight: 600; font-size: 14px;">Apply
                        Now →</a>
                </div>

                {{-- Service 6 --}}
                <div class="service-card reveal delay-2"
                    style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; border-bottom: 4px solid #1abc9c;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <span class="num"
                        style="font-size: 48px; font-weight: 800; color: rgba(26, 188, 156, 0.08); position: absolute; top: 10px; right: 20px; line-height: 1;">06</span>
                    <div
                        style="background: rgba(26, 188, 156, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1abc9c"
                            stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Franchise /
                        Partnership</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Partner with us in your own
                        district or state. Expand your reach with our trusted brand name.</p>
                    <a href="#contact"
                        style="display: inline-block; margin-top: 18px; color: #1abc9c; text-decoration: none; font-weight: 600; font-size: 14px;">Partner
                        Now →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= WHY CHOOSE US ================= --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Why
                    Choose Us</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Setting the Standard in Media Services
                </h2>
                <p style="color: #666; max-width: 550px; margin: 0 auto; font-size: 16px;">What makes Bharat Integrity
                    Forum your trusted media partner</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">

                <div class="reveal"
                    style="text-align: center; padding: 30px 20px; background: #f8f9fa; border-radius: 16px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    <div
                        style="background: rgba(231, 76, 60, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                            <path d="M8 12h8M12 8v8" />
                        </svg>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">Verified Reporting
                    </h4>
                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Fact-checked and impartial news
                        delivered with integrity</p>
                </div>

                <div class="reveal delay-1"
                    style="text-align: center; padding: 30px 20px; background: #f8f9fa; border-radius: 16px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    <div
                        style="background: rgba(52, 152, 219, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="2" />
                            <path d="M8 2v20M16 2v20M2 8h20M2 16h20" />
                        </svg>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">Wide Reach</h4>
                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Multi-platform coverage across
                        digital and social media</p>
                </div>

                <div class="reveal delay-2"
                    style="text-align: center; padding: 30px 20px; background: #f8f9fa; border-radius: 16px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    <div
                        style="background: rgba(46, 204, 113, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                            stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">Professional Network
                    </h4>
                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Connect with experienced
                        journalists and media professionals</p>
                </div>

                <div class="reveal delay-3"
                    style="text-align: center; padding: 30px 20px; background: #f8f9fa; border-radius: 16px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    <div
                        style="background: rgba(243, 156, 18, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#f39c12"
                            stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <path d="M22 4L12 14.01l-3-3" />
                        </svg>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">Trusted Brand</h4>
                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Reliable and authentic media
                        services with proven track record</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= REPORTER PLANS ================= --}}
    <section id="reporter" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Become
                    a Reporter</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Choose the plan that fits your needs</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">After payment, send your details
                    to our WhatsApp number</p>
            </div>

            <div class="grid-3"
                style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 1000px; margin: 0 auto;">

                {{-- Plan 1 --}}
                <div class="plan-card reveal"
                    style="background: #fff; padding: 40px 30px; border-radius: 16px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <div
                        style="background: rgba(52, 152, 219, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#3498db"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Reporter ID</h4>
                    <div class="price" style="margin: 15px 0 20px;">
                        <span style="font-size: 36px; font-weight: 800; color: #e74c3c;">₹1,000</span>
                        <span style="color: #888; font-size: 14px; display: block;">/one-time</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0 0 25px; text-align: left;">
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Digital identity card
                        </li>
                        <li
                            style="padding: 8px 0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Basic verification support
                        </li>
                    </ul>
                    <a href="#contact" class="btn btn-outline"
                        style="width:100%; justify-content:center; padding: 14px; border: 2px solid #3498db; color: #3498db; background: transparent; border-radius: 30px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;"
                        onmouseover="this.style.background='#3498db'; this.style.color='#fff'"
                        onmouseout="this.style.background='transparent'; this.style.color='#3498db'">
                        Apply Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Plan 2 (Featured) --}}
                <div class="plan-card featured reveal delay-1"
                    style="background: #fff; padding: 40px 30px; border-radius: 16px; text-align: center; box-shadow: 0 10px 40px rgba(231, 76, 60, 0.15); transition: all 0.3s; position: relative; border: 2px solid #e74c3c; transform: scale(1.02);"
                    onmouseover="this.style.transform='scale(1.04)'; this.style.boxShadow='0 25px 60px rgba(231, 76, 60, 0.25)'"
                    onmouseout="this.style.transform='scale(1.02)'; this.style.boxShadow='0 10px 40px rgba(231, 76, 60, 0.15)'">
                    <div
                        style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #e74c3c; color: #fff; padding: 5px 20px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        Most Popular</div>
                    <div
                        style="background: rgba(231, 76, 60, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e74c3c"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <circle cx="8" cy="8" r="1" />
                        </svg>
                    </div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Reporter ID + Mic
                    </h4>
                    <div class="price" style="margin: 15px 0 20px;">
                        <span style="font-size: 36px; font-weight: 800; color: #e74c3c;">₹3,500</span>
                        <span style="color: #888; font-size: 14px; display: block;">/one-time</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0 0 25px; text-align: left;">
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Branded interview microphone
                        </li>
                        <li
                            style="padding: 8px 0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Priority verification support
                        </li>
                    </ul>
                    <a href="#contact" class="btn btn-primary"
                        style="width:100%; justify-content:center; padding: 14px; background: #e74c3c; color: #fff; border: none; border-radius: 30px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;"
                        onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                        Apply Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Plan 3 --}}
                <div class="plan-card reveal delay-2"
                    style="background: #fff; padding: 40px 30px; border-radius: 16px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: all 0.3s; position: relative;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.06)'">
                    <div
                        style="background: rgba(155, 89, 182, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#9b59b6"
                            stroke-width="1.5">
                            <path d="M12 2a10 10 0 0 1 10 10c0 6-10 10-10 10S2 18 2 12A10 10 0 0 1 12 2z" />
                            <path d="M12 6v6l4 2" />
                            <path d="M8 16l4-4" />
                        </svg>
                    </div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Wireless Mic +
                        Reporter ID</h4>
                    <div class="price" style="margin: 15px 0 20px;">
                        <span style="font-size: 36px; font-weight: 800; color: #e74c3c;">₹7,999</span>
                        <span style="color: #888; font-size: 14px; display: block;">/one-time</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0 0 25px; text-align: left;">
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Official reporter ID card
                        </li>
                        <li
                            style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Wireless microphone setup
                        </li>
                        <li
                            style="padding: 8px 0; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #555;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2ecc71"
                                stroke-width="2">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Full field-kit support
                        </li>
                    </ul>
                    <a href="#contact" class="btn btn-outline"
                        style="width:100%; justify-content:center; padding: 14px; border: 2px solid #9b59b6; color: #9b59b6; background: transparent; border-radius: 30px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;"
                        onmouseover="this.style.background='#9b59b6'; this.style.color='#fff'"
                        onmouseout="this.style.background='transparent'; this.style.color='#9b59b6'">
                        Apply Now
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <div
                    style="background: #fff; padding: 20px 30px; border-radius: 12px; display: inline-block; box-shadow: 0 3px 15px rgba(0,0,0,0.06);">
                    <p style="margin: 0; color: #666; font-size: 14px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#25D366"
                            stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                        </svg>
                        Send payment confirmation on WhatsApp: <strong style="color: #25D366;">+91 91492 61291</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= TESTIMONIALS ================= --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Testimonials</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">What Our Clients Say</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">Real feedback from real people
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <div class="reveal"
                    style="background: #f8f9fa; padding: 30px; border-radius: 16px; border-left: 4px solid #e74c3c;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div
                            style="width: 50px; height: 50px; border-radius: 50%; background: #e74c3c; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px;">
                            AK</div>
                        <div>
                            <h5 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin: 0;">Amit Kumar</h5>
                            <p style="font-size: 13px; color: #888; margin: 0;">Registered Reporter</p>
                        </div>
                    </div>
                    <p style="color: #555; font-size: 15px; line-height: 1.7; margin: 0;">"The reporter ID process was
                        seamless. The team at Bharat Integrity Forum is professional and supportive."</p>
                    <div style="margin-top: 12px; color: #f39c12;">
                        ★★★★★
                    </div>
                </div>

                <div class="reveal delay-1"
                    style="background: #f8f9fa; padding: 30px; border-radius: 16px; border-left: 4px solid #3498db;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div
                            style="width: 50px; height: 50px; border-radius: 50%; background: #3498db; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px;">
                            PS</div>
                        <div>
                            <h5 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin: 0;">Priya Sharma</h5>
                            <p style="font-size: 13px; color: #888; margin: 0;">Media Partner</p>
                        </div>
                    </div>
                    <p style="color: #555; font-size: 15px; line-height: 1.7; margin: 0;">"Excellent digital media
                        coverage! Our brand reached a wider audience through their platform."</p>
                    <div style="margin-top: 12px; color: #f39c12;">
                        ★★★★★
                    </div>
                </div>

                <div class="reveal delay-2"
                    style="background: #f8f9fa; padding: 30px; border-radius: 16px; border-left: 4px solid #2ecc71;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div
                            style="width: 50px; height: 50px; border-radius: 50%; background: #2ecc71; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px;">
                            RV</div>
                        <div>
                            <h5 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin: 0;">Rajesh Verma</h5>
                            <p style="font-size: 13px; color: #888; margin: 0;">Franchise Partner</p>
                        </div>
                    </div>
                    <p style="color: #555; font-size: 15px; line-height: 1.7; margin: 0;">"Partnering with Bharat Integrity
                        Forum was the best decision. Their support and guidance are unmatched."</p>
                    <div style="margin-top: 12px; color: #f39c12;">
                        ★★★★★
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA SECTION ================= --}}
    <section style="padding: 80px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 15px; color:#ccc;">Ready to Get Started?</h2>
                <p style="color: #ccc; font-size: 18px; line-height: 1.8; margin-bottom: 30px;">Join Bharat Integrity Forum
                    News today and take your media journey to the next level.</p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="#contact" class="btn btn-primary"
                        style="background: #e74c3c; color: #fff; padding: 16px 45px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;"
                        onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Contact Us
                    </a>
                    <a href="#reporter" class="btn btn-outline"
                        style="background: transparent; color: #fff; padding: 16px 45px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;"
                        onmouseover="this.style.borderColor='#fff'; this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)'">
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

        .btn-primary:hover {
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .plan-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 992px) {
            .grid-3 {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .section-head h2 {
                font-size: 28px !important;
            }
        }

        @media (max-width: 768px) {
            .grid-3 {
                grid-template-columns: 1fr !important;
            }

            .page-hero h1 {
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
@endpush
