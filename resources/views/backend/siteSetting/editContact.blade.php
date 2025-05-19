@extends('layouts.adminApp')

@section('title', 'Contact Setting || Heritage In Khulna')

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
                    <h5 class="mb-0">Contact Page Setting</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.siteSetting.updateContact') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    
                                    <!-- Text Section -->
                                    <h5 class="mb-3">Text Section</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="hero_title" class="form-label">Office Time:</label>
                                            <input type="text" class="form-control" id="office_time" name="office_time" placeholder="Update Office Time" value="{{ $contact->office_time ?? '' }}"/>
                                        </div>
                        
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Office Google Map URL (Embed iframe URL): </label>
                                            <input type="text" class="form-control" id="office_location_url" name="office_location_url" placeholder="Paste Office Google Map URL here" value="{{ $contact->office_location_url ?? '' }}">
                                        </div>
                                    </div>

                                    <!-- Image Uploads -->
                                    <h5 class="mt-4 mb-3">Contact Image</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="contact_image" class="form-label">Contact Hero Image:</label>
                                    
                                            <div id="currentContactImage" class="mb-2">
                                                <img
                                                    src="{{ isset($contact) && $contact->contact_image ? asset('storage/' . $contact->contact_image) : asset('storage/default.jpg') }}"
                                                    alt="Current Contact Hero Image"
                                                    class="img-thumbnail"
                                                    width="150"
                                                >
                                            </div>
                                    
                                            {{-- New image preview --}}
                                            <div id="newContactImagePreview" class="mb-2" style="display: none;">
                                                <img id="contactPreviewImg" src="#" class="img-thumbnail" width="150">
                                            </div>
                                    
                                            <input type="file" class="form-control" name="contact_image" id="contact_image">

                                            @error('contact_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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

<script>
    $(document).ready(function () {
        $('#contact_image').on('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    $('#contactPreviewImg').attr('src', e.target.result);
                    $('#newContactImagePreview').show();
                    $('#currentContactImage').hide(); 
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>


@endsection