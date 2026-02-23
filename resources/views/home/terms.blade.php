@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Terms of Use - They Trust Us | User Agreement';
        $meta_description = 'Read the Terms of Use for They Trust Us. Understand your rights, responsibilities, and the rules governing the use of our service provider directory platform.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/terms') }}">
@endsection

@push('styles')
<style>
    .terms-hero {
        background: linear-gradient(135deg, #0d2137 0%, #1a3a5c 100%);
        padding: 60px 0;
        color: #fff;
        text-align: center;
    }
    .terms-hero h1 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .terms-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
    }
    .terms-content {
        padding: 50px 0 80px;
        font-family: 'Inter', sans-serif;
        color: #333;
        line-height: 1.8;
    }
    .terms-content .toc {
        background: #f8fbff;
        border: 1px solid #e2ecf5;
        border-radius: 10px;
        padding: 25px 30px;
        margin-bottom: 40px;
    }
    .terms-content .toc h5 {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0d2137;
        margin-bottom: 15px;
    }
    .terms-content .toc ol {
        padding-left: 20px;
        margin: 0;
        columns: 2;
    }
    @media (max-width: 576px) {
        .terms-content .toc ol {
            columns: 1;
        }
    }
    .terms-content .toc ol li {
        margin-bottom: 6px;
    }
    .terms-content .toc ol li a {
        color: #2cc8dd;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
    }
    .terms-content .toc ol li a:hover {
        color: #1a9bb0;
        text-decoration: underline;
    }
    .terms-section {
        margin-bottom: 35px;
    }
    .terms-section h2 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: #0d2137;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #2cc8dd;
        display: inline-block;
    }
    .terms-section h3 {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1a3a5c;
        margin: 18px 0 10px;
    }
    .terms-section p, .terms-section li {
        font-size: 0.95rem;
        color: #555;
    }
    .terms-section ul, .terms-section ol {
        padding-left: 20px;
    }
    .terms-section ul li, .terms-section ol li {
        margin-bottom: 6px;
        position: relative;
        padding-left: 8px;
    }
    .terms-section ul li::marker {
        color: #2cc8dd;
    }
    .highlight-box {
        background: #eafcff;
        border-left: 4px solid #2cc8dd;
        padding: 15px 20px;
        border-radius: 0 8px 8px 0;
        margin: 15px 0;
        font-size: 0.93rem;
        color: #444;
    }
    .warning-box {
        background: #fff8ee;
        border-left: 4px solid #f0ad4e;
        padding: 15px 20px;
        border-radius: 0 8px 8px 0;
        margin: 15px 0;
        font-size: 0.93rem;
        color: #555;
    }
    .contact-card {
        background: linear-gradient(135deg, #f0fdff 0%, #e8f8fb 100%);
        border-radius: 12px;
        padding: 30px;
        margin-top: 40px;
        border: 1px solid #d4f0f5;
    }
    .contact-card h4 {
        font-weight: 700;
        color: #0d2137;
        margin-bottom: 10px;
    }
    .contact-card p {
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }
    .contact-card a {
        color: #2cc8dd;
        text-decoration: none;
    }
    .contact-card a:hover {
        text-decoration: underline;
    }
    .last-updated {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-top: 10px;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="terms-hero">
        <div class="container">
            <h1>Terms of Use</h1>
            <p>Please read these terms carefully before using our platform.</p>
            <span class="last-updated">Last Updated: February 1, 2026</span>
        </div>
    </section>

    {{-- Content --}}
    <section class="terms-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    {{-- Table of Contents --}}
                    <div class="toc">
                        <h5>Table of Contents</h5>
                        <ol>
                            <li><a href="#acceptance">Acceptance of Terms</a></li>
                            <li><a href="#eligibility">Eligibility</a></li>
                            <li><a href="#account">Account Registration</a></li>
                            <li><a href="#services">Description of Services</a></li>
                            <li><a href="#user-content">User Content & Reviews</a></li>
                            <li><a href="#conduct">Acceptable Use & Conduct</a></li>
                            <li><a href="#ip">Intellectual Property</a></li>
                            <li><a href="#listings">Company Listings & Profiles</a></li>
                            <li><a href="#payments">Payments & Subscriptions</a></li>
                            <li><a href="#third-party">Third-Party Services</a></li>
                            <li><a href="#disclaimer">Disclaimers</a></li>
                            <li><a href="#liability">Limitation of Liability</a></li>
                            <li><a href="#indemnification">Indemnification</a></li>
                            <li><a href="#termination">Termination</a></li>
                            <li><a href="#governing-law">Governing Law</a></li>
                            <li><a href="#modifications">Modifications to Terms</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                        </ol>
                    </div>

                    {{-- 1. Acceptance --}}
                    <div class="terms-section" id="acceptance">
                        <h2>1. Acceptance of Terms</h2>
                        <p>Welcome to They Trust Us. These Terms of Use ("Terms") constitute a legally binding agreement between you and They Trust Us ("we," "our," or "us") governing your access to and use of the website <strong>theytrust.us</strong> and all related services (collectively, the "Services").</p>
                        <div class="highlight-box">
                            By accessing or using our Services, creating an account, submitting reviews, or browsing our platform, you acknowledge that you have read, understood, and agree to be bound by these Terms and our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>. If you do not agree, you must not use the Services.
                        </div>
                    </div>

                    {{-- 2. Eligibility --}}
                    <div class="terms-section" id="eligibility">
                        <h2>2. Eligibility</h2>
                        <p>To use our Services, you must:</p>
                        <ul>
                            <li>Be at least <strong>18 years of age</strong> or the age of legal majority in your jurisdiction.</li>
                            <li>Have the legal authority to enter into a binding agreement.</li>
                            <li>If registering on behalf of a company, have the authority to bind that organization to these Terms.</li>
                        </ul>
                        <p>We reserve the right to refuse service, terminate accounts, or cancel orders at our sole discretion if we believe eligibility requirements are not met.</p>
                    </div>

                    {{-- 3. Account --}}
                    <div class="terms-section" id="account">
                        <h2>3. Account Registration</h2>
                        <p>When you create an account on They Trust Us, you agree to:</p>
                        <ul>
                            <li>Provide accurate, current, and complete registration information.</li>
                            <li>Maintain and promptly update your account information.</li>
                            <li>Keep your password confidential and secure.</li>
                            <li>Accept responsibility for all activities under your account.</li>
                            <li>Notify us immediately of any unauthorized access to your account.</li>
                        </ul>
                        <div class="warning-box">
                            We reserve the right to suspend or terminate accounts that contain inaccurate information, violate these Terms, or are used for fraudulent purposes.
                        </div>
                    </div>

                    {{-- 4. Services --}}
                    <div class="terms-section" id="services">
                        <h2>4. Description of Services</h2>
                        <p>They Trust Us is a platform that connects businesses with service providers. Our Services include, but are not limited to:</p>
                        <ul>
                            <li><strong>Provider Directory:</strong> A searchable directory of vetted service providers across multiple industries and categories.</li>
                            <li><strong>Review Platform:</strong> A system for verified reviews and ratings of service providers.</li>
                            <li><strong>Company Profiles:</strong> Tools for businesses to create and manage their company profiles.</li>
                            <li><strong>Sponsorship & Advertising:</strong> Premium listing options and sponsored placements for service providers.</li>
                            <li><strong>Search & Discovery:</strong> Advanced search tools to help buyers find the right service providers.</li>
                        </ul>
                    </div>

                    {{-- 5. User Content --}}
                    <div class="terms-section" id="user-content">
                        <h2>5. User Content & Reviews</h2>

                        <h3>5.1 Your Content</h3>
                        <p>You may submit reviews, ratings, comments, company information, and other materials ("User Content") through the Services. By submitting User Content, you:</p>
                        <ul>
                            <li>Grant us a non-exclusive, worldwide, royalty-free, perpetual license to use, display, reproduce, modify, and distribute your User Content in connection with the Services.</li>
                            <li>Represent that you own or have the necessary rights to submit the content.</li>
                            <li>Agree that your User Content does not violate any third-party rights.</li>
                        </ul>

                        <h3>5.2 Review Guidelines</h3>
                        <p>When submitting reviews, you agree that:</p>
                        <ul>
                            <li>Reviews must be based on genuine, first-hand experiences with the service provider.</li>
                            <li>Reviews must be honest, accurate, and not misleading.</li>
                            <li>You will not submit fake, paid, or incentivized reviews.</li>
                            <li>You will not use reviews to harass, defame, or make false statements about any individual or company.</li>
                        </ul>

                        <h3>5.3 Content Moderation</h3>
                        <p>We reserve the right to review, edit, or remove any User Content at our sole discretion, including content that violates these Terms, is inaccurate, or is otherwise objectionable. We are not obligated to publish or maintain any User Content.</p>
                    </div>

                    {{-- 6. Conduct --}}
                    <div class="terms-section" id="conduct">
                        <h2>6. Acceptable Use & Conduct</h2>
                        <p>When using our Services, you agree <strong>not to</strong>:</p>
                        <ul>
                            <li>Violate any applicable laws or regulations.</li>
                            <li>Impersonate any person or entity, or falsely represent your affiliation.</li>
                            <li>Submit false, misleading, or fraudulent information.</li>
                            <li>Use automated systems (bots, scrapers, crawlers) to access or collect data from the Services without prior written consent.</li>
                            <li>Attempt to gain unauthorized access to any part of the Services, other accounts, or computer systems.</li>
                            <li>Interfere with or disrupt the Services, servers, or networks connected to the Services.</li>
                            <li>Upload or transmit viruses, malware, or other harmful code.</li>
                            <li>Engage in spamming, phishing, or unsolicited communications through the platform.</li>
                            <li>Use the Services for any purpose that is competitive with They Trust Us.</li>
                        </ul>
                    </div>

                    {{-- 7. IP --}}
                    <div class="terms-section" id="ip">
                        <h2>7. Intellectual Property</h2>
                        <p>All content, features, and functionality of the Services, including but not limited to text, graphics, logos, icons, images, audio, video, software, and the compilation thereof, are the exclusive property of They Trust Us or its licensors and are protected by copyright, trademark, and other intellectual property laws.</p>
                        <ul>
                            <li>The "They Trust Us" name, logo, and all related trademarks are our property.</li>
                            <li>You may not reproduce, distribute, modify, create derivative works of, publicly display, or exploit any of our content without prior written permission.</li>
                            <li>You retain ownership of your User Content but grant us the license described in Section 5.1.</li>
                        </ul>
                    </div>

                    {{-- 8. Listings --}}
                    <div class="terms-section" id="listings">
                        <h2>8. Company Listings & Profiles</h2>
                        <p>Service providers who create company profiles on They Trust Us agree to:</p>
                        <ul>
                            <li>Provide accurate and truthful information about their company, services, and capabilities.</li>
                            <li>Keep their profile information current and up to date.</li>
                            <li>Not misrepresent their qualifications, experience, or portfolio.</li>
                            <li>Accept that reviews from verified users may be published on their profile.</li>
                        </ul>
                        <p>We reserve the right to modify, suspend, or remove any company listing that contains inaccurate information or violates these Terms.</p>
                    </div>

                    {{-- 9. Payments --}}
                    <div class="terms-section" id="payments">
                        <h2>9. Payments & Subscriptions</h2>
                        <ul>
                            <li><strong>Pricing:</strong> All fees are stated in US dollars and are subject to change. We will notify you of any pricing changes before they take effect.</li>
                            <li><strong>Billing:</strong> Subscription fees are billed in advance on a recurring basis (monthly or annually, depending on your plan).</li>
                            <li><strong>Cancellation:</strong> You may cancel your subscription at any time. Cancellations take effect at the end of the current billing period.</li>
                            <li><strong>Refunds:</strong> Fees are generally non-refundable unless otherwise stated or required by law.</li>
                            <li><strong>Payment Security:</strong> All payments are processed through secure, PCI-compliant third-party payment processors.</li>
                        </ul>
                    </div>

                    {{-- 10. Third Party --}}
                    <div class="terms-section" id="third-party">
                        <h2>10. Third-Party Services</h2>
                        <p>The Services may contain links to third-party websites, services, or integrations. We do not control and are not responsible for the content, privacy policies, or practices of any third-party services. Your use of third-party services is governed by their respective terms and policies. We encourage you to review their terms before using them.</p>
                    </div>

                    {{-- 11. Disclaimers --}}
                    <div class="terms-section" id="disclaimer">
                        <h2>11. Disclaimers</h2>
                        <div class="warning-box">
                            <p><strong>THE SERVICES ARE PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED.</strong></p>
                        </div>
                        <p>We do not warrant that:</p>
                        <ul>
                            <li>The Services will be uninterrupted, error-free, or secure.</li>
                            <li>Reviews posted on the platform are accurate, reliable, or complete.</li>
                            <li>The results obtained from using the Services will meet your requirements.</li>
                            <li>Any service provider listed on our platform will deliver satisfactory results.</li>
                        </ul>
                        <p>They Trust Us acts as a platform for connecting buyers and service providers. We do not endorse, guarantee, or assume responsibility for any service provider listed on our platform.</p>
                    </div>

                    {{-- 12. Liability --}}
                    <div class="terms-section" id="liability">
                        <h2>12. Limitation of Liability</h2>
                        <p>To the fullest extent permitted by applicable law, They Trust Us, its officers, directors, employees, and agents shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of profits, data, use, or goodwill, arising from:</p>
                        <ul>
                            <li>Your use of or inability to use the Services.</li>
                            <li>Any content posted or made available through the Services.</li>
                            <li>Unauthorized access to or alteration of your data.</li>
                            <li>Any conduct or content of any third party on the Services.</li>
                        </ul>
                        <p>In no event shall our total liability exceed the amount you paid to us in the twelve (12) months preceding the claim.</p>
                    </div>

                    {{-- 13. Indemnification --}}
                    <div class="terms-section" id="indemnification">
                        <h2>13. Indemnification</h2>
                        <p>You agree to indemnify, defend, and hold harmless They Trust Us and its affiliates, officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, costs, or expenses (including reasonable attorneys' fees) arising from:</p>
                        <ul>
                            <li>Your use of the Services or violation of these Terms.</li>
                            <li>Your User Content or any activity conducted through your account.</li>
                            <li>Your violation of any rights of third parties.</li>
                        </ul>
                    </div>

                    {{-- 14. Termination --}}
                    <div class="terms-section" id="termination">
                        <h2>14. Termination</h2>
                        <p>We may terminate or suspend your account and access to the Services at any time, with or without notice, for reasons including but not limited to:</p>
                        <ul>
                            <li>Violation of these Terms.</li>
                            <li>Fraudulent or illegal activity.</li>
                            <li>Extended periods of inactivity.</li>
                            <li>At our sole discretion for any reason.</li>
                        </ul>
                        <p>Upon termination, your right to use the Services ceases immediately. Sections of these Terms that by their nature should survive termination shall continue to apply.</p>
                    </div>

                    {{-- 15. Governing Law --}}
                    <div class="terms-section" id="governing-law">
                        <h2>15. Governing Law</h2>
                        <p>These Terms shall be governed by and construed in accordance with the laws of the United States, without regard to conflict of law principles. Any disputes arising from these Terms or the Services shall be resolved in the competent courts of the United States.</p>
                    </div>

                    {{-- 16. Modifications --}}
                    <div class="terms-section" id="modifications">
                        <h2>16. Modifications to Terms</h2>
                        <p>We reserve the right to modify these Terms at any time. When we make changes, we will update the "Last Updated" date at the top of this page. Material changes may be communicated through email or a prominent notice on our website. Your continued use of the Services after modifications constitutes acceptance of the updated Terms.</p>
                    </div>

                    {{-- 17. Contact --}}
                    <div class="terms-section" id="contact">
                        <h2>17. Contact Us</h2>
                        <div class="contact-card">
                            <h4>Questions About Our Terms?</h4>
                            <p>If you have any questions or concerns about these Terms of Use, please reach out to us:</p>
                            <p><strong>They Trust Us</strong></p>
                            <p><i class="fas fa-envelope mr-2" style="color: #2cc8dd;"></i> Email: <a href="mailto:legal@theytrust.us">legal@theytrust.us</a></p>
                            <p><i class="fas fa-globe mr-2" style="color: #2cc8dd;"></i> Website: <a href="https://theytrust.us">theytrust.us</a></p>
                            <p><i class="fas fa-map-marker-alt mr-2" style="color: #2cc8dd;"></i> Address: United States</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
