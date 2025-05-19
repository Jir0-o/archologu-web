@extends('layouts.adminApp')

@section('title', 'AboutUs Setting || Heritage In Khulna')

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
                    <h5 class="mb-0">AboutUs Page Setting</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.siteSetting.updateAboutUs') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    
                                    <!-- Text Section -->
                                    <h5 class="mb-3">Text Section</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="hero_title" class="form-label">AboutUs Hero Title:</label>
                                            <input type="text" class="form-control" id="hero_title" name="hero_title" placeholder="Add AboutUs Hero Title" value="{{ $aboutUs->hero_title ?? '' }}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="hero_text">AboutUs Hero Text: </label>
                                            <textarea class="form-control" id="hero_text" name="hero_text">{!! $aboutUs->hero_text ?? '' !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="our_history">AboutUs Our History: </label>
                                            <textarea class="form-control" id="our_history" name="our_history">{!! $aboutUs->our_history ?? '' !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="mission_vision">Mission & Vision Text: </label>
                                            <textarea class="form-control" id="mission_vision" name="mission_vision">{!! $aboutUs->mission_vision ?? '' !!}</textarea>
                                        </div>
                                    </div>

                                    <!-- Image Uploads -->
                                    <h5 class="mt-4 mb-3">AboutUs Image</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="hero_image1" class="form-label">AboutUs Hero Image1:</label>
                                            @if(isset($aboutUs) && $aboutUs->hero_image1)
                                                <div>
                                                    <img src="{{ asset('storage/' . $aboutUs->hero_image1) }}" alt="Current AboutUs Hero Image1" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="hero_image1" id="hero_image1">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="hero_image2" class="form-label">AboutUs Hero Image2</label>
                                            @if(isset($aboutUs) && $aboutUs->hero_image2)
                                                <div>
                                                    <img src="{{ asset('storage/' . $aboutUs->hero_image2) }}" alt="Current AboutUs Hero Image2" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="hero_image2" id="hero_image2">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dg_name" class="form-label">DG Name:</label>
                                            <input type="text" class="form-control" id="dg_name" name="dg_name" placeholder="Update DG Name" value="{{ $aboutUs->dg_name ?? '' }}"/>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dg_image" class="form-label">DG Photo</label>
                                            @if(isset($aboutUs) && $aboutUs->dg_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $aboutUs->dg_image) }}" alt="Current DG Photo" class="img-thumbnail mb-2" width="150">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="dg_image" id="dg_image">
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