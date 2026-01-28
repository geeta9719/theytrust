
<section>
    {{-- </head> --}}
    <body>
        <section class="container-fluid footer">
        <div class="container ">
            <div class="row">
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Company</h2>
                        <ul>
                            <li><a href="{{ route('about') }}" style="color:inherit;text-decoration:none;">About Us</a></li>
                            <li><a href="{{ route('blogs.list') }}" style="color:inherit;text-decoration:none;">Blog</a></li>
                            <li><a href="{{ route('faq') }}" style="color:inherit;text-decoration:none;">FAQ</a></li>
                            <li><a href="contact" style="color:inherit;text-decoration:none;">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Customers</h2>
                        <ul>
                            <li><a href="{{ url('/providers/category') }}" style="color:inherit;text-decoration:none;">Browse Providers</a></li>
                            <li><a href="{{ route('listing.global') }}" style="color:inherit;text-decoration:none;">Browse Companies</a></li>
                            <li><a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Search</a></li>
                            <li><a href="{{ route('company.review', ['company' => 'reviews']) }}" style="color:inherit;text-decoration:none;">Leave Review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Companies</h2>
                        <ul>
                            <li><a href="{{ route('get-listed') }}" style="color:inherit;text-decoration:none;">Get Listed</a></li>
                            <li><a href="{{ route('company.getPriceListing') }}" style="color:inherit;text-decoration:none;">Sponsorships</a></li>
                            <li><a href="{{ route('plans') }}" style="color:inherit;text-decoration:none;">Pricing</a></li>
                            <li><a href="{{ route('plans.compare') }}" style="color:inherit;text-decoration:none;">Compare Plans</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Support</h2>
                        <ul>
                            <li><a href="contact" style="color:inherit;text-decoration:none;">Contact Us</a></li>
                            <li><a href="{{ route('faq') }}" style="color:inherit;text-decoration:none;">Help Center</a></li>
                            <li><a href="{{ route('privacy-policy') }}" style="color:inherit;text-decoration:none;">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-of-use') }}" style="color:inherit;text-decoration:none;">Terms of Service</a></li>
                            <li><a href="sitemap" style="color:inherit;text-decoration:none;">Site Map</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://theytrust-us.developmentserver.info/front_components/images/theylogo.png" alt="" class="img-fluid">
                    <p>  © 2025 They Trust Us, All Rights Reserved.</p>

                </div>
            </div>
        </div>
    </section>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signUpModal = new bootstrap.Modal(document.getElementById('singin-modal'));
            const loginModal = new bootstrap.Modal(document.getElementById('login-modal'));

            // Show Log In modal on Sign Up modal "Log In" button click
            document.getElementById('login-link').addEventListener('click', function() {
                signUpModal.hide();
                loginModal.show();
            });

            // Check if showModal is set in session (Laravel blade example)
            @if (session('showModal') == 'signup')
                signUpModal.show();
            @elseif (session('showModal') == 'login')
                loginModal.show();
            @endif
        });
    </script>

{{-- </html> --}}
