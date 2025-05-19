@extends('layouts.app')

@section('title', 'Home || Heritage In Khulna')

@section('external_css')

@endsection


<style>
.search-box .search-btn {
    background-color: #ff6347;
    color: white;
    font-size: 16px;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Fix: Remove duplicate dropdown styling */
#thanaSelected {
    appearance: none; /* Removes default styling */
    -webkit-appearance: none;
    -moz-appearance: none;
    background: none; /* Removes unnecessary background */
    display: block !important;
    opacity: 1 !important;
}

/* Fix: Ensure pseudo-elements do not interfere */
#thanaSelected::before,
#thanaSelected::after {
    display: none !important; 
    content: none !important;
}

/* Fix: Adjust height and spacing */
.input-group select {
    height: 40px !important;
    padding-right: 10px !important; /* Ensures space for dropdown arrow */
}

/* Fix: Ensure Bootstrap consistency */
.input-group {
    position: relative;
}

.input-group select.form-control {
    position: relative;
    z-index: 2;
}

/* Fix: Prevent extra dropdown icon */
.input-group:after {
    display: none !important;
}

/* search dropdown */
.search-dropdown {
    position: absolute;
    width: 73%;
    background: white;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 150px;
    overflow-y: auto;
    display: none;
    z-index: 10;
}

.search-dropdown .search-item {
    padding: 8px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

.search-dropdown .search-item:hover {
    background: #f1f1f1;
}
</style>

@section('content')

<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="slider-active">  
        <div class="single-slider hero-overly slider-height d-flex align-items-center" style="background-image: url('{{ asset('storage/' . $siteSetting->hero_image) }}');">
            <div class="container">
                <div class="row"> 
                    <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="hero__caption">
                            <h1>{{$siteSetting->hero_text1}} <span>{{$siteSetting->hero_text2}}</span> </h1>
                            <p>{{$siteSetting->hero_text3}}</p>
                        </div>
                    </div>
                </div>
                <!-- Search Box -->
                <div class="row" id="searchContainer">
                    <div class="col-xl-12">
                        <form id="searchForm" action="{{ route('frontend.search.sites') }}" method="get" class="search-box">
                            <div class="input-form mb-30 w-[80%]">
                                <input type="text" id="searchInput" name="query" placeholder="When would you like to go?" autocomplete="off">
                                <ul id="searchDropdown" class="search-dropdown"></ul>
                            </div>
                            <div class="search-form mb-30">
                                <button type="submit" class="search-btn">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- Nano Search Form -->
<section class="nano-search-section container pt-5">
    <form id="searchForm" action="{{ route('frontend.search.sites') }}" method="get">
        <fieldset class="fieldset bg-base-200 border border-base-300 p-4 rounded">
            <legend class="fieldset-legend px-3 font-bold">
                <i>FIND YOUR PLACE</i>
            </legend>

            <div class="row g-3">
                <!-- Zilla (District) Dropdown -->
                <div class="col-md-4 col-sm-6">
                    <label for="zillaSelected" class="form-label">Select Zilla</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                        <select name="zilla_id" id="zillaSelected" class="form-control">
                            <option disabled selected>Select Zilla</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ request('zilla_id') == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Thana (Sub-district) Dropdown -->
                <div class="col-md-4 col-sm-6">
                    <label for="thanaSelected" class="form-label">Select Thana</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-university"></i></span>
                        <select name="thana_id" id="thanaSelected" class="form-control">
                            <option disabled selected>Select Thana</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="col-md-4 col-sm-12">
                    <button type="submit" class="btn btn-danger w-100">Search</button>
                </div>

                <br>
                <!-- Text Search Input -->
                <div class="col-12">
                    <label for="queryInput" class="form-label">Search Place</label>
                    <input type="text" name="query" id="queryInput" placeholder="Write your place name"
                        value="{{ request('query') }}"
                        class="form-control">
                </div>
            </div>
        </fieldset>
    </form>
</section>


<!-- nano search form end -->

<!-- Our Services Start -->
<div class="our-services pt-[170px]">
    <div class="container">
        <div class="row d-flex justify-contnet-center">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="text-[36px] text-[#014b85]">
                        {{$count}}
                    </div>
                    <div class="services-cap">
                        <h5>Total Heritage Sites</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="text-[36px] text-[#014b85]">
                        {{$criticalCount}}
                    </div>
                    <div class="services-cap">
                        <h5>In Critical Condition</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="text-[36px] text-[#014b85]">
                        {{$vulnerableCount}}
                    </div>
                    <div class="services-cap">
                        <h5>In Vulnerable Condition</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="text-[36px] text-[#014b85]">
                        {{$wellCount}}
                    </div>
                    <div class="services-cap">
                        <h5>In Well Preserved</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="text-[36px] text-[#014b85]">
                        {{$unknownCount}}
                    </div>
                    <div class="services-cap">
                        <h5>Unknown</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Services End -->
<!-- Favourite Places Start -->
<div class="favourite-place place-padding">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>FEATURED PLACES</span>
                    <h2>Top Places You Must Visit</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($sites as $site)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img class="w-100 aspect-square object-cover"
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
                            <h3>
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
            {{ $sites->links() }}
        </div>
    </div>
</div>
<!-- Favourite Places End -->
<!-- Video Start Arera -->
<div class="video-area video-bg pt-200 pb-200"
    style="background-image: url('{{ asset('storage/' . $siteSetting->hero_image2) }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="video-caption text-center">
                    <div class="video-icon">
                        <a class="popup-video" href="{{$siteSetting->youtube_video_link}}" target="blank" tabindex="0">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    <p class="pera1">{{$siteSetting->youtube_text1}}</p>
                    <p class="pera2">{{$siteSetting->youtube_text2}}</p>
                    <p class="pera3">{{$siteSetting->youtube_text3}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Start End -->
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
                        <h2>One of the government agency In Bangladesh</h2>
                    </div>
                    <div class="support-caption">
                        <p class="text-justify">
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
                        <a href="{{ route('frontend.about') }}" class="btn border-btn">About us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Support Company End-->
<!-- Testimonial Start -->
{{-- <div class="testimonial-area testimonial-padding"
    data-background="{{ asset('frontend_assets/img/testmonial/testimonial_bg.jpg') }}">
    <div class="container ">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-11 col-lg-11 col-md-9">
                <div class="h1-testimonial-active">
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                        <!-- Testimonial Content -->
                        <div class="testimonial-caption ">
                            <div class="testimonial-top-cap">
                                <img src="{{ asset('frontend_assets/img/icon/testimonial.png') }}" alt="Testimonial">
                                <p>
                                    Logisti Group is a representative logistics operator providing full range of ser
                                    of customs clearance and transportation worl.
                                </p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                <div class="founder-img">
                                    <img src="{{ asset('frontend_assets/img/testmonial/Homepage_testi.png') }}"
                                        alt="Testimonial">
                                </div>
                                <div class="founder-text">
                                    <span>Jessya Inn</span>
                                    <p>Co Founder</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                        <!-- Testimonial Content -->
                        <div class="testimonial-caption ">
                            <div class="testimonial-top-cap">
                                <img src="{{ asset('frontend_assets/img/icon/testimonial.png') }}" alt="testimonial">
                                <p>
                                    Logisti Group is a representative logistics operator providing full range of ser
                                    of customs clearance and transportation worl.
                                </p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                <div class="founder-img">
                                    <img src="{{ asset('frontend_assets/img/testmonial/Homepage_testi.png') }}"
                                        alt="Homepage">
                                </div>
                                <div class="founder-text">
                                    <span>Jessya Inn</span>
                                    <p>Co Founder</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Testimonial End -->

@endsection

@section('external_js')

<script>
$(document).ready(function() {
    $('#thanaSelected').next('.nice-select').remove();
    $('#thanaSelected').show(); 

    let searchHistory = JSON.parse(localStorage.getItem('searchHistory')) || [];

    function showSearchDropdown() {
        let dropdown = $('#searchDropdown');
        dropdown.empty(); 
        
        if (searchHistory.length > 0) {
            searchHistory.forEach(query => {
                dropdown.append(`<li class="search-item">${query}</li>`);
            });
            dropdown.show();
        }
    }

    $('#searchInput').on('focus', function() {
        showSearchDropdown();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchContainer').length) {
            $('#searchDropdown').hide();
        }
    });

    $(document).on('click', '.search-item', function() {
        $('#searchInput').val($(this).text());
        $('#searchDropdown').hide();
    });

    $('#searchForm').on('submit', function(e) {
        let query = $('#searchInput').val().trim();
        if (query && !searchHistory.includes(query)) {
            searchHistory.unshift(query); 
            if (searchHistory.length > 5) searchHistory.pop(); 
            localStorage.setItem('searchHistory', JSON.stringify(searchHistory));
        }
    });

    $('#zillaSelected').on('change', function() {
        let zillaId = $(this).val();
        
        $('#thanaSelected').html('<option>Loading...</option>');
        

        if (zillaId) {
            $.ajax({
                url: "{{ route('frontend.get.thanas') }}",
                type: 'GET',
                data: { 
                    zilla_id: zillaId,
                    _token: "{{ csrf_token() }}" 
                },
                dataType: "json",
                success: function(response) {
                    $('#thanaSelected').empty();
                    $('#thanaSelected').append('<option disabled selected>Select Thana</option>');

                    if (Array.isArray(response) && response.length > 0) {
                        // Populate Thana dropdown
                        response.forEach(function(thana) {
                            $('#thanaSelected').append(
                                `<option value="${thana.id}">${thana.name}</option>`
                            );
                        });
                    } else {
                        $('#thanaSelected').append('<option>No Thana Found</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText); // Debugging
                    alert('Failed to fetch Thanas. Please try again.');
                }
            });
        } else {
        }
    });
});
</script>

@endsection