@extends('layouts.app')

@section('title', 'Home || Heritage In Khulna')

@section('external_css')

<style>
    .grid-body-items {
        gap: 16px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
    }

    .grid-left .grid-item-1 { grid-area: 1 / 1 / 7 / 3; }
    .grid-left .grid-item-2 { grid-area: 1 / 3 / 7 / 4; }
    .grid-left .grid-item-3 { grid-area: 1 / 4 / 7 / 5; }
    .grid-left .grid-item-4 { grid-area: 7 / 1 / 13 / 2; }
    .grid-left .grid-item-5 { grid-area: 7 / 2 / 13 / 3; }
    .grid-left .grid-item-6 { grid-area: 7 / 3 / 13 / 5; }

    .grid-right .grid-item-1 { grid-area: 1 / 1 / 7 / 2; }
    .grid-right .grid-item-2 { grid-area: 1 / 2 / 7 / 3; }
    .grid-right .grid-item-3 { grid-area: 1 / 3 / 7 / 5; }
    .grid-right .grid-item-4 { grid-area: 7 / 1 / 13 / 3; }
    .grid-right .grid-item-5 { grid-area: 7 / 3 / 13 / 4; }
    .grid-right .grid-item-6 { grid-area: 7 / 4 / 13 / 5; }

    .place-heading {
        width: 100%;
        height: 68px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .grid-body-items {
            grid-template-columns: repeat(2, 1fr);
        }
    
        .grid-item-1 { grid-area: auto !important; }
        .grid-item-2 { grid-area: auto !important; }
        .grid-item-3 { grid-area: auto !important; }
        .grid-item-4 { grid-area: auto !important; }
        .grid-item-5 { grid-area: auto !important; }
        .grid-item-6 { grid-area: auto !important; }
    }

    @media (max-width: 767px) {
        .grid-body-items {
            display: block;
        }
    }
</style>

@endsection

@section('content')

<!-- slider Area Start-->
<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center"
        data-background="{{ asset('frontend_assets/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>All ANCIENT PLACES</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- all places start -->

<section class="favourite-place place-padding">
    <div class="container grid-left">
        <legend class="fieldset-legend w-auto px-3 font-bold">
            <i>TOP ANCIENT PLACES</i>
        </legend>
        <div class="grid-body-items">
            @foreach ($sites as $ind =>$site)
            <div class="grid-item grid-item-{{$ind + 1}}">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img class="w-100 h-[250px] object-cover"
                            src="{{ asset('storage/' . ($site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            <span>
                                <i class="fas fa-building"></i>
                                <span>
                                    @if ($site->siteDescription && $site->siteDescription->current_condition)
                                        @php
                                            $condition = $site->siteDescription->current_condition;
                                            $conditionText = 'Unknown';

                                            switch ($condition) {
                                                case 1:
                                                    $conditionText = 'Well Preserved';
                                                    break;
                                                case 2:
                                                    $conditionText = 'Vulnerable';
                                                    break;
                                                case 3:
                                                    $conditionText = 'Critical';
                                                    break;
                                            }
                                        @endphp
 
                                        {{ $conditionText }}
                                    @else
                                        Unknown
                                    @endif
                                </span>
                            </span>
                            <h3 class="place-heading">
                                <a href="{{ route('frontend.show.place', ['id' => $site->id]) }}">{{$site->site_name_en}} - {{$site->thana->name}}, {{$site->district->name}}</a>
                            </h3>
                            <p class="dolor">{{$site->district->name}}</p>
                        </div>
                        <div class="place-cap-bottom">
                            <p class="m-0">Historical Site</p>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            {{ $sites->withQueryString()->links() }}
        </div>
    </div>
</section>

<section class="favourite-place">
    <div class="container grid-right">
        <legend class="fieldset-legend text-end w-auto px-3 font-bold">
            <i>WELL PRESERVED PLACES</i>
        </legend>
        <div class="grid-body-items">
            @foreach ($well_preserved_sites as $ind => $w_site)
            <div class="grid-item grid-item-{{$ind+1}}">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img class="w-100 h-[250px] object-cover"
                            src="{{ asset('storage/' . ($w_site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            <span>
                                <i class="fas fa-building"></i>
                                <span>WELL PRESERVED</span>
                            </span>
                            <h3 class="place-heading">
                                <a href="{{ route('frontend.show.place', ['id' => $w_site->id]) }}">{{$w_site->site_name_en}} - {{$w_site->thana->name}}, {{$w_site->district->name}}</a>
                            </h3>
                            <p class="dolor">{{$w_site->district->name}}</p>
                        </div>
                        <div class="place-cap-bottom">
                            <p class="m-0">Historical Site</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            {{ $well_preserved_sites->withQueryString()->links() }}
        </div>
    </div>
</section>

<section class="favourite-place place-padding">
    <div class="container grid-left">
        <legend class="fieldset-legend w-auto px-3 font-bold">
            <i>IN CRITICAL CONDITION</i>
        </legend>
        <div class="grid-body-items">
            @foreach ($critical_sites as $ind => $c_site)
            <div class="grid-item grid-item-{{$ind+1}}">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img class="w-100 h-[250px] object-cover"
                            src="{{ asset('storage/' . ($c_site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            <span>
                                <i class="fas fa-building"></i>
                                <span>CRITICAL</span>
                            </span>
                            <h3 class="place-heading">
                                <a href="{{ route('frontend.show.place', ['id' => $c_site->id]) }}">{{$c_site->site_name_en}} - {{$c_site->thana->name}}, {{$c_site->district->name}}</a>
                            </h3>
                            <p class="dolor">{{$c_site->district->name}}</p>
                        </div>
                        <div class="place-cap-bottom">
                            <p class="m-0">Historical Site</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            {{ $critical_sites->withQueryString()->links() }}
        </div>
    </div>
</section>

<section class="favourite-place">
    <div class="container grid-right">
        <legend class="fieldset-legend text-end w-auto px-3 font-bold">
            <i>IN VUlNERABLE CONDITION</i>
        </legend>
        <div class="grid-body-items">
            @foreach ($vulnerable_sites as $ind => $v_site)
            <div class="grid-item grid-item-{{$ind + 1}}">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img class="w-100 h-[250px] object-cover"
                            src="{{ asset('storage/' . ($v_site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            <span>
                                <i class="fas fa-building"></i>
                                <span>VULNERABLE</span>
                            </span>
                            <h3 class="place-heading">
                                <a href="{{ route('frontend.show.place', ['id' => $v_site->id]) }}">{{$v_site->site_name_en}} - {{$v_site->thana->name}}, {{$v_site->district->name}}</a>
                            </h3>
                            <p class="dolor">{{$v_site->district->name}}</p>
                        </div>
                        <div class="place-cap-bottom">
                            <p class="m-0">Historical Site</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            {{ $vulnerable_sites->withQueryString()->links() }}
        </div>
    </div>
</section>

<!-- all places end -->

@endsection

@section('external_js')

@endsection