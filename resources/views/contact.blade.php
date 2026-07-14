@extends('layouts.app')

@section('title', 'Contact Us - Bharat Integrity Forum News')
@section('meta_description',
    'Contact Bharat Integrity Forum News for reporting, digital media coverage, reporter ID
    registration, and general inquiries.')
@section('meta_keywords', 'contact, bharat integrity forum, news, reporting, media, reporter ID')

@section('content')

    {{-- ================= HERO SECTION ================= --}}
    <section class="page-hero"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 100px 0 60px; color: #fff; text-align: center;">
        <div class="container">
            <div class="hero-content reveal">
                <span class="eyebrow"
                    style="color: #f39c12; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; font-size: 14px;">Get
                    In Touch</span>
                <h1 style="font-size: 48px; margin: 15px 0 20px; font-weight: 700; color: #ccc">We'd Love to Hear From You
                </h1>
                <p style="font-size: 18px; max-width: 600px; margin: 0 auto; opacity: 0.9; line-height: 1.8;">Have questions,
                    suggestions, or want to collaborate? Reach out to us and our team will get back to you promptly.</p>
            </div>
        </div>
    </section>

    {{-- ================= CONTACT SECTION ================= --}}
    <section class="bg-white-alt" id="contact" style="padding: 80px 0;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">Contact
                    Information</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Get in Touch</h2>
                <p style="color: #666; max-width: 550px; margin: 0 auto; font-size: 16px;">Use the form below or reach out
                    through any of our channels. We're here to help!</p>
            </div>

            <div class="contact-wrap" style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px;">

                {{-- Contact Info Card --}}
                <div class="contact-info-card reveal"
                    style="background: #1a1a2e; padding: 40px; border-radius: 16px; color: #fff; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">

                    <div style="margin-bottom: 35px;">
                        <h4 style="font-size: 22px; font-weight: 700; margin-bottom: 10px; color: #fff;">Contact Details
                        </h4>
                        <p style="color: #aaa; font-size: 14px; line-height: 1.6;">Reach out to us through any of these
                            channels</p>
                    </div>

                    {{-- Address --}}
                    <div class="contact-row"
                        style="display: flex; align-items: flex-start; gap: 18px; margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span class="ic"
                            style="background: #e74c3c; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="2">
                                <path
                                    d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z" />
                            </svg>
                        </span>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 4px; color: #fff;">Address</h5>
                            <p style="font-size: 14px; color: #bbb; line-height: 1.6; margin: 0;">Sikandra, Agra, Uttar
                                Pradesh, 282010</p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="contact-row"
                        style="display: flex; align-items: flex-start; gap: 18px; margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span class="ic"
                            style="background: #3498db; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="2">
                                <path
                                    d="M6.6 10.8c1.4 2.8 3.7 5 6.5 6.5l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.5.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.4.6 3.5.1.4 0 .8-.2 1L6.6 10.8z" />
                            </svg>
                        </span>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 4px; color: #fff;">Phone</h5>
                            <p style="font-size: 14px; color: #bbb; margin: 0;">+91 9250073334</p>
                            <p style="font-size: 13px; color: #888; margin: 2px 0 0;">Mon-Fri, 9AM - 6PM</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="contact-row"
                        style="display: flex; align-items: flex-start; gap: 18px; margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span class="ic"
                            style="background: #2ecc71; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="2">
                                <path
                                    d="M2 5.5A1.5 1.5 0 0 1 3.5 4h17A1.5 1.5 0 0 1 22 5.5v13A1.5 1.5 0 0 1 20.5 20h-17A1.5 1.5 0 0 1 2 18.5v-13zm2.2.5 7.8 6 7.8-6H4.2zM20 7.4l-8 6.2-8-6.2v11.1h16V7.4z" />
                            </svg>
                        </span>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 4px; color: #fff;">Email</h5>
                            <p style="font-size: 14px; color: #bbb; margin: 0;">info@bharatintegrityforum.news</p>
                            <p style="font-size: 13px; color: #888; margin: 2px 0 0;">We reply within 24 hours</p>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="contact-row" style="display: flex; align-items: flex-start; gap: 18px; margin-bottom: 0;">
                        <span class="ic"
                            style="background: #25D366; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="2">
                                <path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z" />
                            </svg>
                        </span>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 4px; color: #fff;">WhatsApp</h5>
                            <p style="font-size: 14px; color: #bbb; margin: 0;">+91 9250073334</p>
                            <a href="https://wa.me/919149261291" target="_blank"
                                style="color: #25D366; font-size: 13px; text-decoration: none; font-weight: 500;">Chat with
                                us →</a>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div style="margin-top: 35px; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.08);">
                        <p style="font-size: 13px; color: #888; margin-bottom: 12px;">Follow us on social media</p>
                        <div style="display: flex; gap: 12px;">
                            <a href="#"
                                style="background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; color: #fff; text-decoration: none;"
                                onmouseover="this.style.background='#1877f2'"
                                onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#"
                                style="background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; color: #fff; text-decoration: none;"
                                onmouseover="this.style.background='#1da1f2'"
                                onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <a href="#"
                                style="background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; color: #fff; text-decoration: none;"
                                onmouseover="this.style.background='#e4405f'"
                                onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm4.965-10.405a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z" />
                                </svg>
                            </a>
                            <a href="#"
                                style="background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; color: #fff; text-decoration: none;"
                                onmouseover="this.style.background='#ff0000'"
                                onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <form class="form-card reveal delay-1" id="contactForm"
                    style="background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    @csrf
                    <div style="margin-bottom: 25px;">
                        <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px;">Send a Message
                        </h4>
                        <p style="color: #888; font-size: 14px;">Fill in the details below and we'll get back to you</p>
                        @auth
                            <p style="color: #059669; font-size: 13px; margin-top: 8px;">
                                <strong>✓</strong> You are logged in as <strong>{{ Auth::user()->name }}</strong>. Your details
                                are auto-filled.
                            </p>
                        @endauth
                        @guest
                            <p style="color: #f59e0b; font-size: 13px; margin-top: 8px;">
                                <strong>ℹ️</strong> <a href="{{ route('login') }}"
                                    style="color: #e74c3c; text-decoration: none; font-weight: 600;">Login</a> to auto-fill
                                your details.
                            </p>
                        @endguest
                    </div>

                    <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                        {{-- Full Name --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="name"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Full
                                Name <span style="color: #e74c3c;">*</span></label>
                            <div style="position: relative;">
                                <input type="text" id="name" name="name"
                                    value="{{ Auth::user()->name ?? '' }}"
                                    @auth
readonly
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none; background: #f5f5f5; cursor: not-allowed;"
                                    @else
                                        placeholder="Enter your full name"
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                        onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'" @endauth>
                                @auth
                                    <span
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #059669; font-size: 14px;">
                                        🔒
                                    </span>
                                @endauth
                            </div>
                            @auth
                                <p style="font-size: 12px; color: #888; margin-top: 4px;">
                                    <span style="color: #059669;">✓</span> Auto-filled from your profile
                                </p>
                            @endauth
                            <div class="error-message" id="nameError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Mobile Number --}}
                        <div>
                            <label for="mobile"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Mobile
                                Number <span style="color: #e74c3c;">*</span></label>
                            <div style="position: relative;">
                                <input type="tel" id="mobile" name="mobile"
                                    value="{{ Auth::user()->mobile ?? '' }}"
                                    @auth
readonly
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none; background: #f5f5f5; cursor: not-allowed;"
                                    @else
                                        placeholder="9999999999"
                                        maxlength="10" minlength="10" pattern="[0-9]{10}"
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                        onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'" @endauth>
                                @auth
                                    <span
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #059669; font-size: 14px;">
                                        🔒
                                    </span>
                                @endauth
                            </div>
                            @auth
                                <p style="font-size: 12px; color: #888; margin-top: 4px;">
                                    <span style="color: #059669;">✓</span> Auto-filled from your profile
                                </p>
                            @endauth
                            <div class="error-message" id="mobileError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Email
                                Address <span style="color: #e74c3c;">*</span></label>
                            <div style="position: relative;">
                                <input type="email" id="email" name="email"
                                    value="{{ Auth::user()->email ?? '' }}"
                                    @auth
readonly
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none; background: #f5f5f5; cursor: not-allowed;"
                                    @else
                                        placeholder="you@example.com"
                                        style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                        onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'" @endauth>
                                @auth
                                    <span
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #059669; font-size: 14px;">
                                        🔒
                                    </span>
                                @endauth
                            </div>
                            @auth
                                <p style="font-size: 12px; color: #888; margin-top: 4px;">
                                    <span style="color: #059669;">✓</span> Auto-filled from your profile
                                </p>
                            @endauth
                            <div class="error-message" id="emailError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Subject --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="subject"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Subject
                                <span style="color: #e74c3c;">*</span></label>
                            <select id="subject" name="subject"
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none; background: #fff; cursor: pointer;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="reporting">Reporting / News Tip</option>
                                <option value="reporter-id">Reporter ID Registration</option>
                                <option value="media-coverage">Media Coverage Request</option>
                                <option value="suggestion">Suggestion</option>
                                <option value="complaint">Complaint</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="error-message" id="subjectError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Message --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="message"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Message
                                <span style="color: #e74c3c;">*</span></label>
                            <textarea id="message" name="message" rows="5" placeholder="Write your message in detail..."
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; resize: vertical; font-family: inherit; outline: none;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'"></textarea>
                            <div class="error-message" id="messageError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                            <div id="charCount" style="text-align: right; font-size: 12px; color: #999; margin-top: 4px;">
                                0 / 5000</div>
                        </div>

                        {{-- File Upload --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="attachment"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Attach
                                File (Optional)</label>
                            <input type="file" id="attachment" name="attachment"
                                style="width: 100%; padding: 12px; border: 2px dashed #e8e8e8; border-radius: 10px; font-size: 14px; cursor: pointer; background: #fafafa;"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <p style="font-size: 12px; color: #aaa; margin-top: 5px;">Max file size: 5MB. Supported: JPG,
                                PNG, PDF, DOC</p>
                            <div class="error-message" id="attachmentError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Privacy Checkbox --}}
                        <div style="grid-column: 1 / -1;">
                            <label
                                style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #555;">
                                <input type="checkbox" id="privacy" name="privacy" value="1"
                                    style="width: 18px; height: 18px; accent-color: #e74c3c;">
                                I agree to the <a href="#"
                                    style="color: #e74c3c; text-decoration: none; font-weight: 500;">Privacy Policy</a> and
                                terms of service. <span style="color: #e74c3c;">*</span>
                            </label>
                            <div class="error-message" id="privacyError"
                                style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"></div>
                        </div>

                        {{-- Submit Button --}}
                        <div style="grid-column: 1 / -1;">
                            <button type="submit" id="submitBtn" class="btn btn-primary"
                                style="width: 100%; justify-content: center; padding: 16px; background: #e74c3c; color: #fff; border: none; border-radius: 10px; font-size: 17px; font-weight: 700; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; gap: 10px;"
                                onmouseover="this.style.background='#c0392b'"
                                onmouseout="this.style.background='#e74c3c'">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                                </svg>
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.3);
        }

        input:focus,
        textarea:focus,
        select:focus {
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        input.error,
        textarea.error,
        select.error {
            border-color: #e74c3c !important;
        }

        input.success,
        textarea.success {
            border-color: #2ecc71 !important;
        }

        input:read-only {
            cursor: not-allowed !important;
        }

        @media (max-width: 768px) {
            .contact-wrap {
                grid-template-columns: 1fr !important;
            }

            .form-grid {
                grid-template-columns: 1fr !important;
            }

            .page-hero h1 {
                font-size: 28px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            // Get form elements
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');

            // Character counter for message
            const messageField = document.getElementById('message');
            const charCount = document.getElementById('charCount');

            messageField.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length + ' / 5000';
                if (length > 5000) {
                    charCount.style.color = '#e74c3c';
                } else {
                    charCount.style.color = '#999';
                }
            });

            // Real-time validation
            const fields = {
                name: {
                    element: document.getElementById('name'),
                    error: document.getElementById('nameError'),
                    rules: ['required'],
                    isReadonly: document.getElementById('name').hasAttribute('readonly')
                },
                mobile: {
                    element: document.getElementById('mobile'),
                    error: document.getElementById('mobileError'),
                    rules: ['required', 'mobile'],
                    isReadonly: document.getElementById('mobile').hasAttribute('readonly')
                },
                email: {
                    element: document.getElementById('email'),
                    error: document.getElementById('emailError'),
                    rules: ['required', 'email'],
                    isReadonly: document.getElementById('email').hasAttribute('readonly')
                },
                subject: {
                    element: document.getElementById('subject'),
                    error: document.getElementById('subjectError'),
                    rules: ['required'],
                    isReadonly: false
                },
                message: {
                    element: document.getElementById('message'),
                    error: document.getElementById('messageError'),
                    rules: ['required', 'min:10'],
                    isReadonly: false
                },
                privacy: {
                    element: document.getElementById('privacy'),
                    error: document.getElementById('privacyError'),
                    rules: ['required'],
                    isReadonly: false
                }
            };

            // Validate single field
            function validateField(fieldName) {
                const field = fields[fieldName];
                if (!field) return true;

                const value = field.element.type === 'checkbox' ? (field.element.checked ? 'on' : '') : field
                    .element.value.trim();
                let isValid = true;
                let errorMsg = '';

                // Skip validation for readonly fields (they're auto-filled)
                if (field.isReadonly && value) {
                    field.element.classList.remove('error');
                    field.element.classList.add('success');
                    field.error.style.display = 'none';
                    return true;
                }

                // Check required
                if (field.rules.includes('required') && !value) {
                    isValid = false;
                    errorMsg = fieldName === 'privacy' ? 'You must agree to the Privacy Policy.' :
                        'This field is required.';
                }

                // Email validation
                if (field.rules.includes('email') && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        isValid = false;
                        errorMsg = 'Please enter a valid email address.';
                    }
                }

                // Mobile validation
                if (field.rules.includes('mobile') && value) {
                    const mobileRegex = /^[0-9+\-\s()]{10,20}$/;
                    if (!mobileRegex.test(value)) {
                        isValid = false;
                        errorMsg = 'Please enter a valid mobile number.';
                    }
                }

                // Min length validation
                if (field.rules.includes('min:10') && value && value.length < 10) {
                    isValid = false;
                    errorMsg = 'Message must be at least 10 characters.';
                }

                // Show/hide error
                if (!isValid) {
                    field.element.classList.add('error');
                    field.element.classList.remove('success');
                    field.error.textContent = errorMsg;
                    field.error.style.display = 'block';
                } else {
                    field.element.classList.remove('error');
                    if (value) {
                        field.element.classList.add('success');
                    } else {
                        field.element.classList.remove('success');
                    }
                    field.error.style.display = 'none';
                }

                return isValid;
            }

            // Add validation listeners (only for non-readonly fields)
            Object.keys(fields).forEach(key => {
                const field = fields[key];
                if (!field.isReadonly) {
                    const event = field.element.type === 'checkbox' ? 'change' : 'blur';
                    field.element.addEventListener(event, function() {
                        validateField(key);
                    });
                    // Also validate on input for text fields
                    if (field.element.type !== 'checkbox') {
                        field.element.addEventListener('input', function() {
                            validateField(key);
                        });
                    }
                } else {
                    // For readonly fields, just mark as success
                    if (field.element.value) {
                        field.element.classList.add('success');
                    }
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate all fields
                let allValid = true;
                Object.keys(fields).forEach(key => {
                    if (!validateField(key)) {
                        allValid = false;
                    }
                });

                if (!allValid) {
                    // Scroll to first error
                    const firstError = document.querySelector('.error');
                    if (firstError) {
                        firstError.focus();
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill all required fields correctly.',
                        confirmButtonColor: '#e74c3c'
                    });
                    return;
                }

                // Disable button and show loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                    </svg>
                    Sending...
                `;

                // Prepare form data
                const formData = new FormData(form);

                // Send AJAX request
                fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success - Show SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Message Sent!',
                                text: data.message,
                                confirmButtonColor: '#2ecc71',
                                timer: 5000,
                                timerProgressBar: true
                            });

                            // Reset form (only non-readonly fields)
                            form.reset();
                            Object.keys(fields).forEach(key => {
                                const field = fields[key];
                                if (!field.isReadonly) {
                                    field.element.classList.remove('success', 'error');
                                    field.error.style.display = 'none';
                                } else {
                                    // Keep readonly fields with their values and success class
                                    field.element.classList.add('success');
                                }
                            });
                            charCount.textContent = '0 / 5000';

                            // Reset button
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = `
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                            Send Message
                        `;
                        } else {
                            // Show errors
                            if (data.errors) {
                                let errorMessages = '';
                                Object.values(data.errors).forEach(error => {
                                    errorMessages += error[0] + '\n';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    text: errorMessages,
                                    confirmButtonColor: '#e74c3c'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message ||
                                        'Something went wrong. Please try again.',
                                    confirmButtonColor: '#e74c3c'
                                });
                            }
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = `
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                            Send Message
                        `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonColor: '#e74c3c'
                        });
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = `
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                        </svg>
                        Send Message
                    `;
                    });
            });

            // File input validation
            const attachmentInput = document.getElementById('attachment');
            attachmentInput.addEventListener('change', function() {
                const file = this.files[0];
                const errorDiv = document.getElementById('attachmentError');
                if (file) {
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];
                    const maxSize = 5 * 1024 * 1024; // 5MB

                    if (!validTypes.includes(file.type)) {
                        errorDiv.textContent = 'File must be JPG, PNG, PDF, or DOC.';
                        errorDiv.style.display = 'block';
                        this.value = '';
                    } else if (file.size > maxSize) {
                        errorDiv.textContent = 'File size must not exceed 5MB.';
                        errorDiv.style.display = 'block';
                        this.value = '';
                    } else {
                        errorDiv.style.display = 'none';
                    }
                }
            });
        });
    </script>

    <style>
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
