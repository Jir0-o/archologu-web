@extends('layouts.app')

@section('title', 'Contact Us || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- slider Area Start-->

<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center"  style="background-image: url('{{ asset('storage/' . $contact->contact_image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>CONTACT US</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- slider Area End-->

<!-- contact form start -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="{{ route('frontend.contact.store') }}" method="POST" id="">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>{{$siteSetting->address}}</h3>
                        <p>Bangladesh</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>{{$siteSetting->phone}}</h3>
                        <p>{{$contact->office_time}}</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>{{$siteSetting->email}}</h3>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="arcient-location">
    <div class="mapouter">
        <div class="gmap_canvas">
            {{-- <iframe width="100%" height="500" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.495734883076!2d89.54925847406786!3d22.82114172381747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff9a8555555555%3A0x82cf5cf165921427!2sArcheological%20Museum!5e0!3m2!1sen!2sbd!4v1740941339115!5m2!1sen!2sbd" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> --}}
            <iframe width="100%" height="500" id="gmap_canvas" src="{{ $contact->office_location_url ?? 'https://www.embedgooglemap.net' }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            <a href="https://getasearch.com/fmovies"></a>
            <br>
            <style>
                .mapouter {
                    position: relative;
                    text-align: right;
                    height: 500px;
                    width: 100%;
                }
            </style>
            <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
            <style>
                .gmap_canvas {
                    overflow: hidden;
                    background: none !important;
                    height: 500px;
                    width: 100%;
                }
            </style>
        </div>
    </div>
</section>

<!-- contact form end -->

@endsection

@section('external_js')

@endsection