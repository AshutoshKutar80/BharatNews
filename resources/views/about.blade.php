@extends('layouts.app')

@section('title', 'About Us - Bharat Integrity Forum News')
@section('meta_description',
    'Learn about the mission, vision, values, and journey of Bharat Integrity Forum News - an
    independent platform for truthful and impartial journalism.')
@section('meta_keywords',
    'about us, mission, vision, values, journalism, truth, impartial, trustworthy, Bharat
    Integrity Forum')

@section('content')

    {{-- ================= PAGE HERO ================= --}}
    <section class="page-hero"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 80px 0 70px; color: #fff; text-align: center; position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <span class="eyebrow"
                style="color: #f39c12; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; font-size: 14px; display: inline-block;">About
                Us</span>
            <h1
                style="max-width: 720px; margin: 15px auto 20px; font-size: 44px; font-weight: 700; line-height: 1.2; color:#ccc;">
                Journalism built on truth, <span style="color: #f39c12;">for every voice</span>
            </h1>
            <p class="lead" style="max-width: 600px; margin: 0 auto; font-size: 18px; opacity: 0.9; line-height: 1.8;">
                Bharat Integrity Forum News is an independent platform that connects the nation through impartial and
                trustworthy reporting.
            </p>
            <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="#mission" class="btn btn-primary"
                    style="background: #e74c3c; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                    onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                        <path d="M8 12h8M12 8v8" />
                    </svg>
                    Our Mission
                </a>
                <a href="#team" class="btn btn-outline"
                    style="background: transparent; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                    onmouseover="this.style.borderColor='#fff'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Our Team
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
        <div
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; height: 500px; background: radial-gradient(circle, rgba(231, 76, 60, 0.03) 0%, transparent 70%); border-radius: 50%;">
        </div>
    </section>

    {{-- ================= MISSION / VISION ================= --}}
    <section class="bg-white-alt" id="mission" style="padding: 80px 0;">
        <div class="container split" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">

            <div class="art reveal" style="position: relative;">
                <div
                    style="background: linear-gradient(135deg, #1a1a2e, #0f3460); border-radius: 20px; padding: 30px; display: flex; align-items: center; justify-content: center; min-height: 400px; position: relative; overflow: hidden;">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Bharat Integrity Forum News"
                        style="max-width: 80%; height: auto; border-radius: 12px; position: relative; z-index: 2;">
                    <div
                        style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(243, 156, 18, 0.1); border-radius: 50%;">
                    </div>
                    <div
                        style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(231, 76, 60, 0.08); border-radius: 50%;">
                    </div>
                </div>
                <div
                    style="position: absolute; bottom: -15px; right: -15px; background: #e74c3c; color: #fff; padding: 15px 25px; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);">
                    Since 2024
                </div>
            </div>

            <div class="about-block reveal delay-1">
                <span class="eyebrow"
                    style="background: rgba(11,31,77,.06); border-color: rgba(11,31,77,.12); color: #1a1a2e; padding: 8px 18px; border-radius: 20px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; font-size: 12px; display: inline-block;">Our
                    Mission</span>
                <h2 style="font-size: 34px; font-weight: 700; color: #1a1a2e; margin: 15px 0 20px; line-height: 1.3;">
                    Delivering true and accurate news to every citizen</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.8; margin-bottom: 20px;">
                    Our goal is to practice journalism grounded in ground-level facts, free from bias — so readers can form
                    their own informed opinions. We believe that an informed citizenry is the foundation of a strong
                    democracy.
                </p>
                <ul class="check-list" style="list-style: none; padding: 0; margin: 0;">
                    <li
                        style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 15px; color: #444;">
                        <span
                            style="background: #e74c3c; color: #fff; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">✓</span>
                        Independent, fact-based reporting
                    </li>
                    <li
                        style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 15px; color: #444;">
                        <span
                            style="background: #e74c3c; color: #fff; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">✓</span>
                        Stories powered by a nationwide reporter network
                    </li>
                    <li
                        style="display: flex; align-items: center; gap: 12px; padding: 10px 0; font-size: 15px; color: #444;">
                        <span
                            style="background: #e74c3c; color: #fff; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">✓</span>
                        Simple presentation, in the reader's own language
                    </li>
                </ul>
                <div style="margin-top: 25px;">
                    <a href="#vision"
                        style="color: #e74c3c; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                        Learn more about our vision
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= VALUES ================= --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Our
                    Values</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Truth • Impartial • Trustworthy</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">These three words are the
                    foundation of every story we publish</p>
            </div>

            <div class="grid-3" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">

                <div class="value-card reveal"
                    style="background: #f8f9fa; padding: 40px 30px; border-radius: 16px; text-align: center; transition: all 0.3s; border-bottom: 4px solid #e74c3c;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="glyph" style="font-size: 48px; margin-bottom: 15px; display: block;">🕊️</div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Truth</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">We verify every story before
                        publishing, so that only the truth reaches our readers. No shortcuts, no compromises.</p>
                </div>

                <div class="value-card reveal delay-1"
                    style="background: #f8f9fa; padding: 40px 30px; border-radius: 16px; text-align: center; transition: all 0.3s; border-bottom: 4px solid #3498db;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="glyph" style="font-size: 48px; margin-bottom: 15px; display: block;">⚖️</div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Impartial</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">We report in a balanced way,
                        without leaning toward any party, institution, or individual. Fairness is our standard.</p>
                </div>

                <div class="value-card reveal delay-2"
                    style="background: #f8f9fa; padding: 40px 30px; border-radius: 16px; text-align: center; transition: all 0.3s; border-bottom: 4px solid #2ecc71;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="glyph" style="font-size: 48px; margin-bottom: 15px; display: block;">🤝</div>
                    <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px;">Trustworthy</h4>
                    <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">We earn our readers' trust every
                        single day through transparency and accountability. Our word is our bond.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= VISION SECTION ================= --}}
    <section id="vision" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <div class="split" style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
                <div class="reveal">
                    <span class="eyebrow"
                        style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px; display: inline-block;">Our
                        Vision</span>
                    <h2 style="font-size: 34px; font-weight: 700; color: #1a1a2e; margin: 15px 0 20px; line-height: 1.3;">A
                        nation where every voice is heard and every truth is told</h2>
                    <p style="color: #555; font-size: 16px; line-height: 1.8; margin-bottom: 20px;">
                        We envision a media landscape that empowers citizens, fosters dialogue, and strengthens democracy
                        through truthful and impartial journalism.
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 20px;">
                        <div
                            style="background: #fff; padding: 15px; border-radius: 12px; text-align: center; box-shadow: 0 3px 15px rgba(0,0,0,0.06);">
                            <div style="font-size: 28px; color: #e74c3c; font-weight: 700;">100+</div>
                            <div style="font-size: 13px; color: #888;">Reporters Trained</div>
                        </div>
                        <div
                            style="background: #fff; padding: 15px; border-radius: 12px; text-align: center; box-shadow: 0 3px 15px rgba(0,0,0,0.06);">
                            <div style="font-size: 28px; color: #3498db; font-weight: 700;">50+</div>
                            <div style="font-size: 13px; color: #888;">Cities Covered</div>
                        </div>
                    </div>
                </div>
                <div class="reveal delay-1"
                    style="background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.06);">
                    <h4 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 15px;">Our Commitment</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; gap: 15px; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="color: #e74c3c; font-size: 20px;">✦</span>
                            <div>
                                <strong style="display: block; color: #1a1a2e;">Accuracy First</strong>
                                <span style="font-size: 14px; color: #666;">Every fact is verified before
                                    publication</span>
                            </div>
                        </li>
                        <li style="display: flex; gap: 15px; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="color: #3498db; font-size: 20px;">✦</span>
                            <div>
                                <strong style="display: block; color: #1a1a2e;">Diverse Voices</strong>
                                <span style="font-size: 14px; color: #666;">Representing all communities and
                                    perspectives</span>
                            </div>
                        </li>
                        <li style="display: flex; gap: 15px; padding: 12px 0;">
                            <span style="color: #2ecc71; font-size: 20px;">✦</span>
                            <div>
                                <strong style="display: block; color: #1a1a2e;">Continuous Learning</strong>
                                <span style="font-size: 14px; color: #666;">Investing in journalist training and
                                    development</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= WHY CHOOSE US ================= --}}
    <section class="bg-navy"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); padding: 80px 0; color: #fff;">
        <div class="container split"
            style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">

            <div class="reveal">
                <span class="eyebrow"
                    style="background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.18); color: #f39c12; padding: 8px 18px; border-radius: 20px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; font-size: 12px; display: inline-block;">Why
                    Choose Us</span>
                <h2 style="font-size: 34px; font-weight: 700; color: #fff; margin: 15px 0 20px; line-height: 1.3;">A
                    trustworthy news platform that becomes your voice</h2>
                <p style="color: rgba(255,255,255,.75); font-size: 16px; line-height: 1.8; margin-bottom: 20px;">
                    Whether you're a reader or want to become a reporter, Bharat Integrity Forum News stands with you, with
                    transparency at every step.
                </p>
                <div class="hero-actions" style="margin-top: 30px;">
                    <a href="{{ url('/services') }}" class="btn btn-primary"
                        style="background: #e74c3c; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                        onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        View Our Services
                    </a>
                </div>
            </div>

            <div class="grid-2 reveal delay-1" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                <div class="cat-card"
                    style="background: rgba(255,255,255,0.06); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); transition: all 0.3s; text-align: center;"
                    onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.transform='translateY(0)'">
                    <div class="icon" style="font-size: 36px; margin-bottom: 10px;">📰</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 5px;">Fast Updates</h4>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin: 0;">Every big story, first</p>
                </div>

                <div class="cat-card"
                    style="background: rgba(255,255,255,0.06); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); transition: all 0.3s; text-align: center;"
                    onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.transform='translateY(0)'">
                    <div class="icon" style="font-size: 36px; margin-bottom: 10px;">🌏</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 5px;">Nationwide Network</h4>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin: 0;">Reporters across every state</p>
                </div>

                <div class="cat-card"
                    style="background: rgba(255,255,255,0.06); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); transition: all 0.3s; text-align: center;"
                    onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.transform='translateY(0)'">
                    <div class="icon" style="font-size: 36px; margin-bottom: 10px;">🔍</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 5px;">Fact-Checked</h4>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin: 0;">Every story verified</p>
                </div>

                <div class="cat-card"
                    style="background: rgba(255,255,255,0.06); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); transition: all 0.3s; text-align: center;"
                    onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.transform='translateY(0)'">
                    <div class="icon" style="font-size: 36px; margin-bottom: 10px;">💬</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 5px;">Reader Dialogue</h4>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin: 0;">Your opinion, respected</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= TEAM SECTION ================= --}}
    <section id="team" style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Our
                    Team</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">The People Behind the News</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">Meet the dedicated professionals
                    who make it all happen</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">

                <div class="reveal" style="text-align: center;">
                    <div
                        style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #e74c3c, #c0392b); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 40px; font-weight: 700;">
                        AK</div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px;">Amit Kumar</h4>
                    <p style="font-size: 14px; color: #888; margin-bottom: 8px;">Founder & Editor-in-Chief</p>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1da1f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="reveal delay-1" style="text-align: center;">
                    <div
                        style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #3498db, #2980b9); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 40px; font-weight: 700;">
                        PS</div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px;">Priya Sharma</h4>
                    <p style="font-size: 14px; color: #888; margin-bottom: 8px;">Managing Editor</p>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1da1f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="reveal delay-2" style="text-align: center;">
                    <div
                        style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #2ecc71, #27ae60); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 40px; font-weight: 700;">
                        RV</div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px;">Rajesh Verma</h4>
                    <p style="font-size: 14px; color: #888; margin-bottom: 8px;">Senior Reporter</p>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1da1f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="reveal delay-3" style="text-align: center;">
                    <div
                        style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #f39c12, #e67e22); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 40px; font-weight: 700;">
                        SM</div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px;">Sunita Mehta</h4>
                    <p style="font-size: 14px; color: #888; margin-bottom: 8px;">Digital Media Head</p>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" style="color: #888; text-decoration: none; transition: all 0.3s;"
                            onmouseover="this.style.color='#1da1f2'" onmouseout="this.style.color='#888'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <p style="color: #888; font-size: 14px;">And many more dedicated professionals working behind the scenes
                </p>
                <a href="{{ url('/contact') }}"
                    style="color: #e74c3c; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; margin-top: 10px;">
                    Join our team →
                </a>
            </div>
        </div>
    </section>

    {{-- ================= TIMELINE / JOURNEY ================= --}}
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Our
                    Journey</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">The Story So Far</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">A timeline of our growth and
                    milestones</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; position: relative;">
                <div
                    style="position: absolute; top: 40px; left: 15%; right: 15%; height: 3px; background: linear-gradient(to right, #e74c3c, #f39c12); z-index: 0;">
                </div>

                <div class="reveal" style="text-align: center; position: relative; z-index: 1;">
                    <div
                        style="width: 60px; height: 60px; border-radius: 50%; background: #e74c3c; color: #fff; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; font-size: 20px;">
                        1</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Founded</h4>
                    <p style="font-size: 13px; color: #888; margin: 0;">January 2024</p>
                    <p style="font-size: 13px; color: #666; margin-top: 5px;">Bharat Integrity Forum News was established
                    </p>
                </div>

                <div class="reveal delay-1" style="text-align: center; position: relative; z-index: 1;">
                    <div
                        style="width: 60px; height: 60px; border-radius: 50%; background: #3498db; color: #fff; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; font-size: 20px;">
                        2</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">First Reporters</h4>
                    <p style="font-size: 13px; color: #888; margin: 0;">March 2024</p>
                    <p style="font-size: 13px; color: #666; margin-top: 5px;">First batch of reporters registered</p>
                </div>

                <div class="reveal delay-2" style="text-align: center; position: relative; z-index: 1;">
                    <div
                        style="width: 60px; height: 60px; border-radius: 50%; background: #2ecc71; color: #fff; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; font-size: 20px;">
                        3</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Digital Launch</h4>
                    <p style="font-size: 13px; color: #888; margin: 0;">June 2024</p>
                    <p style="font-size: 13px; color: #666; margin-top: 5px;">Website and social media presence launched
                    </p>
                </div>

                <div class="reveal delay-3" style="text-align: center; position: relative; z-index: 1;">
                    <div
                        style="width: 60px; height: 60px; border-radius: 50%; background: #f39c12; color: #fff; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; font-size: 20px;">
                        4</div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Expansion</h4>
                    <p style="font-size: 13px; color: #888; margin: 0;">Present</p>
                    <p style="font-size: 13px; color: #666; margin-top: 5px;">Growing network across India</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA SECTION ================= --}}
    <section style="padding: 80px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 15px; color:#ccc;">Want to Be Part of Our
                    Story?</h2>
                <p style="color: #ccc; font-size: 18px; line-height: 1.8; margin-bottom: 30px;">Join us in our mission to
                    deliver truthful and impartial journalism to every corner of India.</p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ url('/services') }}" class="btn btn-primary"
                        style="background: #e74c3c; color: #fff; padding: 16px 45px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;"
                        onmouseover="this.style.background='#c0392b'; this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.background='#e74c3c'; this.style.transform='translateY(0)'">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Explore Our Services
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline"
                        style="background: transparent; color: #fff; padding: 16px 45px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;"
                        onmouseover="this.style.borderColor='#fff'; this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)'">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                        </svg>
                        Contact Us
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

        @media (max-width: 992px) {
            .split {
                grid-template-columns: 1fr !important;
            }

            .grid-3 {
                grid-template-columns: 1fr !important;
            }

            .grid-2 {
                grid-template-columns: 1fr !important;
            }

            .section-head h2 {
                font-size: 28px !important;
            }

            .timeline-line {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .page-hero h1 {
                font-size: 28px !important;
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .timeline-grid {
                grid-template-columns: 1fr !important;
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
        });
    </script>
@endpush
