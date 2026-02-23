@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Privacy Policy - They Trust Us | Protecting Your Data';
        $meta_description = 'Learn how They Trust Us collects, uses, and protects your personal information. Our Privacy Policy explains your data rights and our commitment to security.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/privacy-policy') }}">
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
        columns: 2;
    }
    @media (max-width: 576px) {
        .privacy-content .toc ol {
            columns: 1;
        }
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
                            <li><strong>Profile Data:</strong> Location, industry, biography, profile photo, and other details you choose to share on your public profile.</li>
                            <li><strong>Review Content:</strong> Reviews, ratings, project details, and feedback you submit about service providers.</li>
                            <li><strong>Payment Information:</strong> Billing details and payment card information when you purchase premium services (processed securely through third-party payment processors like Stripe).</li>
                            <li><strong>Communications:</strong> Messages, inquiries, and correspondence you send to us or through our platform.</li>
                            <li><strong>Company Profile Data:</strong> Business name, description, services offered, portfolio items, team information, and certifications when listing your company.</li>
                        </ul>

                        <h3>2.2 Information Collected Automatically</h3>
                        <ul>
                            <li><strong>Device & Browser Data:</strong> IP address, browser type and version, operating system, device identifiers, and screen resolution.</li>
                            <li><strong>Usage Data:</strong> Pages visited, time spent on pages, click patterns, search queries, referring URLs, and navigation paths.</li>
                            <li><strong>Location Data:</strong> Approximate geographic location derived from your IP address.</li>
                            <li><strong>Log Data:</strong> Server logs including access times, pages viewed, and system activity.</li>
                        </ul>

                        <h3>2.3 Information from Third Parties</h3>
                        <ul>
                            <li><strong>Social Login:</strong> If you sign in using LinkedIn or other social platforms, we receive your name, email, profile picture, and professional information as authorized by you.</li>
                            <li><strong>Business Verification Partners:</strong> We may receive information from partners who help us verify company profiles, reviews, and business credentials.</li>
                            <li><strong>Analytics Providers:</strong> We receive aggregated usage data from analytics services such as Google Analytics and Microsoft Clarity.</li>
                        </ul>
                    </div>

                    {{-- 3. How We Use Your Information --}}
                    <div class="policy-section" id="how-use">
                        <h2>3. How We Use Your Information</h2>
                        <p>We use the information we collect for the following purposes:</p>
                        <ul>
                            <li><strong>Provide & Improve Services:</strong> To operate, maintain, and enhance our platform, including personalizing your experience and search results.</li>
                            <li><strong>Account Management:</strong> To create and manage your account, authenticate users, and provide customer support.</li>
                            <li><strong>Review Verification:</strong> To validate the authenticity of reviews, detect fraudulent activity, and maintain the integrity of our ratings platform.</li>
                            <li><strong>Matching & Recommendations:</strong> To help businesses find the right service providers based on industry, location, and expertise.</li>
                            <li><strong>Communications:</strong> To send service updates, newsletters, marketing materials, and respond to your inquiries. You may opt out of marketing emails at any time.</li>
                            <li><strong>Analytics & Research:</strong> To analyze usage trends, measure platform effectiveness, and conduct research to improve our Services.</li>
                            <li><strong>Legal Compliance:</strong> To comply with applicable laws, regulations, legal processes, and governmental requests.</li>
                            <li><strong>Security & Fraud Prevention:</strong> To detect, prevent, and address fraud, security breaches, abuse, and technical issues.</li>
                        </ul>
                    </div>

                    {{-- 4. Information Sharing --}}
                    <div class="policy-section" id="info-sharing">
                        <h2>4. Information Sharing & Disclosure</h2>
                        <p>We do not sell your personal information to third parties. We may share your information in the following circumstances:</p>
                        <ul>
                            <li><strong>Public Reviews & Profiles:</strong> Reviews, ratings, and associated profile information (as configured by you) are displayed publicly on our platform to help businesses make informed decisions.</li>
                            <li><strong>Service Providers:</strong> We share data with trusted third-party vendors who assist us with hosting, analytics, payment processing, email delivery, and customer support.</li>
                            <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, reorganization, or sale of assets, your information may be transferred to the acquiring entity.</li>
                            <li><strong>Legal Requirements:</strong> When required by law, regulation, legal process, or enforceable governmental request.</li>
                            <li><strong>Protection of Rights:</strong> When necessary to protect the rights, property, or safety of They Trust Us, our users, or the public.</li>
                            <li><strong>With Your Consent:</strong> When you have given us explicit permission to share your information for a specific purpose.</li>
                        </ul>
                    </div>

                    {{-- 5. Cookies --}}
                    <div class="policy-section" id="cookies">
                        <h2>5. Cookies & Tracking Technologies</h2>
                        <p>We use cookies, web beacons, pixels, and similar tracking technologies to enhance your browsing experience and analyze platform usage:</p>
                        <ul>
                            <li><strong>Essential Cookies:</strong> Required for core site functionality, user authentication, session management, and security features. These cannot be disabled.</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our website, which pages are most popular, and how users navigate the platform (e.g., Google Analytics, Microsoft Clarity).</li>
                            <li><strong>Functional Cookies:</strong> Remember your preferences, language settings, and personalization choices to provide a better user experience.</li>
                            <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements, measure campaign effectiveness, and track conversions across platforms.</li>
                        </ul>
                        <div class="highlight-box">
                            You can manage cookie preferences through your browser settings. Most browsers allow you to block or delete cookies. However, disabling certain cookies may affect site functionality and your ability to use some features.
                        </div>
                    </div>

                    {{-- 6. Data Security --}}
                    <div class="policy-section" id="data-security">
                        <h2>6. Data Security</h2>
                        <p>We implement industry-standard security measures to protect your information, including:</p>
                        <ul>
                            <li>SSL/TLS encryption for all data transmitted between your browser and our servers.</li>
                            <li>Encrypted storage of sensitive data including passwords (bcrypt hashing) and payment information.</li>
                            <li>Regular security audits, penetration testing, and vulnerability assessments.</li>
                            <li>Role-based access controls limiting employee access to personal data on a need-to-know basis.</li>
                            <li>Secure third-party payment processing through PCI-DSS compliant providers.</li>
                            <li>Automated monitoring systems to detect unusual activity and potential security threats.</li>
                        </ul>
                        <p>While we strive to protect your data using commercially reasonable measures, no method of electronic transmission or storage is 100% secure. We cannot guarantee absolute security but are committed to promptly addressing any security incidents.</p>
                    </div>

                    {{-- 7. Data Retention --}}
                    <div class="policy-section" id="data-retention">
                        <h2>7. Data Retention</h2>
                        <p>We retain your personal information for as long as your account is active or as needed to provide our Services. Specific retention periods include:</p>
                        <ul>
                            <li><strong>Account Data:</strong> Retained for the duration of your account plus 30 days after deletion request to allow for recovery.</li>
                            <li><strong>Reviews & Ratings:</strong> Retained indefinitely as part of the public record unless removal is requested and approved.</li>
                            <li><strong>Transaction Records:</strong> Retained for 7 years as required by financial regulations.</li>
                            <li><strong>Server Logs:</strong> Retained for 90 days for security and troubleshooting purposes.</li>
                            <li><strong>Marketing Preferences:</strong> Retained until you update your preferences or close your account.</li>
                        </ul>
                        <p>When data is no longer needed, we securely delete or anonymize it using industry-standard data destruction methods.</p>
                    </div>

                    {{-- 8. Your Rights --}}
                    <div class="policy-section" id="your-rights">
                        <h2>8. Your Rights & Choices</h2>
                        <p>Depending on your jurisdiction (including rights under GDPR, CCPA, and other data protection laws), you may have the following rights:</p>
                        <ul>
                            <li><strong>Right of Access:</strong> Request a copy of the personal data we hold about you.</li>
                            <li><strong>Right to Correction:</strong> Request correction of inaccurate or incomplete data.</li>
                            <li><strong>Right to Deletion:</strong> Request deletion of your personal data, subject to legal retention obligations.</li>
                            <li><strong>Right to Opt-Out:</strong> Unsubscribe from marketing communications at any time via the unsubscribe link in emails or your account settings.</li>
                            <li><strong>Right to Data Portability:</strong> Request your data in a structured, commonly used, machine-readable format.</li>
                            <li><strong>Right to Restrict Processing:</strong> Request that we limit how we use your data in certain circumstances.</li>
                            <li><strong>Right to Withdraw Consent:</strong> Where processing is based on consent, you may withdraw it at any time without affecting prior processing.</li>
                            <li><strong>Right to Non-Discrimination:</strong> We will not discriminate against you for exercising your privacy rights.</li>
                        </ul>
                        <p>To exercise any of these rights, please contact us at <a href="mailto:privacy@theytrust.us" style="color: #2cc8dd;">privacy@theytrust.us</a>. We will respond to your request within 30 days.</p>
                    </div>

                    {{-- 9. Third-Party Links --}}
                    <div class="policy-section" id="third-party">
                        <h2>9. Third-Party Links</h2>
                        <p>Our platform may contain links to third-party websites, services, and applications. These include but are not limited to social media platforms, payment processors, and partner websites. We are not responsible for the privacy practices, content, or security of these external sites. We strongly encourage you to review their privacy policies before providing any personal information.</p>
                    </div>

                    {{-- 10. Children's Privacy --}}
                    <div class="policy-section" id="children">
                        <h2>10. Children's Privacy</h2>
                        <p>Our Services are designed for business professionals and are not intended for individuals under 18 years of age. We do not knowingly collect personal information from children under 18. If we become aware that a child has provided us with personal data without parental consent, we will take immediate steps to delete such information. If you believe a child has provided us with their information, please contact us at <a href="mailto:privacy@theytrust.us" style="color: #2cc8dd;">privacy@theytrust.us</a>.</p>
                    </div>

                    {{-- 11. International Transfers --}}
                    <div class="policy-section" id="international">
                        <h2>11. International Data Transfers</h2>
                        <p>Your information may be transferred to and processed in countries other than your country of residence, including the United States where our servers are located. These countries may have different data protection laws than your jurisdiction. When we transfer data internationally, we implement appropriate safeguards including:</p>
                        <ul>
                            <li>Standard Contractual Clauses (SCCs) approved by relevant authorities.</li>
                            <li>Data processing agreements with all third-party service providers.</li>
                            <li>Encryption of data in transit and at rest.</li>
                        </ul>
                    </div>

                    {{-- 12. Changes --}}
                    <div class="policy-section" id="changes">
                        <h2>12. Changes to This Policy</h2>
                        <p>We may update this Privacy Policy periodically to reflect changes in our practices, technology, legal requirements, or for other operational reasons. When we make material changes, we will:</p>
                        <ul>
                            <li>Update the "Last Updated" date at the top of this page.</li>
                            <li>Post a prominent notice on our website.</li>
                            <li>Send email notification to registered users for significant changes.</li>
                        </ul>
                        <p>Your continued use of the Services after any modifications constitutes your acceptance of the updated Privacy Policy. We encourage you to review this page periodically.</p>
                    </div>

                    {{-- 13. Contact --}}
                    <div class="policy-section" id="contact">
                        <h2>13. Contact Us</h2>
                        <div class="contact-card">
                            <h4>Have Questions About Your Privacy?</h4>
                            <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please reach out to us:</p>
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
