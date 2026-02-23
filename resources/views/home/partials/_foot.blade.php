
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
                            <li>
    <a href="https://theytrust.us/blog/" style="color:inherit;text-decoration:none;">
        Blog
    </a>
</li>
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
                            @auth
                                <li><a href="{{ route('company.getPriceListing') }}" style="color:inherit;text-decoration:none;">Sponsorships</a></li>
                                <li><a href="{{ route('plans') }}" style="color:inherit;text-decoration:none;">Pricing</a></li>
                            @else
                                <li><a href="#" style="color:inherit;text-decoration:none;" data-toggle="modal" data-target="#login-modal">Sponsorships</a></li>
                                <li><a href="#" style="color:inherit;text-decoration:none;" data-toggle="modal" data-target="#login-modal">Pricing</a></li>
                            @endauth

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
        $(document).ready(function() {
            // Check if showModal is set in session
            @if (session('showModal') == 'signup')
                $('#signup-modal').modal('show');
            @elseif (session('showModal') == 'login')
                $('#login-modal').modal('show');
            @endif
        });
    </script>

{{-- </html> --}}
