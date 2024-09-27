
<section>
    </head>
    <body>
        <section class="container-fluid footer">
        <div class="container ">
            <div class="row">
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Company</h2>
                        <ul>
                            <li>Why They Trust Us</li>
                            <li>News & Press</li>
                            <li>Blog</li>
                            <li>Careers</li>
                           
                        </ul>
                    </div>
                
                    
    
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Customers</h2>
                        <ul>
                            <li>Browse Providers</li>
                            <li>Browse Projects</li>
                            <li>Browse Bundles</li>
                            <li>Leave Review</li>
                           
                        </ul>
                    </div>
                   
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Companies</h2>
                        <ul>
                            <li>Get Listed</li>
                            <li>Sponsorships</li>
                            <li>Pricing</li>
                            <li>Download TTU Badge</li>
                           
                        </ul>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <div class="footer-box">
                        <h2>Support</h2>
                        <ul>
                            <li>Contact Us </li>
                            <li>Chat support</li>
                            <li>Privacy</li>
                            <li>Terms of Service</li>
                           <li>Site Map</li>
                        </ul>
                    </div>
                  
                </div>
                <div class="col-md-4">
                    <img src="https://theytrust-us.developmentserver.info/front_components/images/theylogo.png" alt="" class="img-fluid">
                    <p>  © 2024 They Trust Us, All Rights Reserved.</p>
                  
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
