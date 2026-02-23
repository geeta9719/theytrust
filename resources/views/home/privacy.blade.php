@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Privacy Policy - They Trust Us | Protecting Your Data';
        $meta_description = 'Learn how They Trust Us collects, uses, and protects your personal information. Our Privacy Policy explains your data rights and our commitment to security.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/privacy') }}">
@endsection

@push('styles')
<style>
    .privacy-hero {
        background: linear-gradient(135deg, #0d2137 0%, #1a3a5c 100%);
        padding: 60px 0;
        color: #fff;
        text-align: center;
    }
    .privacy-hero h1 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .privacy-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
    }
    .privacy-content {
        padding: 50px 0 80px;
        font-family: 'Inter', sans-serif;
        color: #333;
        line-height: 1.8;
    }
    .privacy-content .toc {
        background: #f8fbff;
        border: 1px solid #e2ecf5;
        border-radius: 10px;
        padding: 25px 30px;
        margin-bottom: 40px;
    }
    .privacy-content .toc h5 {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0d2137;
        margin-bottom: 15px;
    }
    .privacy-content .toc ol {
        padding-left: 20px;
        margin: 0;
    }
    .privacy-content .toc ol li {
        margin-bottom: 6px;
    }
    .privacy-content .toc ol li a {
        color: #2cc8dd;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
    }
    .privacy-content .toc ol li a:hover {
        color: #1a9bb0;
        text-decoration: underline;
    }
    .policy-section {
        margin-bottom: 35px;
    }
    .policy-section h2 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: #0d2137;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #2cc8dd;
        display: inline-block;
    }
    .policy-section h3 {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1a3a5c;
        margin: 18px 0 10px;
    }
    .policy-section p, .policy-section li {
        font-size: 0.95rem;
        color: #555;
    }
    .policy-section ul {
        padding-left: 20px;
    }
    .policy-section ul li {
        margin-bottom: 6px;
        position: relative;
        padding-left: 8px;
    }
    .policy-section ul li::marker {
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
    <section class="privacy-hero">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>Your privacy matters to us. Learn how we protect and manage your data.</p>
            <span class="last-updated">Last Updated: February 1, 2026</span>
        </div>
    </section>

    {{-- Content --}}
    <section class="privacy-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    {{-- Table of Contents --}}
                    <div class="toc">
                        <h5>Table of Contents</h5>
                        <ol>
                            <li><a href="#introduction">Introduction</a></li>
                            <li><a href="#info-collect">Information We Collect</a></li>
                            <li><a href="#how-use">How We Use Your Information</a></li>
                            <li><a href="#info-sharing">Information Sharing & Disclosure</a></li>
                            <li><a href="#cookies">Cookies & Tracking Technologies</a></li>
                            <li><a href="#data-security">Data Security</a></li>
                            <li><a href="#data-retention">Data Retention</a></li>
                            <li><a href="#your-rights">Your Rights & Choices</a></li>
                            <li><a href="#third-party">Third-Party Links</a></li>
                            <li><a href="#children">Children's Privacy</a></li>
                            <li><a href="#international">International Data Transfers</a></li>
                            <li><a href="#changes">Changes to This Policy</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                        </ol>
                    </div>

                    {{-- 1. Introduction --}}
                    <div class="policy-section" id="introduction">
                        <h2>1. Introduction</h2>
                        <p>Welcome to They Trust Us ("we," "our," or "us"). We operate the website <strong>theytrust.us</strong> and related services (collectively, the "Services"). This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website, create an account, submit reviews, or interact with our platform in any way.</p>
                        <div class="highlight-box">
                            By accessing or using our Services, you agree to the terms of this Privacy Policy. If you do not agree with the practices described herein, please do not use our Services.
                        </div>
                    </div>

                    {{-- 2. Information We Collect --}}
                    <div class="policy-section" id="info-collect">
                        <h2>2. Information We Collect</h2>

                        <h3>2.1 Information You Provide</h3>
                        <ul>
                            <li><strong>Account Information:</strong> Name, email address, password, company name, job title, and phone number when you register or update your profile.</li>
                            <li><strong>Profile Data:</strong> Location, industry, biography, profile photo, and other details you choose to share.</li>
                            <li><strong>Review Content:</strong> Reviews, ratings, project details, and feedback you submit about service providers.</li>
                            <li><strong>Payment Information:</strong> Billing details and payment card information when you purchase premium services (processed securely through third-party payment processors).</li>
                            <li><strong>Communications:</strong> Messages, inquiries, and correspondence you send to us or through our platform.</li>
                        </ul>

                        <h3>2.2 Information Collected Automatically</h3>
                        <ul>
                            <li><strong>Device & Browser Data:</strong> IP address, browser type, operating system, device identifiers, and screen resolution.</li>
                            <li><strong>Usage Data:</strong> Pages visited, time spent on pages, click patterns, search queries, and referring URLs.</li>
                            <li><strong>Location Data:</strong> Approximate geographic location based on your IP address.</li>
                        </ul>

                        <h3>2.3 Information from Third Parties</h3>
                        <ul>
                            <li><strong>Social Login:</strong> If you sign in using LinkedIn or other social platforms, we receive your name, email, and profile information as authorized by you.</li>
                            <li><strong>Business Partners:</strong> We may receive information from partners who help us verify company profiles and reviews.</li>
                        </ul>
                    </div>

                    {{-- 3. How We Use Your Information --}}
                    <div class="policy-section" id="how-use">
                        <h2>3. How We Use Your Information</h2>
                        <p>We use the information we collect for the following purposes:</p>
                        <ul>
                            <li><strong>Provide & Improve Services:</strong> To operate, maintain, and enhance our platform, including personalizing your experience.</li>
                            <li><strong>Account Management:</strong> To create and manage your account, authenticate users, and provide customer support.</li>
                            <li><strong>Review Verification:</strong> To validate the authenticity of reviews and maintain the integrity of our platform.</li>
                            <li><strong>Communications:</strong> To send service updates, newsletters, marketing materials, and respond to your inquiries. You may opt out of marketing emails at any time.</li>
                            <li><strong>Analytics:</strong> To analyze usage trends, measure the effectiveness of our platform, and conduct research.</li>
                            <li><strong>Legal Compliance:</strong> To comply with applicable laws, regulations, and legal processes.</li>
                            <li><strong>Security:</strong> To detect, prevent, and address fraud, security breaches, and technical issues.</li>
                        </ul>
                    </div>

                    {{-- 4. Information Sharing --}}
                    <div class="policy-section" id="info-sharing">
                        <h2>4. Information Sharing & Disclosure</h2>
                        <p>We do not sell your personal information. We may share your information in the following circumstances:</p>
                        <ul>
                            <li><strong>Public Reviews:</strong> Reviews and associated profile information (as chosen by you) are displayed publicly on our platform.</li>
                            <li><strong>Service Providers:</strong> We share data with trusted third-party vendors who assist us with hosting, analytics, payment processing, and email delivery.</li>
                            <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets, your information may be transferred.</li>
                            <li><strong>Legal Requirements:</strong> When required by law, regulation, legal process, or governmental request.</li>
                            <li><strong>With Your Consent:</strong> When you have given us explicit permission to share your information.</li>
                        </ul>
                    </div>

                    {{-- 5. Cookies --}}
                    <div class="policy-section" id="cookies">
                        <h2>5. Cookies & Tracking Technologies</h2>
                        <p>We use cookies, web beacons, and similar tracking technologies to enhance your browsing experience:</p>
                        <ul>
                            <li><strong>Essential Cookies:</strong> Required for site functionality, authentication, and security.</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our website (e.g., Google Analytics, Microsoft Clarity).</li>
                            <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements and measure campaign effectiveness.</li>
                        </ul>
                        <div class="highlight-box">
                            You can manage cookie preferences through your browser settings. Disabling certain cookies may affect site functionality.
                        </div>
                    </div>

                    {{-- 6. Data Security --}}
                    <div class="policy-section" id="data-security">
                        <h2>6. Data Security</h2>
                        <p>We implement industry-standard security measures to protect your information, including:</p>
                        <ul>
                            <li>SSL/TLS encryption for data transmission</li>
                            <li>Encrypted storage of sensitive data</li>
                            <li>Regular security audits and vulnerability assessments</li>
                            <li>Access controls limiting employee access to personal data</li>
                            <li>Secure third-party payment processing (PCI-DSS compliant)</li>
                        </ul>
                        <p>While we strive to protect your data, no method of electronic transmission or storage is 100% secure. We cannot guarantee absolute security.</p>
                    </div>

                    {{-- 7. Data Retention --}}
                    <div class="policy-section" id="data-retention">
                        <h2>7. Data Retention</h2>
                        <p>We retain your personal information for as long as your account is active or as needed to provide Services. We may also retain data as required for legal obligations, dispute resolution, and agreement enforcement. When data is no longer needed, we securely delete or anonymize it.</p>
                    </div>

                    {{-- 8. Your Rights --}}
                    <div class="policy-section" id="your-rights">
                        <h2>8. Your Rights & Choices</h2>
                        <p>Depending on your jurisdiction, you may have the following rights:</p>
                        <ul>
                            <li><strong>Access:</strong> Request a copy of the personal data we hold about you.</li>
                            <li><strong>Correction:</strong> Request correction of inaccurate or incomplete data.</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal data, subject to legal obligations.</li>
                            <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications at any time.</li>
                            <li><strong>Data Portability:</strong> Request your data in a structured, machine-readable format.</li>
                            <li><strong>Withdraw Consent:</strong> Where processing is based on consent, you may withdraw it at any time.</li>
                        </ul>
                        <p>To exercise any of these rights, please contact us at <a href="mailto:privacy@theytrust.us">privacy@theytrust.us</a>.</p>
                    </div>

                    {{-- 9. Third-Party Links --}}
                    <div class="policy-section" id="third-party">
                        <h2>9. Third-Party Links</h2>
                        <p>Our platform may contain links to third-party websites and services. We are not responsible for the privacy practices or content of these external sites. We encourage you to review their privacy policies before providing any personal information.</p>
                    </div>

                    {{-- 10. Children's Privacy --}}
                    <div class="policy-section" id="children">
                        <h2>10. Children's Privacy</h2>
                        <p>Our Services are not intended for individuals under 18 years of age. We do not knowingly collect personal information from children. If we become aware that a child has provided us with personal data, we will take steps to delete such information promptly.</p>
                    </div>

                    {{-- 11. International Transfers --}}
                    <div class="policy-section" id="international">
                        <h2>11. International Data Transfers</h2>
                        <p>Your information may be transferred to and processed in countries other than your country of residence. These countries may have different data protection laws. We take appropriate safeguards to ensure your information remains protected in accordance with this Privacy Policy.</p>
                    </div>

                    {{-- 12. Changes --}}
                    <div class="policy-section" id="changes">
                        <h2>12. Changes to This Policy</h2>
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal, operational, or regulatory reasons. We will notify you of material changes by posting the updated policy on this page with a revised "Last Updated" date. Your continued use of the Services after changes constitutes your acceptance of the updated policy.</p>
                    </div>

                    {{-- 13. Contact --}}
                    <div class="policy-section" id="contact">
                        <h2>13. Contact Us</h2>
                        <div class="contact-card">
                            <h4>Have Questions About Your Privacy?</h4>
                            <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                            <p><strong>They Trust Us</strong></p>
                            <p><i class="fas fa-envelope mr-2" style="color: #2cc8dd;"></i> Email: <a href="mailto:privacy@theytrust.us">privacy@theytrust.us</a></p>
                            <p><i class="fas fa-globe mr-2" style="color: #2cc8dd;"></i> Website: <a href="https://theytrust.us">theytrust.us</a></p>
                            <p><i class="fas fa-map-marker-alt mr-2" style="color: #2cc8dd;"></i> Address: United States</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
