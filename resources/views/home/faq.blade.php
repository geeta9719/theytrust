@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Frequently Asked Questions - They Trust Us | FAQ';
        $meta_description = 'Find answers to commonly asked questions about They Trust Us. Learn about reviews, ratings, company listings, pricing, and how our platform works.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/faq') }}">
@endsection

@push('styles')
<style>
    .faq-hero {
        background: linear-gradient(135deg, #0d2137 0%, #1a3a5c 100%);
        padding: 60px 0;
        color: #fff;
        text-align: center;
    }
    .faq-hero h1 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .faq-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
        max-width: 600px;
        margin: 0 auto;
    }
    .faq-content {
        padding: 50px 0 80px;
        font-family: 'Inter', sans-serif;
    }
    .faq-category-title {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 1.3rem;
        color: #0d2137;
        margin: 35px 0 18px;
        padding-bottom: 8px;
        border-bottom: 2px solid #2cc8dd;
        display: inline-block;
    }
    .faq-category-title i {
        color: #2cc8dd;
        margin-right: 8px;
    }
    .faq-card {
        border: 1px solid #e2ecf5;
        border-radius: 10px;
        margin-bottom: 12px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow 0.2s;
    }
    .faq-card:hover {
        box-shadow: 0 3px 15px rgba(13, 33, 55, 0.08);
    }
    .faq-card .card-header {
        background: #f8fbff;
        border-bottom: 1px solid #e2ecf5;
        padding: 0;
    }
    .faq-card .card-header .btn-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 16px 22px;
        font-size: 0.98rem;
        font-weight: 600;
        color: #0d2137;
        text-decoration: none;
        text-align: left;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: color 0.2s;
    }
    .faq-card .card-header .btn-link:hover {
        color: #2cc8dd;
    }
    .faq-card .card-header .btn-link .faq-icon {
        font-size: 0.85rem;
        color: #2cc8dd;
        transition: transform 0.3s;
        flex-shrink: 0;
        margin-left: 15px;
    }
    .faq-card .card-header .btn-link.collapsed .faq-icon {
        transform: rotate(0deg);
    }
    .faq-card .card-header .btn-link:not(.collapsed) .faq-icon {
        transform: rotate(180deg);
    }
    .faq-card .card-body {
        padding: 18px 22px;
        font-size: 0.93rem;
        color: #555;
        line-height: 1.8;
        background: #fff;
    }
    .faq-card .card-body ul {
        padding-left: 20px;
        margin: 10px 0;
    }
    .faq-card .card-body ul li {
        margin-bottom: 5px;
    }
    .faq-card .card-body ul li::marker {
        color: #2cc8dd;
    }
    .faq-cta {
        background: linear-gradient(135deg, #f0fdff 0%, #e8f8fb 100%);
        border-radius: 12px;
        padding: 35px;
        margin-top: 50px;
        border: 1px solid #d4f0f5;
        text-align: center;
    }
    .faq-cta h4 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        color: #0d2137;
        margin-bottom: 10px;
    }
    .faq-cta p {
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 18px;
    }
    .faq-cta .btn-contact {
        background: #2cc8dd;
        color: #fff;
        border: none;
        padding: 10px 28px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .faq-cta .btn-contact:hover {
        background: #1a9bb0;
        color: #fff;
    }
    .faq-search-box {
        max-width: 500px;
        margin: 25px auto 0;
        position: relative;
    }
    .faq-search-box input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid rgba(255,255,255,0.25);
        border-radius: 30px;
        background: rgba(255,255,255,0.1);
        color: #fff;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.3s;
    }
    .faq-search-box input::placeholder {
        color: rgba(255,255,255,0.6);
    }
    .faq-search-box input:focus {
        border-color: #2cc8dd;
    }
    .faq-search-box i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.5);
    }
</style>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="faq-hero">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to common questions about They Trust Us, our review process, company listings, and more.</p>
            <div class="faq-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="faqSearch" placeholder="Search questions..." autocomplete="off">
            </div>
        </div>
    </section>

    {{-- FAQ Content --}}
    <section class="faq-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    {{-- Category: Reviews & Ratings --}}
                    <h3 class="faq-category-title"><i class="fas fa-star"></i> Reviews & Ratings</h3>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH1">
                            <button class="btn-link" data-toggle="collapse" data-target="#faqC1" aria-expanded="true">
                                <span>Can I update my review on They Trust Us?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC1" class="collapse show" data-parent=".faq-content">
                            <div class="card-body">
                                Yes, we allow reviewers to update their reviews under specific circumstances. You can request a review update if:
                                <ul>
                                    <li>A substantial amount of additional work has been completed since the original review.</li>
                                    <li>The trajectory of the partnership has significantly changed since the original publication.</li>
                                </ul>
                                To update your review, reach out to our team at <a href="mailto:reviews@theytrust.us" style="color:#2cc8dd;">reviews@theytrust.us</a>. We will schedule a call or send an Updated Review Form. Please note that original review content will remain visible below the updated review for transparency.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH2">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC2" aria-expanded="false">
                                <span>Can I delete my review?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC2" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                We do not allow reviewers to delete their reviews, as they are an important part of the platform's integrity. However, if you believe a review contains factual errors or violates our guidelines, you can contact our team at <a href="mailto:reviews@theytrust.us" style="color:#2cc8dd;">reviews@theytrust.us</a> to discuss potential modifications or an update.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH3">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC3" aria-expanded="false">
                                <span>Is they Trust Us Recommended Rating helpful for choosing a service provider?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC3" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                Absolutely! The They Trust Us Recommended Rating incorporates data from public and third-party sources along with verified client reviews. It provides a reliable assessment of a service provider's quality, credibility, and track record. We recommend using it alongside other sources of information such as:
                                <ul>
                                    <li>Verified client reviews and detailed testimonials</li>
                                    <li>Portfolio samples and case studies</li>
                                    <li>Industry endorsements and certifications</li>
                                    <li>Direct consultations with the service provider</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH4">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC4" aria-expanded="false">
                                <span>How does They Trust Us verify reviews?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC4" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                We take review authenticity very seriously. Our verification process includes:
                                <ul>
                                    <li><strong>Direct Client Contact:</strong> We reach out directly to a company's clients to collect genuine feedback about their experience.</li>
                                    <li><strong>Identity Verification:</strong> Reviewers must provide verifiable contact information tied to their business.</li>
                                    <li><strong>Project Validation:</strong> We confirm that a real business relationship existed between the reviewer and the service provider.</li>
                                    <li><strong>Fraud Detection:</strong> Our automated systems flag suspicious patterns, fake reviews, and manipulated ratings.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Category: Company Listings --}}
                    <h3 class="faq-category-title"><i class="fas fa-building"></i> Company Listings</h3>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH5">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC5" aria-expanded="false">
                                <span>Does They Trust Us offer any free features?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC5" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                Yes! They Trust Us offers service providers several free features to grow their online presence:
                                <ul>
                                    <li><strong>Free Business Profile:</strong> Creating and listing your company on They Trust Us is completely free and takes less than 20 minutes to set up.</li>
                                    <li><strong>Client Reviews:</strong> Our team will verify and populate your profile with genuine client reviews after you provide client references.</li>
                                    <li><strong>Search Visibility:</strong> Your company will appear in relevant category and location-based search results.</li>
                                    <li><strong>Basic Analytics:</strong> Track profile views and engagement metrics.</li>
                                </ul>
                                We also offer premium plans with enhanced visibility, sponsored placements, and advanced analytics features.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH6">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC6" aria-expanded="false">
                                <span>How can I improve my They Trust Us profile and rating?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC6" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                You can improve your company profile and Recommended Rating by following these steps:
                                <ul>
                                    <li><strong>Complete Your Profile:</strong> Claim your listing and fill in all sections including services, portfolio, team members, and certifications.</li>
                                    <li><strong>Collect Quality Reviews:</strong> Encourage satisfied clients to leave detailed, honest reviews about their experience working with you.</li>
                                    <li><strong>Engage with the Community:</strong> Respond to reviews professionally, share thought leadership content, and stay active on the platform.</li>
                                    <li><strong>Keep Information Current:</strong> Regularly update your profile with latest projects, team changes, and service offerings.</li>
                                    <li><strong>Improve Web Presence:</strong> A strong website with good performance and authority positively influences your rating.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH7">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC7" aria-expanded="false">
                                <span>What makes They Trust Us different from other listing platforms?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC7" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                They Trust Us stands out from other B2B listing platforms in several ways:
                                <ul>
                                    <li><strong>Affordable Pricing:</strong> Our premium plans cost significantly less than competitors. Category selections are charged per page, not per individual category.</li>
                                    <li><strong>Faster Review Process:</strong> We have a streamlined, quick review verification process compared to other platforms.</li>
                                    <li><strong>Direct Client Outreach:</strong> We proactively contact your clients to collect genuine reviews, saving you time.</li>
                                    <li><strong>Rich Media Support:</strong> We accept video testimonials, corporate videos, portfolio showcases, and detailed case studies.</li>
                                    <li><strong>Transparent Ratings:</strong> Our Recommended Rating algorithm is based on verified data, not pay-to-play metrics.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Category: For Service Buyers --}}
                    <h3 class="faq-category-title"><i class="fas fa-search"></i> For Service Buyers</h3>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH8">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC8" aria-expanded="false">
                                <span>How do I find the right service provider for my project?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC8" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                Finding the right service provider on They Trust Us is simple:
                                <ul>
                                    <li><strong>Browse by Category:</strong> Navigate our organized categories covering web development, mobile app development, marketing, analytics, and more.</li>
                                    <li><strong>Use Search Filters:</strong> Filter providers by location, budget range, company size, expertise, and ratings.</li>
                                    <li><strong>Read Verified Reviews:</strong> Check detailed client reviews and ratings to assess quality and reliability.</li>
                                    <li><strong>Compare Providers:</strong> Compare pricing, portfolios, and capabilities side by side.</li>
                                    <li><strong>Contact Directly:</strong> Reach out to shortlisted providers directly through their profile page.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH9">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC9" aria-expanded="false">
                                <span>Is it free to browse and search for service providers?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC9" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                Yes, browsing and searching for service providers on They Trust Us is completely free. You can explore company profiles, read verified reviews, compare providers, and contact service providers at no cost. Our platform is designed to help businesses make informed decisions without any barriers.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH10">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC10" aria-expanded="false">
                                <span>What industries and services does They Trust Us cover?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC10" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                They Trust Us covers a wide range of industries and service categories, including:
                                <ul>
                                    <li><strong>Web Development:</strong> Custom websites, e-commerce platforms, CMS development, and more.</li>
                                    <li><strong>Mobile App Development:</strong> iOS, Android, cross-platform, and progressive web apps.</li>
                                    <li><strong>Digital Marketing:</strong> SEO, PPC, social media marketing, content marketing, and email marketing.</li>
                                    <li><strong>Traditional Marketing:</strong> Print advertising, direct mail, event marketing, and brand strategy.</li>
                                    <li><strong>Marketing Analytics:</strong> Data analytics, business intelligence, market research, and reporting.</li>
                                    <li><strong>UI/UX Design:</strong> User interface design, user experience research, and prototyping.</li>
                                </ul>
                                Our category list is continuously expanding to cover more service types.
                            </div>
                        </div>
                    </div>

                    {{-- Category: Account & Platform --}}
                    <h3 class="faq-category-title"><i class="fas fa-cog"></i> Account & Platform</h3>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH11">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC11" aria-expanded="false">
                                <span>How do I create a company profile?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC11" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                Creating a company profile on They Trust Us is quick and easy:
                                <ul>
                                    <li><strong>Step 1:</strong> Click "Sign Up" and create your free account.</li>
                                    <li><strong>Step 2:</strong> Navigate to "Get Listed" and start building your company profile.</li>
                                    <li><strong>Step 3:</strong> Fill in your company details — name, description, services, team size, location, and portfolio.</li>
                                    <li><strong>Step 4:</strong> Upload your logo, cover image, and portfolio samples.</li>
                                    <li><strong>Step 5:</strong> Provide client references for review verification.</li>
                                    <li><strong>Step 6:</strong> Submit your profile for review. Our team will verify and publish it.</li>
                                </ul>
                                The entire process typically takes less than 20 minutes.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH12">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC12" aria-expanded="false">
                                <span>How do I reset my password?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC12" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                To reset your password:
                                <ul>
                                    <li>Click "Sign In" on the homepage.</li>
                                    <li>Click "Forgot Password?" on the login form.</li>
                                    <li>Enter your registered email address.</li>
                                    <li>Check your inbox for the password reset link (also check spam/junk folders).</li>
                                    <li>Click the link and set a new, strong password.</li>
                                </ul>
                                If you continue to have issues, contact us at <a href="mailto:support@theytrust.us" style="color:#2cc8dd;">support@theytrust.us</a>.
                            </div>
                        </div>
                    </div>

                    <div class="faq-card" data-faq>
                        <div class="card-header" id="faqH13">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#faqC13" aria-expanded="false">
                                <span>How do I delete my account?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqC13" class="collapse" data-parent=".faq-content">
                            <div class="card-body">
                                If you wish to delete your account, please email us at <a href="mailto:support@theytrust.us" style="color:#2cc8dd;">support@theytrust.us</a> with your request. Our team will process your account deletion within 30 days. Please note that published reviews may remain on the platform even after account deletion, as outlined in our <a href="{{ route('terms-of-use') }}" style="color:#2cc8dd;">Terms of Use</a>.
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="faq-cta">
                        <h4>Still Have Questions?</h4>
                        <p>Can't find what you're looking for? Our team is ready to help you with any questions or concerns.</p>
                        <a href="{{ url('/contact') }}" class="btn-contact">Contact Our Team</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // FAQ Search
    $('#faqSearch').on('keyup', function() {
        var query = $(this).val().toLowerCase().trim();
        $('[data-faq]').each(function() {
            var question = $(this).find('.btn-link span').text().toLowerCase();
            var answer = $(this).find('.card-body').text().toLowerCase();
            if (question.indexOf(query) > -1 || answer.indexOf(query) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        // Show all category titles, then hide if no visible items after them
        $('.faq-category-title').each(function() {
            var hasVisible = false;
            $(this).nextUntil('.faq-category-title').filter('[data-faq]').each(function() {
                if ($(this).is(':visible')) hasVisible = true;
            });
            $(this).toggle(hasVisible);
        });
    });
});
</script>
@endsection
