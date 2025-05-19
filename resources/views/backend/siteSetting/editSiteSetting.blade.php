@extends('layouts.adminApp')

@section('title', 'Site Setting || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Site Setting</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.siteSetting.updateSiteSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    
                                    <!-- Contact Section -->
                                    <h5 class="mb-3">Contact Section</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{$siteSetting->email}}"/>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{$siteSetting->phone}}"/>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{$siteSetting->address}}"/>
                                        </div>
                                    </div>
                    
                                    <!-- Hero Text Section -->
                                    <h5 class="mt-4 mb-3">Hero Text Section</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="site_hero1" class="form-label">Hero Text 1</label>
                                            <input type="text" class="form-control" id="site_hero1" name="site_hero1" placeholder="Add Hero Text Here" value="{{$siteSetting->hero_text1}}"/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="site_hero2" class="form-label">Hero Text 2</label>
                                            <input type="text" class="form-control" id="site_hero2" name="site_hero2" placeholder="Add Hero Text Here" value="{{$siteSetting->hero_text2}}"/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="site_hero3" class="form-label">Hero Text 3</label>
                                            <input type="text" class="form-control" id="site_hero3" name="site_hero3" placeholder="Add Hero Text Here" value="{{$siteSetting->hero_text3}}"/>
                                        </div>
                                    </div>

                                    <!-- Footer Text -->
                                    <h5 class="mt-4 mb-3">Footer Text</h5>
                                    <div class="col-md-12 mb-3">
                                        <label for="footer_text" class="form-label">Footer Text</label>
                                        <input type="text" class="form-control" id="footer_text" name="footer_text" placeholder="Add Footer Text Here" value="{{$siteSetting->footer_text}}"/>
                                    </div>
                    
                                    <!-- Logo & Hero Image Uploads -->
                                    <h5 class="mt-4 mb-3">Logo & Hero Image</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="hero" class="form-label">Site Hero Image</label>
                                            @if($siteSetting->hero_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $siteSetting->hero_image) }}" alt="Current Hero Image" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="hero" id="hero">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="hero2" class="form-label">Site Hero Image2</label>
                                            @if($siteSetting->hero_image2)
                                                <div>
                                                    <img src="{{ asset('storage/' . $siteSetting->hero_image2) }}" alt="Current Hero Image2" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="hero2" id="hero2">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="logo" class="form-label">Site Logo Image</label>
                                            @if($siteSetting->logo_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $siteSetting->logo_image) }}" alt="Current Logo Image" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="logo" id="logo">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="logo2" class="form-label">Preloader Image</label>
                                            @if($siteSetting->preloader_img)
                                                <div>
                                                    <img src="{{ asset('storage/' . $siteSetting->preloader_img) }}" alt="Current Preloader Image" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="logo2" id="logo2">
                                        </div>
                                    </div>
                    
                                    <!-- Social Media Links -->
                                    <h5 class="mt-4 mb-3">Social Media Links</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="twitter_url" class="form-label">Twitter URL</label>
                                            <input type="url" class="form-control" id="twitter_url" name="twitter_url" placeholder="Paste Twitter URL here" value="{{$siteSetting->twitter_link}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" placeholder="Paste LinkedIn URL here" value="{{$siteSetting->linkedin_link}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="fb_url" class="form-label">Facebook URL</label>
                                            <input type="url" class="form-control" id="fb_url" name="fb_url" placeholder="Paste Facebook URL here" value="{{$siteSetting->facebook_link}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="website_url" class="form-label">Website URL</label>
                                            <input type="url" class="form-control" id="website_url" name="website_url" placeholder="Paste Website URL here" value="{{$siteSetting->website_url}}">
                                        </div>
                                    </div>
                    
                                    <!-- Submit Button -->
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                    </div>
                    
                                </div>
                            </div>
                     
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->


@endsection

@section('external_js')


    <!-- Display Toastify Notifications -->
@if(session('success'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{ session('success') }}",
                duration: 2000,
                gravity: "top", // top, bottom
                position: "right", // left, center, right
                backgroundColor: "green",
            }).showToast();
        });
    </script>
@endif

@if(session('error'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{ session('error') }}",
                duration: 2000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
        });
    </script>
@endif

@endsection