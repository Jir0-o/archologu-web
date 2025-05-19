@extends('layouts.app')

@section('title', 'Home || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center"
    style="background-image: url('{{ asset('storage/' . $aboutUs->hero_image1)}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->
<!-- Support Company Start-->
<div class="support-company-area support-padding fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="support-location-img mb-50">
                    <img src="{{ asset('storage/' . $siteSetting->hero_image2) }}" alt="Support Image">
                    <div class="support-img-cap">
                        <span>Since 1983</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="right-caption">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2">
                        <span>About Our Directorate</span>
                        <h2>{{$aboutUs->hero_title}}</h2>
                    </div>
                    <div class="support-caption">
                        <p class="text-justify p-0">
                            {!! $aboutUs->hero_text !!}
                        </p>
                        <div class="select-suport-items">
                            <label class="single-items">Currently there are 17 museums
                                <input type="checkbox" checked="checked active" disabled>
                                <span class="checkmark"></span>
                            </label>
                            <label class="single-items">Every museums have history
                                <input type="checkbox" checked="checked active" disabled>
                                <span class="checkmark"></span>
                            </label>
                            <label class="single-items">The department works on to recover history
                                <input type="checkbox" checked="checked active" disabled>
                                <span class="checkmark"></span>
                            </label>
                            <label class="single-items">Repair and preserve the discovered
                                <input type="checkbox" checked="checked active" disabled>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        {{-- <a href="#" class="btn border-btn">About us</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Support Company End-->

<!-- our history start -->

<div class="our-history">
    <div class="container">
        <div class="row flex-col-reverse md:flex-row">
            <div class="col-md-7">
                <h2 class="mb-3">Our History</h2>
                <div class="history text-justify">
                    <p>
                        {!! $aboutUs->our_history !!}
                    </p>
            </div>
            <div class="col-md-5">
                <h2 class="mb-3">Honorable Director General</h2>
                <figure>
                    <img class="w-100 border-4 border-double"
                        {{-- src="https://archaeology.portal.gov.bd/sites/default/files/files/archaeology.portal.gov.bd/npfblock//2024-01-04-06-35-3f09e24b3e4900f7f28fdda5b786bb77.jpg" --}}
                        src="{{ asset('storage/' . $aboutUs->dg_image) }}"
                        alt="Director Image" loading="lazy">
                    <figcaption class="bg-[#091e31] text-center p-2 text-white">
                        <i>{{$aboutUs->dg_name}}</i>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="pt-5">
            <h2>Mission and Vision</h2>
            <p class="text-justify">
                {!! $aboutUs->mission_vision !!}
            </p>
        </div>
    </div>
</div>

<!-- our history end -->

@endsection

@section('external_js')

@endsection