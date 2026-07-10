<footer class="site-footer">

    <div class="tricolor-ribbon"></div>

    <div class="footer-top">
        <div class="container footer-grid">

            {{-- Brand column --}}
            <div class="footer-col">
                <div class="footer-brand-box">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="Bharat Integrity Forum News">
                </div>
                <p class="footer-desc">
                    Bharat Integrity Forum News, powered by UMCA Online Services Pvt. Ltd., brings you accurate,
                    impartial, and reliable news from across India with a commitment to truth, transparency, and public
                    trust.
                </p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M13.5 21v-8h2.7l.4-3.2h-3.1V7.7c0-.9.3-1.6 1.7-1.6h1.6V3.2C16.5 3.1 15.4 3 14.2 3c-2.6 0-4.4 1.6-4.4 4.5v2.3H7v3.2h2.8v8h3.7z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter / X">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4l7.3 9.6L4.4 20h1.9l6-6.5 4.8 6.5H21l-7.6-10L20 4h-1.9l-5.6 6L8 4H4z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M6.9 8.4H3.6V20h3.3V8.4zM5.3 3.4a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zM20.4 20h-3.3v-6c0-1.4 0-3.3-2-3.3s-2.3 1.6-2.3 3.2V20H9.5V8.4h3.2v1.6h.1c.4-.8 1.5-1.7 3.1-1.7 3.3 0 3.9 2.2 3.9 5V20z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2c-2.7 0-3 0-4.1.06-1.1.05-1.8.22-2.5.47a5 5 0 0 0-1.8 1.2 5 5 0 0 0-1.2 1.8c-.25.7-.42 1.4-.47 2.5C2 9.14 2 9.44 2 12.14s0 3 .06 4.1c.05 1.1.22 1.8.47 2.5.26.7.6 1.3 1.2 1.8.5.5 1.1.9 1.8 1.2.7.25 1.4.42 2.5.47 1.1.06 1.4.06 4.1.06s3 0 4.1-.06c1.1-.05 1.8-.22 2.5-.47a5 5 0 0 0 1.8-1.2 5 5 0 0 0 1.2-1.8c.25-.7.42-1.4.47-2.5.06-1.1.06-1.4.06-4.1s0-3-.06-4.1c-.05-1.1-.22-1.8-.47-2.5a5 5 0 0 0-1.2-1.8 5 5 0 0 0-1.8-1.2c-.7-.25-1.4-.42-2.5-.47C15 2 14.7 2 12 2zm0 5.4a4.6 4.6 0 1 1 0 9.2 4.6 4.6 0 0 1 0-9.2zm0 1.8a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm5.9-2a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/919149261291" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.4-6c-.2-.1-1.4-.7-1.6-.8s-.4-.1-.5.1-.6.8-.7.9-.3.1-.5 0a6.6 6.6 0 0 1-1.9-1.2 7.2 7.2 0 0 1-1.3-1.6c-.1-.2 0-.4.1-.5l.4-.4.2-.4v-.4c-.1-.1-.5-1.3-.7-1.8s-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3a1.9 1.9 0 0 0-.6 1.4c0 .8.6 1.6.7 1.7s1.2 1.9 3 2.6c1.7.7 1.7.5 2 .5s1.4-.6 1.6-1.1.2-.9.1-1z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('services') }}#reporter">Become a Reporter</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            {{-- Policies --}}
            <div class="footer-col">
                <h5>Policies</h5>
                <ul>
                    {{-- <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Our Rules</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Refund Policy</a></li> --}}
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('our-rules') }}">Our Rules</a></li>
                    <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
                    <li><a href="{{ route('refund-policy') }}">Refund Policy</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="footer-col">
                <h5>Contact Us</h5>
                <div class="footer-contact-item">
                    <span class="ic">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z" />
                        </svg>
                    </span>
                    <p>Sikandra,<br>Agra, Uttar Pradesh</p>
                </div>
                <div class="footer-contact-item">
                    <span class="ic">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M6.6 10.8c1.4 2.8 3.7 5 6.5 6.5l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.5.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.4.6 3.5.1.4 0 .8-.2 1L6.6 10.8z" />
                        </svg>
                    </span>
                    <p>+91 9250073334</p>
                </div>
                <div class="footer-contact-item">
                    <span class="ic">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M2 5.5A1.5 1.5 0 0 1 3.5 4h17A1.5 1.5 0 0 1 22 5.5v13A1.5 1.5 0 0 1 20.5 20h-17A1.5 1.5 0 0 1 2 18.5v-13zm2.2.5 7.8 6 7.8-6H4.2zM20 7.4l-8 6.2-8-6.2v11.1h16V7.4z" />
                        </svg>
                    </span>
                    <p>info@bharatintegrityforum.news</p>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom" style="border:none;padding:0;">
            <p>© {{ date('Y') }} <strong>Bharat Integrity Forum News</strong>. All rights reserved.</p>
            <p class="credit">
                Designed &amp; Developed by
                <strong> <a href="https://umcaonlineservices.com/" target="_blank" rel="noopener noreferrer">
                        UMCA Online Services
                    </a></strong>
            </p>
        </div>
    </div>
</footer>

<a href="https://wa.me/919149261291" class="whatsapp-float" aria-label="Chat on WhatsApp" target="_blank"
    rel="noopener">
    <svg viewBox="0 0 24 24">
        <path
            d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.4-6c-.2-.1-1.4-.7-1.6-.8s-.4-.1-.5.1-.6.8-.7.9-.3.1-.5 0a6.6 6.6 0 0 1-1.9-1.2 7.2 7.2 0 0 1-1.3-1.6c-.1-.2 0-.4.1-.5l.4-.4.2-.4v-.4c-.1-.1-.5-1.3-.7-1.8s-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3a1.9 1.9 0 0 0-.6 1.4c0 .8.6 1.6.7 1.7s1.2 1.9 3 2.6c1.7.7 1.7.5 2 .5s1.4-.6 1.6-1.1.2-.9.1-1z" />
    </svg>
</a>
