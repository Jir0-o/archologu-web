<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding footer-bg" data-background="{{ asset('frontend_assets/img/service/footer_bg.jpg') }}">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a href="{{ route('index') }}">
                                    <img class="w-[65px] h-[65px] bg-light rounded-full" src="{{ asset('storage/' . $siteSetting->logo_image) }}" alt="Logo" loading="lazy">
                                </a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>{{$siteSetting->footer_text}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Quick Links</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('frontend.about') }}">About</a>
                                </li> 
                                <li>
                                    <a href="{{ route('frontend.ancient.preserved') }}">Well Preserved</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.ancient.vulnerable') }}">Venerable Condition</a>
                                </li>
                                <li> 
                                    <a href="{{ route('frontend.ancient.critical') }}">Critical Condition</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Top Places</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('frontend.show.place', ['place_slug' => 'slug']) }}">Shat Gombuj</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.show.place', ['place_slug' => 'slug']) }}">Michael Madhusudan Dutta Memorial House</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.show.place', ['place_slug' => 'slug']) }}">Dive deep into the wild wonders of Sundarban.</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.show.place', ['place_slug' => 'slug']) }}">Fakir Lalon Shah's Mazaar, Kushtia</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Support</h4>
                            <ul>
                                <li>
                                    <a href="#">Career</a>
                                </li>
                                <li>
                                    <a href="#">Charter Of Duties</a>
                                </li>
                                <li>
                                    <a href="#">The Antiquities Act</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer bottom -->
            <div class="row pt-padding">
                <div class="col-md-9">
                    <div class="footer-copy-right">
                        <p>
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved || This Site is made with <i
                                class="fas fa-coffee"></i> by <a href="https://ussbd.com"
                                target="_blank">Unicorn Software & Solutions LTD</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- social -->
                    <div class="footer-social f-right">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fas fa-globe"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>
