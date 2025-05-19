<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top top-bg d-none d-lg-block">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-8">
                            <div class="header-info-left">
                                <ul>
                                    <li>{{$siteSetting->email}}</li>
                                    <li>{{$siteSetting->phone}}</li>
                                    <li>{{$siteSetting->address}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="header-info-right f-right">
                                <ul class="header-social">
                                    <li>
                                        @if($siteSetting->twitter_link)
                                            <a href="{{ $siteSetting->twitter_link }}" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        @if($siteSetting->linkedin_link)
                                            <a href="{{ $siteSetting->linkedin_link }}" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        @if($siteSetting->facebook_link)
                                            <a href="{{ $siteSetting->facebook_link }}" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="{{ route('index') }}">
                                    <img class="max-w-100 h-[65px]" src="{{ asset('storage/' . $siteSetting->logo_image) }}" alt="Logo" loading="lazy">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li>
                                            <a href="{{ route('index') }}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.about') }}">About US</a>
                                        </li> 
                                        <li>
                                            <a href="{{ route('frontend.ancient.place') }}">Ancient place</a>
                                            <ul class="submenu">
                                                <li>
                                                    <a href="{{ route('frontend.ancient.preserved') }}">In Well Preserved</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('frontend.ancient.vulnerable') }}">In Vulnerable Condition</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('frontend.ancient.critical') }}">In Critical Condition</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.contact.search') }}">My Uploads</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.contact') }}">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Login Button -->
                        <div class="col-xl-2 col-lg-2 col-md-3 text-right">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                            @endguest
                            @auth
                                <a href="{{ route('backend.home.adminDashboard') }}" class="btn btn-sm btn-success">Dashboard</a>
                            @endauth
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

