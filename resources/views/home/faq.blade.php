@extends('layouts.home-master')
@section('content')
<style>
    .faq-section {
        background-color: #f5f5f5;
        padding: 60px 0;
    }
    .faq-heading {
        text-align: center;
        margin-bottom: 40px;
        color: #333;
        font-size: 28px;
    }
    .faq-item {
        background-color: #fff;
        border: 1px solid #000;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 20px;
        transition: background-color 0.3s ease-in-out;
    }
    .faq-item:hover {
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        border: 1px solid #ddd;
        cursor: pointer;
    }
    .faq-question {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }
    .faq-answer {
        font-size: 16px;
        color: #666;
    }
</style>
<section class="container-fluid signin-banner animatedParent hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">
                    <h3>FAQ</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq-section">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
                <h2 class="faq-heading">Frequently Asked Questions</h2>
                @if(Session::get('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">Can I Update My Review?</div>
                    <div class="faq-answer">
                        We don't allow reviewers to delete their reviews, but we do allow them to update their review.
                        We allow reviews to be updated if:
                        A substantial amount of additional work has been completed, or
                        The trajectory of the partnership has changed following the original review’s publication
                        Reach out the Theytrustus representative who conducted the initial review. If you no longer know
                        the best point of contact, please reach out to reviews@Theytrustus.co.
                        We will schedule a call or send our Updated Review Form to collect feedback on your experience
                        with the vendor, including information regarding an updated scope of work or updated results and
                        feedback.
                        No original review content, including the quote, will be changed or removed from Theytrustus.co.
                        The original content will be listed at the bottom of the more recent review.
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">Is a TheyTrustUs Recommended Rating Helpful For Businesses When Choosing A Partner?</div>
                    <div class="faq-answer">
                        Data from public and third-party sources are incorporated into the TheyTrustUs Recommendability
                        Rating. When making a purchase decision, it shouldn't be treated as the only source of
                        information. Combined with other sources of information on a service provider's credibility,
                        such as client reviews and testimonials, endorsements from industry leaders, and peer
                        recommendations, the TheyTrustUs Recommendability Rating is designed to provide a reliable
                        assessment of a service provider's quality.
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">Does TheyTrustUs offer any free features?</div>
                    <div class="faq-answer">
                        TheyTrustUs offers service providers a variety of free options to find leads, establish online
                        reputations, and establish brand leadership. Upgraded companies can also choose from premium
                        options. Like:
                        <ul>
                            <li>Business Profile: Listing on TheyTrustUs is free and takes less than 20 minutes.</li>
                            <li> Interviews/Client Reviews: Our team will verify and populate your profile with client
                                reviews after receiving client references.</li>
                            <li>Contributed Content: We want to hear about your expertise and thought leadership.</li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">Who are TheyTrustUs' clients/customers/businesses looking for IT companies to hire?</div>
                    <div class="faq-answer">
                        The TheyTrustUs list identifies the best companies and software in various IT domains based on
                        their results from the research process. There are various categories on TheyTrustUs for
                        outsourcing different services and software solutions. Users can browse the categories with
                        verified reviews. They can even compare the prices of similar products and services different
                        companies offer. Therefore, the task of finding an authenticated service/software online for
                        their businesses is greatly reduced for service/software seekers.
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">What makes TheyTrustUs different from other listing platforms?</div>
                    <div class="faq-answer">
                        <ul>
                            <li>
                                Compared to our competitors, our prices are low. Category selections are charged per web
                                page, not per category.</li>
                            <li>Compared to our competitors, we have a short review process.</li>
                            <li>We collect reviews by directly contacting a company's clients and asking them about
                                their experiences.</li>
                            <li>Our company accepts video testimonials, corporate videos, and portfolio videos.</li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">What can I do to improve my TheyTrustUs profile?</div>
                    <div class="faq-answer">
                        You can easily and quickly improve your agency or business' Recommended Rating score by doing
                        the following:
                        <ul>
                            <li>The information on your profile must be claimed and completed.</li>
                            <li>Make your TheyTrustUs profile stand out by collecting high-quality reviews. </li>
                            <li>Keep in touch with the community. </li>
                            <li>Stay up-to-date, accurate, and consistent with your business or organization's public
                                information.</li>
                            <li>Strengthen the performance and authority of your website. </li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="faq-item">
                    <div class="faq-question">What can IT companies or software products do with TheyTrustUs?</div>
                    <div class="faq-answer">
                        Using TheyTrustUs, businesses can search for online services and software solutions, generating
                        potential web traffic for their websites. Clients and software companies, and products are
                        connected through TheyTrustUs. The possibility of showcasing their work to the right audience
                        can be taken advantage of when IT companies and products register with GoodFirms and leverage
                        this massive exposure to generate leads.
                    </div>
                </div>
                </div>
            </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('script')
@endsection
