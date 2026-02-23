@extends('layouts.home-master')

@section('meta')
    @php
        $meta_title = 'Contact Us - Get in Touch | They Trust Us';
        $meta_description = 'Have questions or need help? Contact They Trust Us. Our team is here to assist with inquiries about listings, reviews, partnerships, and platform support.';
    @endphp
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/contact') }}">
@endsection

@push('styles')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #0d2137 0%, #1a3a5c 100%);
        padding: 60px 0;
        color: #fff;
        text-align: center;
    }
    .contact-hero h1 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .contact-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
        max-width: 550px;
        margin: 0 auto;
    }
    .contact-content {
        padding: 50px 0 80px;
        font-family: 'Inter', sans-serif;
    }
    .info-card {
        background: #f8fbff;
        border: 1px solid #e2ecf5;
        border-radius: 12px;
        padding: 28px 24px;
        text-align: center;
        height: 100%;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .info-card:hover {
        box-shadow: 0 5px 20px rgba(13, 33, 55, 0.08);
        transform: translateY(-3px);
    }
    .info-card .info-icon {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, #2cc8dd 0%, #1a9bb0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    .info-card .info-icon i {
        font-size: 1.3rem;
        color: #fff;
    }
    .info-card h5 {
        font-weight: 700;
        color: #0d2137;
        font-size: 1.05rem;
        margin-bottom: 8px;
    }
    .info-card p {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 0;
        line-height: 1.6;
    }
    .info-card a {
        color: #2cc8dd;
        text-decoration: none;
    }
    .info-card a:hover {
        text-decoration: underline;
    }
    .contact-form-card {
        background: #fff;
        border: 1px solid #e2ecf5;
        border-radius: 14px;
        padding: 35px;
        box-shadow: 0 3px 18px rgba(13, 33, 55, 0.06);
    }
    .contact-form-card h3 {
        font-family: 'Epilogue', sans-serif;
        font-weight: 700;
        color: #0d2137;
        font-size: 1.4rem;
        margin-bottom: 5px;
    }
    .contact-form-card .form-subtitle {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 25px;
    }
    .contact-form-card .form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 5px;
    }
    .contact-form-card .form-control {
        border: 1px solid #d5deee;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.93rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .contact-form-card .form-control:focus {
        border-color: #2cc8dd;
        box-shadow: 0 0 0 3px rgba(44, 200, 221, 0.12);
    }
    .contact-form-card textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .help-option-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }
    .help-option-group .help-option {
        flex: 0 0 auto;
    }
    .help-option-group input[type="radio"] {
        display: none;
    }
    .help-option-group label.option-label {
        display: inline-block;
        padding: 8px 18px;
        border: 1px solid #d5deee;
        border-radius: 25px;
        font-size: 0.85rem;
        color: #555;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
        margin: 0;
    }
    .help-option-group input[type="radio"]:checked + label.option-label {
        background: #2cc8dd;
        color: #fff;
        border-color: #2cc8dd;
    }
    .help-option-group label.option-label:hover {
        border-color: #2cc8dd;
        color: #2cc8dd;
    }
    .btn-submit {
        background: linear-gradient(135deg, #2cc8dd 0%, #1a9bb0 100%);
        color: #fff;
        border: none;
        padding: 12px 35px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
        width: 100%;
    }
    .btn-submit:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    .btn-submit:active {
        transform: translateY(0);
    }
    .contact-sidebar {
        height: 100%;
    }
    .sidebar-card {
        background: linear-gradient(135deg, #f0fdff 0%, #e8f8fb 100%);
        border: 1px solid #d4f0f5;
        border-radius: 12px;
        padding: 28px;
        margin-bottom: 20px;
    }
    .sidebar-card h5 {
        font-weight: 700;
        color: #0d2137;
        font-size: 1rem;
        margin-bottom: 12px;
    }
    .sidebar-card p {
        color: #555;
        font-size: 0.88rem;
        line-height: 1.7;
        margin-bottom: 0;
    }
    .sidebar-card ul {
        padding-left: 18px;
        margin: 0;
    }
    .sidebar-card ul li {
        color: #555;
        font-size: 0.88rem;
        margin-bottom: 5px;
    }
    .sidebar-card ul li::marker {
        color: #2cc8dd;
    }
    .alert-success-custom {
        background: #eafcff;
        border: 1px solid #b8eef7;
        color: #0d6f7e;
        border-radius: 8px;
        padding: 14px 18px;
        font-size: 0.93rem;
    }
    .alert-danger-custom {
        background: #fff5f5;
        border: 1px solid #fcc;
        color: #c0392b;
        border-radius: 8px;
        padding: 14px 18px;
        font-size: 0.93rem;
    }
    @media (max-width: 768px) {
        .contact-form-card {
            padding: 25px 20px;
        }
    }
</style>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have a question or need help? Our team is here to assist you. We'd love to hear from you.</p>
        </div>
    </section>

    {{-- Info Cards --}}
    <section class="contact-content">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <h5>Email Us</h5>
                        <p><a href="mailto:support@theytrust.us">support@theytrust.us</a></p>
                        <p class="mt-1" style="font-size:0.82rem; color:#888;">We respond within 24 hours</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Our Location</h5>
                        <p>United States</p>
                        <p class="mt-1" style="font-size:0.82rem; color:#888;">Serving clients worldwide</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-clock"></i></div>
                        <h5>Business Hours</h5>
                        <p>Monday - Friday</p>
                        <p class="mt-1" style="font-size:0.82rem; color:#888;">9:00 AM - 6:00 PM (EST)</p>
                    </div>
                </div>
            </div>

            {{-- Form + Sidebar --}}
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="contact-form-card">
                        <h3>Send Us a Message</h3>
                        <p class="form-subtitle">Fill out the form below and we'll get back to you as soon as possible.</p>

                        @if (Session::get('success'))
                            <div class="alert-success-custom mb-3">
                                <i class="fas fa-check-circle mr-2"></i>{{ Session::get('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert-danger-custom mb-2">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ url('sendContactEmail') }}">
                            @csrf

                            {{-- Help Options --}}
                            <div class="form-group">
                                <label>I am a:</label>
                                <div class="help-option-group">
                                    <div class="help-option">
                                        <input type="radio" name="help_options" id="opt1" value="Services buyer" checked>
                                        <label class="option-label" for="opt1">Services Buyer</label>
                                    </div>
                                    <div class="help-option">
                                        <input type="radio" name="help_options" id="opt2" value="Services Reviewer">
                                        <label class="option-label" for="opt2">Services Reviewer</label>
                                    </div>
                                    <div class="help-option">
                                        <input type="radio" name="help_options" id="opt3" value="Provider with a TheyTrustUs profile">
                                        <label class="option-label" for="opt3">Listed Provider</label>
                                    </div>
                                    <div class="help-option">
                                        <input type="radio" name="help_options" id="opt4" value="Establishing a TheyTrustUs Profile as a Service Provider">
                                        <label class="option-label" for="opt4">New Provider</label>
                                    </div>
                                    <div class="help-option">
                                        <input type="radio" name="help_options" id="opt5" value="Other">
                                        <label class="option-label" for="opt5">Other</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name <span style="color:#e74c3c;">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="Enter your first name" value="{{ old('first_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name <span style="color:#e74c3c;">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Enter your last name" value="{{ old('last_name') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Email & Phone --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address <span style="color:#e74c3c;">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="you@company.com" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number <span style="color:#e74c3c;">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+1 (555) 123-4567" value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Message --}}
                            <div class="form-group">
                                <label for="message">Your Message <span style="color:#e74c3c;">*</span></label>
                                <textarea class="form-control" id="message" name="message" required placeholder="Tell us how we can help you..." rows="5">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit mt-2">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 mb-4">
                    <div class="contact-sidebar">
                        <div class="sidebar-card">
                            <h5><i class="fas fa-question-circle mr-2" style="color:#2cc8dd;"></i>Common Questions</h5>
                            <p>Before reaching out, check if your question is already answered in our FAQ section.</p>
                            <a href="{{ route('faq') }}" class="d-inline-block mt-2" style="color:#2cc8dd; font-weight:600; text-decoration:none; font-size:0.9rem;">
                                Visit FAQ <i class="fas fa-arrow-right ml-1" style="font-size:0.8rem;"></i>
                            </a>
                        </div>

                        <div class="sidebar-card">
                            <h5><i class="fas fa-building mr-2" style="color:#2cc8dd;"></i>List Your Company</h5>
                            <p>Want to get your service company listed on They Trust Us? It's free and takes less than 20 minutes.</p>
                            <a href="{{ url('/add-company') }}" class="d-inline-block mt-2" style="color:#2cc8dd; font-weight:600; text-decoration:none; font-size:0.9rem;">
                                Get Listed <i class="fas fa-arrow-right ml-1" style="font-size:0.8rem;"></i>
                            </a>
                        </div>

                        <div class="sidebar-card">
                            <h5><i class="fas fa-headset mr-2" style="color:#2cc8dd;"></i>Need Quick Help?</h5>
                            <ul>
                                <li><strong>General:</strong> <a href="mailto:support@theytrust.us" style="color:#2cc8dd;">support@theytrust.us</a></li>
                                <li><strong>Reviews:</strong> <a href="mailto:reviews@theytrust.us" style="color:#2cc8dd;">reviews@theytrust.us</a></li>
                                <li><strong>Partnerships:</strong> <a href="mailto:partners@theytrust.us" style="color:#2cc8dd;">partners@theytrust.us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')

@endsection
