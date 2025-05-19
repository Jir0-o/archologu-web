@extends('layouts.adminApp')

@section('title', 'Site Gallery || Heritage In Khulna')

@section('external_css')

<style>
    .gallery-media {
        width: 100%;  /* Ensures responsiveness */
        height: 200px; /* Set a fixed height */
        object-fit: cover; /* Crops the image/video to fit */
        border-radius: 8px; /* Optional: Adds rounded corners */
    }
</style>

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <a href="{{ route('backend.gallery.create') }}" class="btn btn-primary"> Enrich Site Gallery</a>

    <div class="row mb-3 mt-3">
        <label class="col-sm-2 col-form-label" for="site-select">Select Site</label>
        <div class="col-sm-10">
            <select name="site_id" id="site-select" class="form-select" required>
                <option value="">Select Site</option>
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->site_name_en }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div id="gallery"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#site-select').change(function () {
            var siteId = $(this).val();
            if (siteId) {
                $.ajax({
                    url: "{{ route('backend.gallery.getBySite') }}",
                    type: "GET",
                    data: { site_id: siteId },
                    dataType: "json",
                    success: function (response) {
                        var galleryHtml = "";

                        if (response.length > 0) {
                            galleryHtml += `<div class="row">`;
                            $.each(response, function (index, media) {
                                if (media.file_type === "image") {
                                    galleryHtml += `
                                        <div class="gallery-media col-md-3">
                                            <img src="{{ asset('') }}${media.file_path}" class="img-fluid mb-3" alt="Gallery Image">
                                        </div>`;
                                } else if (media.file_type === "video") {
                                    galleryHtml += `
                                        <div class="gallery-media col-md-3">
                                            <video width="100%" controls>
                                                <source src="{{ asset('') }}${media.file_path}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>`;
                                }
                            });
                            galleryHtml += `</div>`;
                        } else {
                            galleryHtml = "<p class='text-danger'>No media available for this site.</p>";
                        }

                        $('#gallery').html(galleryHtml);
                    }
                });
            } else {
                $('#gallery').html('');
            }
        });
    });
</script>



@endsection

@section('external_js')

@endsection