@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Terms of Use - They Trust Us | User Agreement & Guidelines';
        $meta_description = 'Read the Terms of Use for They Trust Us. Understand your rights, responsibilities, and the rules governing the use of our trusted service provider directory platform.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/terms-of-use') }}">
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
                            <li><a href="#governing-law">Governing Law & Disputes</a></li>
                            <li><a href="#modifications">Modifications to Terms</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                        </ol>
                    </div>

                    {{-- 1. Acceptance --}}
                    <div class="terms-section" id="acceptance">
                        <h2>1. Acceptance of Terms</h2>
                        <p>Welcome to They Trust Us. These Terms of Use ("Terms") constitute a legally binding agreement between you ("User," "you," or "your") and They Trust Us ("we," "our," or "us") governing your access to and use of the website <strong>theytrust.us</strong> and all related services, features, content, and applications (collectively, the "Services").</p>
                        <div class="highlight-box">
                            By accessing or using our Services, creating an account, submitting reviews, listing your company, or browsing our platform, you acknowledge that you have read, understood, and agree to be bound by these Terms and our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>. If you do not agree to any part of these Terms, you must immediately discontinue use of the Services.
                        </div>
                    </div>

                    {{-- 2. Eligibility --}}
                    <div class="terms-section" id="eligibility">
                        <h2>2. Eligibility</h2>
                        <p>To use our Services, you must meet the following requirements:</p>
                        <ul>
                            <li>Be at least <strong>18 years of age</strong> or the age of legal majority in your jurisdiction, whichever is greater.</li>
                            <li>Have the legal capacity and authority to enter into a binding agreement.</li>
                            <li>Not be barred from using the Services under applicable laws of your jurisdiction.</li>
                            <li>If registering on behalf of a company or organization, you must have the authority to bind that entity to these Terms, and all references to "you" shall include that entity.</li>
                        </ul>
                        <p>We reserve the right to refuse service, terminate accounts, or restrict access at our sole discretion if we believe eligibility requirements are not met or have been misrepresented.</p>
                    </div>

                    {{-- 3. Account --}}
                    <div class="terms-section" id="account">
                        <h2>3. Account Registration</h2>
                        <p>When you create an account on They Trust Us, you agree to the following:</p>
                        <ul>
                            <li><strong>Accurate Information:</strong> Provide truthful, current, and complete registration information including your real name, valid email address, and company affiliation.</li>
                            <li><strong>Account Maintenance:</strong> Promptly update your account information whenever changes occur to keep it accurate and current.</li>
                            <li><strong>Password Security:</strong> Keep your password confidential and secure. Use a strong, unique password that you do not use on other websites.</li>
                            <li><strong>Account Responsibility:</strong> You are solely responsible for all activities that occur under your account, whether or not authorized by you.</li>
                            <li><strong>Unauthorized Access:</strong> Notify us immediately at <a href="mailto:support@theytrust.us" style="color:#2cc8dd;">support@theytrust.us</a> if you suspect any unauthorized access to your account.</li>
                            <li><strong>Single Account:</strong> Each individual may maintain only one personal account. Creating multiple accounts to manipulate reviews or circumvent restrictions is strictly prohibited.</li>
                        </ul>
                        <div class="warning-box">
                            <strong>Important:</strong> We reserve the right to suspend or permanently terminate accounts that contain inaccurate information, violate these Terms, are used for fraudulent purposes, or remain inactive for an extended period.
                        </div>
                    </div>

                    {{-- 4. Services --}}
                    <div class="terms-section" id="services">
                        <h2>4. Description of Services</h2>
                        <p>They Trust Us is a comprehensive platform that connects businesses seeking services with qualified, vetted service providers. Our Services include, but are not limited to:</p>
                        <ul>
                            <li><strong>Provider Directory:</strong> A searchable, categorized directory of service providers across multiple industries including marketing, web development, mobile app development, analytics, and more.</li>
                            <li><strong>Review & Rating Platform:</strong> A verified review system that enables clients to share honest feedback about their experiences with service providers.</li>
                            <li><strong>Company Profiles:</strong> Tools for service providers to create comprehensive profiles showcasing their expertise, portfolio, team, certifications, and client testimonials.</li>
                            <li><strong>Search & Discovery:</strong> Advanced filtering and search tools to help buyers find the right service providers based on industry, location, budget, expertise, and ratings.</li>
                            <li><strong>Sponsorship & Premium Listings:</strong> Enhanced visibility options including sponsored placements, featured listings, and premium profile upgrades for service providers.</li>
                            <li><strong>Project Bundles:</strong> Curated bundles for common project types to help businesses quickly find providers for specific needs.</li>
                        </ul>
                        <p>We reserve the right to modify, suspend, or discontinue any part of the Services at any time, with or without notice.</p>
                    </div>

                    {{-- 5. User Content --}}
                    <div class="terms-section" id="user-content">
                        <h2>5. User Content & Reviews</h2>

                        <h3>5.1 Your Content</h3>
                        <p>You may submit reviews, ratings, comments, company information, portfolio items, images, and other materials ("User Content") through the Services. By submitting User Content, you:</p>
                        <ul>
                            <li>Grant They Trust Us a non-exclusive, worldwide, royalty-free, perpetual, irrevocable, sublicensable license to use, display, reproduce, modify, adapt, publish, translate, and distribute your User Content in connection with the Services and our marketing efforts.</li>
                            <li>Represent and warrant that you own or have all necessary rights, licenses, and permissions to submit the content and grant the above license.</li>
                            <li>Agree that your User Content does not and will not violate any third-party rights, including intellectual property rights, privacy rights, or publicity rights.</li>
                            <li>Acknowledge that User Content may be visible to other users and the general public.</li>
                        </ul>

                        <h3>5.2 Review Guidelines</h3>
                        <p>When submitting reviews on They Trust Us, you must adhere to the following guidelines:</p>
                        <ul>
                            <li><strong>Authenticity:</strong> Reviews must be based on genuine, first-hand experiences with the service provider. You must have had a real business relationship with the company you are reviewing.</li>
                            <li><strong>Honesty:</strong> Reviews must be truthful, accurate, fair, and not intentionally misleading.</li>
                            <li><strong>No Fake Reviews:</strong> Submitting fake, fabricated, paid-for, or incentivized reviews (whether positive or negative) is strictly prohibited.</li>
                            <li><strong>No Self-Reviews:</strong> You may not review your own company, or have employees, contractors, friends, or family submit reviews on your behalf.</li>
                            <li><strong>No Harassment:</strong> Reviews must not contain personal attacks, threats, hate speech, discriminatory language, or defamatory statements.</li>
                            <li><strong>No Confidential Information:</strong> Do not include proprietary, confidential, or trade secret information belonging to the reviewed company.</li>
                            <li><strong>Relevance:</strong> Reviews should focus on the quality of services received, professionalism, communication, and overall experience.</li>
                        </ul>

                        <h3>5.3 Content Moderation</h3>
                        <p>We reserve the right to review, edit, flag, or remove any User Content at our sole discretion, including content that:</p>
                        <ul>
                            <li>Violates these Terms or our review guidelines.</li>
                            <li>Is determined to be fake, fraudulent, or manipulative.</li>
                            <li>Contains inaccurate, offensive, or harmful material.</li>
                            <li>Infringes on intellectual property or privacy rights.</li>
                        </ul>
                        <p>We are not obligated to publish, maintain, or preserve any User Content. Removal decisions are final and at our sole discretion.</p>
                    </div>

                    {{-- 6. Conduct --}}
                    <div class="terms-section" id="conduct">
                        <h2>6. Acceptable Use & Conduct</h2>
                        <p>When using our Services, you agree <strong>not to</strong> engage in any of the following prohibited activities:</p>
                        <ul>
                            <li>Violate any applicable local, state, national, or international laws or regulations.</li>
                            <li>Impersonate any person, business, or entity, or falsely represent your professional affiliation.</li>
                            <li>Submit false, misleading, or fraudulent information in profiles, reviews, or communications.</li>
                            <li>Use automated systems, bots, scrapers, crawlers, or data mining tools to access, collect, or extract data from the Services without prior written consent.</li>
                            <li>Attempt to gain unauthorized access to any part of the Services, other user accounts, computer systems, or networks connected to the Services.</li>
                            <li>Interfere with, disrupt, or place an unreasonable load on the Services, servers, or networks.</li>
                            <li>Upload, transmit, or distribute viruses, malware, ransomware, spyware, or other harmful code.</li>
                            <li>Engage in spamming, phishing, or unsolicited commercial communications through the platform.</li>
                            <li>Manipulate rankings, ratings, or search results through artificial means.</li>
                            <li>Use the Services to collect personal information about other users without their consent.</li>
                            <li>Use the Services for any purpose that is competitive with or detrimental to They Trust Us.</li>
                            <li>Circumvent any access controls, security features, or usage limitations of the Services.</li>
                        </ul>
                    </div>

                    {{-- 7. IP --}}
                    <div class="terms-section" id="ip">
                        <h2>7. Intellectual Property</h2>
                        <p>All content, features, functionality, design elements, and technology of the Services, including but not limited to text, graphics, logos, icons, images, audio, video, software, algorithms, and the compilation and arrangement thereof, are the exclusive property of They Trust Us or its licensors and are protected by copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
                        <ul>
                            <li>The "They Trust Us" name, logo, tagline, and all related names, designs, and trademarks are our exclusive property. You may not use them without prior written permission.</li>
                            <li>You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or exploit any of our content without prior written consent.</li>
                            <li>You retain ownership of your User Content but grant us the license described in Section 5.1 above.</li>
                            <li>Any feedback, suggestions, or ideas you provide to us about the Services may be used by us without obligation or compensation to you.</li>
                        </ul>
                    </div>

                    {{-- 8. Listings --}}
                    <div class="terms-section" id="listings">
                        <h2>8. Company Listings & Profiles</h2>
                        <p>Service providers who create company profiles on They Trust Us agree to the following:</p>
                        <ul>
                            <li><strong>Accuracy:</strong> Provide accurate and truthful information about your company, including business name, services offered, team size, year founded, location, and capabilities.</li>
                            <li><strong>Currency:</strong> Keep your profile information current, accurate, and up to date. Outdated or misleading profiles may be flagged or removed.</li>
                            <li><strong>No Misrepresentation:</strong> Do not misrepresent your qualifications, certifications, experience, portfolio, client list, or past projects.</li>
                            <li><strong>Reviews:</strong> Accept that verified reviews from genuine clients may be published on your profile. You may respond to reviews professionally but may not pressure or coerce clients to modify or remove reviews.</li>
                            <li><strong>Portfolio & Media:</strong> All images, case studies, and portfolio items you upload must be your original work or work you have permission to display.</li>
                            <li><strong>Compliance:</strong> Comply with all applicable business licensing, industry regulations, and professional standards in your jurisdiction.</li>
                        </ul>
                        <p>We reserve the right to verify, modify, suspend, or remove any company listing at our sole discretion, including listings that contain inaccurate information, violate these Terms, or receive consistently negative verified reviews.</p>
                    </div>

                    {{-- 9. Payments --}}
                    <div class="terms-section" id="payments">
                        <h2>9. Payments & Subscriptions</h2>
                        <p>If you purchase premium services, sponsorships, or subscription plans on They Trust Us, the following terms apply:</p>
                        <ul>
                            <li><strong>Pricing:</strong> All fees are quoted in US dollars (USD) and are exclusive of applicable taxes unless stated otherwise. We reserve the right to change pricing with 30 days' advance notice.</li>
                            <li><strong>Billing Cycle:</strong> Subscription fees are billed in advance on a recurring basis (monthly or annually, depending on the plan you select).</li>
                            <li><strong>Payment Methods:</strong> We accept major credit cards, debit cards, and other payment methods as displayed at checkout. You authorize us to charge your selected payment method for all applicable fees.</li>
                            <li><strong>Auto-Renewal:</strong> Subscriptions automatically renew at the end of each billing period unless you cancel before the renewal date.</li>
                            <li><strong>Cancellation:</strong> You may cancel your subscription at any time through your account settings or by contacting support. Cancellations take effect at the end of the current billing period — you will retain access until then.</li>
                            <li><strong>Refunds:</strong> Fees are generally non-refundable once the billing period has begun, unless otherwise stated in a specific plan agreement or required by applicable law.</li>
                            <li><strong>Failed Payments:</strong> If a payment fails, we may suspend your premium features until payment is successfully processed. We may retry the payment or contact you for updated payment information.</li>
                            <li><strong>Payment Security:</strong> All payment transactions are processed through secure, PCI-DSS compliant third-party payment processors. We do not store your full credit card details on our servers.</li>
                        </ul>
                    </div>

                    {{-- 10. Third Party --}}
                    <div class="terms-section" id="third-party">
                        <h2>10. Third-Party Services</h2>
                        <p>The Services may contain links to, or integrations with, third-party websites, applications, and services, including but not limited to:</p>
                        <ul>
                            <li>Social media platforms (LinkedIn, Facebook, Twitter)</li>
                            <li>Payment processors (Stripe)</li>
                            <li>Analytics services (Google Analytics, Microsoft Clarity)</li>
                            <li>Email service providers</li>
                        </ul>
                        <p>We do not control, endorse, or assume responsibility for the content, privacy policies, practices, or availability of any third-party services. Your use of third-party services is governed by their respective terms and privacy policies. We encourage you to review their terms before using them. Any interactions or transactions between you and third-party providers are solely between you and that provider.</p>
                    </div>

                    {{-- 11. Disclaimers --}}
                    <div class="terms-section" id="disclaimer">
                        <h2>11. Disclaimers</h2>
                        <div class="warning-box">
                            <p class="mb-0"><strong>THE SERVICES ARE PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NON-INFRINGEMENT.</strong></p>
                        </div>
                        <p>Without limiting the foregoing, we do not warrant that:</p>
                        <ul>
                            <li>The Services will be uninterrupted, timely, error-free, or secure at all times.</li>
                            <li>Reviews, ratings, and profiles posted on the platform are accurate, reliable, complete, or current.</li>
                            <li>The results obtained from using the Services will meet your specific requirements or expectations.</li>
                            <li>Any service provider listed on our platform will deliver satisfactory results, fulfill their obligations, or meet professional standards.</li>
                            <li>Any defects or errors in the Services will be corrected.</li>
                        </ul>
                        <p>They Trust Us acts as a neutral platform for connecting buyers and service providers. We do not endorse, guarantee, vouch for, or assume any responsibility for any service provider listed on our platform, the quality of their work, or the outcomes of any engagement between you and a service provider.</p>
                    </div>

                    {{-- 12. Liability --}}
                    <div class="terms-section" id="liability">
                        <h2>12. Limitation of Liability</h2>
                        <p>To the maximum extent permitted by applicable law, They Trust Us, its parent company, subsidiaries, affiliates, officers, directors, employees, agents, partners, and licensors shall not be liable for any indirect, incidental, special, consequential, exemplary, or punitive damages, including but not limited to:</p>
                        <ul>
                            <li>Loss of profits, revenue, data, use, goodwill, or other intangible losses.</li>
                            <li>Damages resulting from your use of or inability to use the Services.</li>
                            <li>Damages resulting from any content posted or made available through the Services.</li>
                            <li>Unauthorized access to or alteration of your transmissions or data.</li>
                            <li>Statements or conduct of any third party on the Services.</li>
                            <li>Any interaction, engagement, or dispute between you and a service provider found through our platform.</li>
                        </ul>
                        <p><strong>In no event shall our total aggregate liability for all claims related to the Services exceed the greater of (a) the amount you paid to us in the twelve (12) months preceding the claim, or (b) one hundred US dollars ($100).</strong></p>
                    </div>

                    {{-- 13. Indemnification --}}
                    <div class="terms-section" id="indemnification">
                        <h2>13. Indemnification</h2>
                        <p>You agree to indemnify, defend, and hold harmless They Trust Us and its parent company, subsidiaries, affiliates, officers, directors, employees, agents, partners, and licensors from and against any and all claims, demands, liabilities, damages, losses, costs, and expenses (including reasonable attorneys' fees and court costs) arising out of or related to:</p>
                        <ul>
                            <li>Your access to or use of the Services.</li>
                            <li>Your violation of these Terms or any applicable law or regulation.</li>
                            <li>Your User Content, including any claims that your content infringes any third-party rights.</li>
                            <li>Any activity conducted through your account, whether or not authorized by you.</li>
                            <li>Your interaction with any service provider or other user of the platform.</li>
                        </ul>
                    </div>

                    {{-- 14. Termination --}}
                    <div class="terms-section" id="termination">
                        <h2>14. Termination</h2>
                        <p>We may terminate or suspend your account and access to the Services immediately, with or without prior notice or liability, for any reason, including but not limited to:</p>
                        <ul>
                            <li>Violation of these Terms or our community guidelines.</li>
                            <li>Fraudulent, abusive, or illegal activity on the platform.</li>
                            <li>Submission of fake or manipulated reviews.</li>
                            <li>Extended periods of inactivity (12+ months with no login).</li>
                            <li>Failure to pay applicable subscription fees.</li>
                            <li>At our sole discretion, for any reason we deem appropriate.</li>
                        </ul>
                        <p><strong>Upon termination:</strong></p>
                        <ul>
                            <li>Your right to use the Services ceases immediately.</li>
                            <li>We may delete your account data, profile, and associated content.</li>
                            <li>Any outstanding fees remain due and payable.</li>
                            <li>Provisions of these Terms that by their nature should survive termination (including Sections 5.1, 7, 11, 12, 13, and 15) shall continue to apply.</li>
                        </ul>
                        <p>You may also terminate your account at any time by contacting us at <a href="mailto:support@theytrust.us" style="color:#2cc8dd;">support@theytrust.us</a> or through your account settings.</p>
                    </div>

                    {{-- 15. Governing Law --}}
                    <div class="terms-section" id="governing-law">
                        <h2>15. Governing Law & Disputes</h2>
                        <p>These Terms shall be governed by and construed in accordance with the laws of the United States, without regard to its conflict of law provisions. Any disputes arising from or relating to these Terms, the Services, or your relationship with They Trust Us shall be resolved as follows:</p>
                        <ul>
                            <li><strong>Informal Resolution:</strong> Before filing any formal claim, you agree to first contact us at <a href="mailto:legal@theytrust.us" style="color:#2cc8dd;">legal@theytrust.us</a> and attempt to resolve the dispute informally for at least 30 days.</li>
                            <li><strong>Arbitration:</strong> If informal resolution fails, disputes shall be resolved through binding arbitration in accordance with the rules of the American Arbitration Association (AAA).</li>
                            <li><strong>Class Action Waiver:</strong> You agree that any dispute resolution proceedings will be conducted only on an individual basis and not in a class, consolidated, or representative action.</li>
                        </ul>
                    </div>

                    {{-- 16. Modifications --}}
                    <div class="terms-section" id="modifications">
                        <h2>16. Modifications to Terms</h2>
                        <p>We reserve the right to modify, update, or replace these Terms at any time at our sole discretion. When we make changes:</p>
                        <ul>
                            <li>We will update the "Last Updated" date at the top of this page.</li>
                            <li>For material changes, we will provide notice through email or a prominent banner on our website at least 15 days before the changes take effect.</li>
                            <li>Your continued use of the Services after the effective date of any modifications constitutes your acceptance of the updated Terms.</li>
                        </ul>
                        <p>If you do not agree to the modified Terms, you must stop using the Services and may request account deletion. We encourage you to review these Terms periodically to stay informed of any updates.</p>
                    </div>

                    {{-- 17. Contact --}}
                    <div class="terms-section" id="contact">
                        <h2>17. Contact Us</h2>
                        <div class="contact-card">
                            <h4>Questions About Our Terms?</h4>
                            <p>If you have any questions, concerns, or requests regarding these Terms of Use, please reach out to our team:</p>
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
