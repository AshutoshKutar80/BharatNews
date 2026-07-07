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
                            <p style="font-size: 14px; color: #bbb; margin: 0;">+91 91492 61291</p>
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
                            <p style="font-size: 14px; color: #bbb; margin: 0;">+91 91492 61291</p>
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
                <form class="form-card reveal delay-1"
                    style="background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <div style="margin-bottom: 25px;">
                        <h4 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px;">Send a Message
                        </h4>
                        <p style="color: #888; font-size: 14px;">Fill in the details below and we'll get back to you</p>
                    </div>

                    <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                        {{-- Full Name --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="name"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Full
                                Name <span style="color: #e74c3c;">*</span></label>
                            <input type="text" id="name" placeholder="Enter your full name"
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'">
                        </div>

                        {{-- Mobile Number --}}
                        <div>
                            <label for="mobile"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Mobile
                                Number <span style="color: #e74c3c;">*</span></label>
                            <input type="tel" id="mobile" placeholder="+91"
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Email
                                Address <span style="color: #e74c3c;">*</span></label>
                            <input type="email" id="email" placeholder="you@example.com"
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; outline: none;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'">
                        </div>

                        {{-- Subject --}}
                        <div style="grid-column: 1 / -1;">
                            <label for="subject"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Subject</label>
                            <select id="subject"
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
                        </div>

                        {{-- Message --}}
                        <div style="grid-column: 1 / -1; margin-top:30px;">
                            <label for="message"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Message
                                <span style="color: #e74c3c;">*</span></label>
                            <textarea id="message" rows="5" placeholder="Write your message in detail..."
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 15px; transition: all 0.3s; resize: vertical; font-family: inherit; outline: none;"
                                onfocus="this.style.borderColor='#e74c3c'" onblur="this.style.borderColor='#e8e8e8'"></textarea>
                        </div>

                        {{-- File Upload --}}
                        {{-- <div style="grid-column: 1 / -1;">
                            <label for="attachment"
                                style="display: block; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 6px;">Attach
                                File (Optional)</label>
                            <input type="file" id="attachment"
                                style="width: 100%; padding: 12px; border: 2px dashed #e8e8e8; border-radius: 10px; font-size: 14px; cursor: pointer; background: #fafafa;"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <p style="font-size: 12px; color: #aaa; margin-top: 5px;">Max file size: 5MB. Supported: JPG,
                                PNG, PDF, DOC</p>
                        </div> --}}

                        {{-- Privacy Checkbox --}}
                        <div style="grid-column: 1 / -1;">
                            <label
                                style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #555;">
                                <input type="checkbox" style="width: 18px; height: 18px; accent-color: #e74c3c;">
                                I agree to the <a href="#"
                                    style="color: #e74c3c; text-decoration: none; font-weight: 500;">Privacy Policy</a> and
                                terms of service.
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <div style="grid-column: 1 / -1;">
                            <button type="submit" class="btn btn-primary"
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

                        {{-- Response Message --}}
                        <div style="grid-column: 1 / -1; display: none;" id="formResponse">
                            <div
                                style="background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 10px; border-left: 4px solid #28a745; font-size: 14px;">
                                <strong>✓ Thank you!</strong> Your message has been sent successfully. We'll get back to you
                                soon.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



    {{-- ================= FAQ SECTION ================= --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-head reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="eyebrow"
                    style="color: #e74c3c; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; font-size: 13px;">FAQ</span>
                <h2 style="font-size: 36px; margin: 10px 0 15px; color: #1a1a2e;">Frequently Asked Questions</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto; font-size: 16px;">Quick answers to common
                    questions</p>
            </div>

            <div style="max-width: 800px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                {{-- FAQ Item 1 --}}
                <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; border-left: 4px solid #e74c3c;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">How can I register
                        for a Reporter ID?</h4>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0;">You can apply through our <a
                            href="#" style="color: #e74c3c; text-decoration: none;">Reporter Registration</a> page
                        or contact us via the form above.</p>
                </div>

                {{-- FAQ Item 2 --}}
                <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; border-left: 4px solid #3498db;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">What services do you
                        offer?</h4>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0;">We provide news reporting,
                        digital media coverage, reporter ID registration, and content publishing services.</p>
                </div>

                {{-- FAQ Item 3 --}}
                <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; border-left: 4px solid #2ecc71;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">How quickly do you
                        respond?</h4>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0;">Our team typically responds
                        within 24 hours during business days. For urgent matters, please call us directly.</p>
                </div>

                {{-- FAQ Item 4 --}}
                <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; border-left: 4px solid #f39c12;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px;">Can I submit a news
                        tip?</h4>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0;">Yes! You can submit news tips,
                        stories, or press releases through our contact form or email us directly.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <p style="color: #888; font-size: 14px;">Still have questions? <a href="#"
                        style="color: #e74c3c; font-weight: 600; text-decoration: none;">View all FAQs →</a></p>
            </div>
        </div>
    </section>

    {{-- ================= CTA SECTION ================= --}}
    <section style="padding: 60px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h3 style="font-size: 28px; font-weight: 700; margin-bottom: 15px; color: #ccc">Want to Collaborate with
                    Us?</h3>
                <p style="color: #ccc; font-size: 16px; line-height: 1.8; margin-bottom: 25px;">Partner with Bharat
                    Integrity Forum for media coverage, reporting, and digital presence.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="#"
                        style="background: #e74c3c; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                        onmouseover="this.style.background='#c0392b'" onmouseout="this.style.background='#e74c3c'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                        </svg>
                        Get In Touch
                    </a>
                    <a href="#"
                        style="background: transparent; color: #fff; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                        onmouseover="this.style.borderColor='#fff'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M4 4l16 16M20 4L4 20" />
                        </svg>
                        Call Us
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.3);
        }

        input:focus,
        textarea:focus,
        select:focus {
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
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

            // Form submission handling
            const form = document.querySelector('.form-card');
            const responseDiv = document.getElementById('formResponse');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Simulate form submission
                const btn = form.querySelector('button[type="submit"]');
                const originalText = btn.innerHTML;
                btn.innerHTML = 'Sending...';
                btn.disabled = true;

                setTimeout(() => {
                    responseDiv.style.display = 'block';
                    btn.innerHTML = '✓ Sent Successfully';
                    btn.style.background = '#2ecc71';

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.style.background = '#e74c3c';
                        btn.disabled = false;
                        form.reset();

                        // Auto-hide response after 5 seconds
                        setTimeout(() => {
                            responseDiv.style.display = 'none';
                        }, 5000);
                    }, 2000);
                }, 1500);
            });

            // File input display
            const fileInput = document.getElementById('attachment');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const fileName = this.files[0]?.name || 'No file selected';
                    const label = document.querySelector('label[for="attachment"]');
                    if (label) {
                        label.textContent = fileName;
                    }
                });
            }
        });
    </script>
@endpush
