@extends('layouts.app')

@section('title', 'Home || Heritage In Khulna')

@section('external_css')

<style>
    .important-place img {
        width: 125px;
        height: 125px;
        object-fit: cover;
    }

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.9);
    text-align: center;
}

.modal-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 80vh;
}

.arrow {
    position: absolute;
    top: 50%;
    font-size: 3rem;
    color: white;
    cursor: pointer;
    padding: 0 15px;
    user-select: none;
}

.left {
    left: 10px;
}

.right {
    right: 10px;
}

.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 2rem;
    color: white;
    cursor: pointer;
}

.modal-title {
    color: white;
    margin-top: 10px;
    font-size: 1.2rem;
}


.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}



.nav-pills .nav-link {
    border: 1px solid #dee2e6;
    background-color: #77a5eb;
    margin-right: 5px;
    color:rgb(12, 12, 12);
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}
.nav-pills .nav-link.active {
    background-color: #0b5ed7;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 0 6px rgba(13, 110, 253, 0.5);
}
</style>

@endsection

@section('content')

    <!-- slider Area Start-->
    <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center"
            style="background-image: url('{{ asset('storage/' . $site->banner) }}'); background-size: cover; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $site->site_name_en }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset('storage/' . ($site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">
                        </div>
                        <div class="blog_details text-justify">
                            <h2>
                                {{ $site->site_name_en }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-map"></i> {{ $site->thana->name }}, {{ $site->district->name }}, Bangladesh
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-comments"></i> {{ $site->siteDescription->current_condition ?? 'Unknown' }}
                                    </a>
                                </li>
                            </ul>

                            <div class="col-md-13 mb-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-des-tab" data-bs-toggle="pill" data-bs-target="#pills-des" type="button" role="tab" aria-controls="pills-des" aria-selected="true">Site Description</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-main" type="button" role="tab" aria-controls="pills-main" aria-selected="false">Site Maintenance</button>
                                            </li>
                                        @if ($site->siteMaintenance && $site->siteMaintenance->publication != null|| $site->siteMaintenance && $site->siteMaintenance->publication_text != '<br>')
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-publication" type="button" role="tab" aria-controls="pills-publication" aria-selected="false">
                                                    Relevant Publication
                                                </button>
                                            </li>
                                        @endif
                                        @if ($site->siteMaintenance && $site->siteMaintenance->archives != null|| $site->siteMaintenance && $site->siteMaintenance->archive_text != '<br>')
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-archive" type="button" role="tab" aria-controls="pills-archive" aria-selected="false">
                                                Archive Documents
                                            </button>
                                        </li>
                                        @endif
                                        @if ($site->siteMaintenance && $site->siteMaintenance->documentory != null || $site->siteMaintenance && $site->siteMaintenance->documentory_text != '<br>')
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-documentory" type="button" role="tab" aria-controls="pills-documentory" aria-selected="false">
                                                Documentory Research work
                                            </button>
                                        </li>
                                        @endif
                                        </ul>
                            
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-des" role="tabpanel" aria-labelledby="pills-des-tab">
                                                @php
                                                    $fields = [
                                                        'Description' => $site->siteDescription->site_description,
                                                        'Integrity' => $site->siteDescription->integrity,
                                                        'Value' => $site->siteDescription->value,
                                                        'Priorities' => $site->siteDescription->priorities,
                                                        'History' => $site->siteDescription->history,
                                                        'Physical Integrity' => $site->siteDescription->physical_integrity,
                                                        'Physical Features' => $site->siteDescription->physical_features,
                                                        'Structural Integrity' => $site->siteDescription->structural_integrity,
                                                        'Historic Fabric' => $site->siteDescription->historic_fabric,
                                                        'Authentic Design' => $site->siteDescription->authentic_design,
                                                        'Authentic Setting' => $site->siteDescription->authentic_setting,
                                                        'Authentic Material' => $site->siteDescription->authentic_material,
                                                        'Demographic Growth' => $site->siteDescription->demographic_growth,
                                                    ];
                                                    $validFields = array_filter($fields, function($content) {
                                                        return trim($content) !== '<br>';
                                                    });
                                                @endphp
                            
                                                @if(count($validFields) > 0)
                                                    @foreach($validFields as $title => $content)
                                                        <div class="mb-3">
                                                            <strong class="d-block">{{ $title }}:</strong>
                                                            {!! $content !!}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="mb-3">
                                                        <strong class="d-block">No Data Found</strong>
                                                    </div>
                                                @endif
                                            </div>
                            
                                            <div class="tab-pane fade" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab">
                                                @php
                                                    $fields1 = [
                                                        'Keep Watch' => $site->siteMaintenance->keep_watch,
                                                        'Budget' => $site->siteMaintenance->budget,
                                                        'Long Term Plan' => $site->siteMaintenance->long_plan,
                                                        'Medium Term Plan' => $site->siteMaintenance->medium_plan,
                                                        'Short Term Plan' => $site->siteMaintenance->short_plan,
                                                        'Financial Plan' => $site->siteMaintenance->financial_plan,
                                                        'Management Plan' => $site->siteMaintenance->management_plan,
                                                        'Maintenance Strategy' => $site->siteMaintenance->maintenance_strategy,
                                                        'Special Treatment & Care' => $site->siteMaintenance->special_care,
                                                        'Intervension' => $site->siteMaintenance->intervension,
                                                        'Interpretations of the Ruins' => $site->siteMaintenance->interpretation,
                                                        'Preventive Action' => $site->siteMaintenance->preventive_action,
                                                        'Lack of Maintenance' => $site->siteMaintenance->lack_maintenance,
                                                        'Disaster Hazard Plan' => $site->siteMaintenance->disaster_plan,
                                                        'Education & Research' => $site->siteMaintenance->edu_research,
                                                        'Tourism' => $site->siteMaintenance->tourism,
                                                        'Typology' => $site->siteMaintenance->typology,
                                                        'Condition' => $site->siteMaintenance->condition,
                                                        'Conservation Plan' => $site->siteMaintenance->conservation_plan,
                                                        'Degree of Intervention' => $site->siteMaintenance->degree_intervension,
                                                        'Social Impact of Tourism' => $site->siteMaintenance->social_impact,
                                                        'Over Utilization of Historic Center' => $site->siteMaintenance->over_utilization,
                                                    ];
                                                    $validFields1 = array_filter($fields1, function($content) {
                                                        return trim($content) !== '<br>';
                                                    });
                                                @endphp
                            
                                                @if(count($validFields1) > 0)
                                                    @foreach($validFields1 as $title => $content)
                                                        <div class="mb-3">
                                                            <strong class="d-block">{{ $title }}:</strong>
                                                            {!! $content !!}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="mb-3">
                                                        <strong class="d-block">No Data Found</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="pills-publication" role="tabpanel" aria-labelledby="pills-publication">
                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <strong class="d-block mb-2">Relevant Publication:</strong>
                                                        {!!$site->siteMaintenance->publication_text!!}
                                                        <br>
                                                        <br>
                                                            @if($site->siteMaintenance->publication)
                                                            @foreach(explode(',', $site->siteMaintenance->publication) as $file)
                                                                @php
                                                                    $parts = explode('/', $file);
                                                                    $originalName = $parts[0] ?? '';
                                                                    $storedName = $parts[1] ?? '';
                                                                    $extension = pathinfo($storedName, PATHINFO_EXTENSION);
                                                                    $previewable = in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png']);
                                                                @endphp
                                                        
                                                        @if(!empty($storedName))
                                                            <div class="border rounded p-3 bg-light mb-3">
                                                                @if($previewable)
                                                                    <iframe class="w-100 mb-3" style="height: 300px;" 
                                                                            src="{{ asset('storage/publication/' . $storedName) }}" 
                                                                            frameborder="1"></iframe>
                                                                @else
                                                                    <p class="text-muted mb-3">
                                                                        <i class="fas fa-file-alt me-2"></i>
                                                                        <strong>Preview not available for this file type ({{ strtoupper($extension) }})</strong>
                                                                    </p>
                                                                @endif
                                                    
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <i class="fas fa-file-alt me-2"></i>
                                                                        <strong>{{ $storedName }}</strong>
                                                                    </div>
                                                                    <a href="{{ asset('storage/publication/' . $storedName) }}" download class="btn btn-primary btn-sm">
                                                                        Download File
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                            @endforeach
                                                        @else
                                                            <div class="alert alert-warning" role="alert">
                                                                No relevant document available.
                                                            </div>
                                                        @endif
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-archive" role="tabpanel" aria-labelledby="pills-archive">
                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <strong class="d-block mb-2">Archives Document:</strong>
                                                        {!!$site->siteMaintenance->archive_text!!}
                                                        <br>
                                                        <br>
                                                            @if($site->siteMaintenance->archives)
                                                            @foreach(explode(',', $site->siteMaintenance->archives) as $file)
                                                                @php
                                                                    $parts = explode('/', $file);
                                                                    $originalName = $parts[0] ?? '';
                                                                    $storedName = $parts[1] ?? '';
                                                                    $extension = pathinfo($storedName, PATHINFO_EXTENSION);
                                                                    $previewable = in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png']);
                                                                @endphp
                                                        
                                                                @if(!empty($storedName))
                                                                    <div class="border rounded p-3 bg-light mb-3">
                                                                        @if($previewable)
                                                                            <iframe class="w-100 mb-3" style="height: 300px;" 
                                                                                    src="{{ asset('storage/archives/' . $storedName) }}" 
                                                                                    frameborder="1"></iframe>
                                                                        @else
                                                                            <p class="text-muted mb-3">
                                                                                <i class="fas fa-file-alt me-2"></i>
                                                                                <strong>Preview not available for this file type ({{ strtoupper($extension) }})</strong>
                                                                            </p>
                                                                        @endif
                                                                    
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <i class="fas fa-file-alt me-2"></i>
                                                                                <strong>{{ $storedName }}</strong>
                                                                            </div>
                                                                            <a href="{{ asset('storage/archives/' . $storedName) }}" download class="btn btn-primary btn-sm">
                                                                                Download File
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="alert alert-warning" role="alert">
                                                                No relevant document available.
                                                            </div>
                                                        @endif
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-documentory" role="tabpanel" aria-labelledby="pills-documentory">
                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <strong class="d-block mb-2">Documentory Research Work:</strong>
                                                        {!!$site->siteMaintenance->documentory_text!!}
                                                        <br>
                                                        <br>
                                                            @if($site->siteMaintenance->documentory)
                                                            @foreach(explode(',', $site->siteMaintenance->documentory) as $file)
                                                                @php
                                                                    $parts = explode('/', $file);
                                                                    $originalName = $parts[0] ?? '';
                                                                    $storedName = $parts[1] ?? '';
                                                                    $extension = pathinfo($storedName, PATHINFO_EXTENSION);
                                                                    $previewable = in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png']);
                                                                @endphp
                                                        
                                                                @if(!empty($storedName))
                                                                    <div class="border rounded p-3 bg-light mb-3">
                                                                        @if($previewable)
                                                                            <iframe class="w-100 mb-3" style="height: 300px;" 
                                                                                    src="{{ asset('storage/documentory/' . $storedName) }}" 
                                                                                    frameborder="1"></iframe>
                                                                        @else
                                                                            <p class="text-muted mb-3">
                                                                                <i class="fas fa-file-alt me-2"></i>
                                                                                <strong>Preview not available for this file type ({{ strtoupper($extension) }})</strong>
                                                                            </p>
                                                                        @endif
                                                                    
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <i class="fas fa-file-alt me-2"></i>
                                                                                <strong>{{ $storedName }}</strong>
                                                                            </div>
                                                                            <a href="{{ asset('storage/documentory/' . $storedName) }}" download class="btn btn-primary btn-sm">
                                                                                Download File
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="alert alert-warning" role="alert">
                                                                No relevant document available.
                                                            </div>
                                                        @endif
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog_right_sidebar important-place">
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Places you must visit</h3>
                                @foreach ($mustVisitPlaces as $place)
                                    <div class="media post_item">
                                        <img src="{{ asset('storage/' . $place->thumbnail) }}" alt="post" loading="lazy">
                                        <div class="media-body">
                                            <a href="{{ route('frontend.show.place', ['id' => $place->id]) }}">
                                                <h3>{{ $place->site_name_en }}</h3>
                                            </a>
                                            <p>
                                                @if ($place->siteDescription)
                                                    @if ($place->siteDescription->current_condition == 1)
                                                        <span class="text-success">Well Preserved</span>
                                                    @elseif ($place->siteDescription->current_condition == 2)
                                                        <span class="text-warning">Vulnerable Condition</span>
                                                    @elseif ($place->siteDescription->current_condition == 3)
                                                        <span class="text-danger">Critical Condition</span>
                                                    @elseif ($place->siteDescription->current_condition === null)
                                                        <span class="text-danger">Unknown</span>
                                                    @endif
                                                @else
                                                    <span class="text-danger">No Condition Info</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#" class="d-flex category-link" data-id="{{ $category->id }}">
                                            <p>{{ $category->name }}</p> 
                                            <p>({{ $category->sites->count() }})</p> 
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title">Gallery</h4>
                            <ul class="instagram_row flex-wrap">
                                @if ($media)
                                    @foreach ($media as $m)
                                        <li>
                                            <a href="javascript:void(0);" class="gallery-item" data-title="{{ $m->title }}">
                                                <img class="w-100 aspect-square object-cover" src="{{ asset('storage/'.$m->file_path) }}" alt="{{ $m->title }}" loading="lazy">
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <p>No Image Found In Gallery</p>
                                @endif   
                            </ul>
                        </aside>

                        <!-- Modal for displaying full-size image -->
                        <div id="imageModal" class="modal">
                            <span class="close" id="closeModal">&times;</span>
                            <span class="arrow left" id="prevImage">&#10094;</span>
                            <img id="fullSizeImage" class="modal-content" src="" alt="">
                            <span class="arrow right" id="nextImage">&#10095;</span>
                            <div id="imageTitle" class="modal-title"></div>
                        </div>


                        <!-- Image Upload Section -->
                        <div class="image-upload-section mt-3">
                            <h4>Got any image to share?</h4>
                            <input type="text" id="userName" class="form-control mt-2" placeholder="Your Name">
                            <input type="text" id="userPhone" class="form-control mt-2" placeholder="Your Phone No">
                            <br>

                            <input type="hidden" id="galleryId" value="{{ $site->id }}">

                            <input type="file" id="imageInput" multiple accept="image/*" class="form-control">

                            <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>

                            <div class="h-captcha" data-sitekey="014845de-49c0-4e1c-91da-f19a66c4245c"></div>

                            <button id="uploadBtn" class="btn btn-primary mt-2">Upload</button>
                        </div>
                        <br>
                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Subscribe</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->

@endsection

@section('external_js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    $(document).ready(function() {
        let imageSources = [];
        let imageTitles = [];
        let currentIndex = 0;

        // Prepare image lists
        $('.gallery-item').each(function(index) {
            imageSources.push($(this).find('img').attr('src'));
            imageTitles.push($(this).data('title'));
        });

        // Show modal with clicked image
        $('.gallery-item img').on('click', function() {
            let src = $(this).attr('src');
            currentIndex = imageSources.indexOf(src);

            showModalImage(currentIndex);
        });

        // Show image in modal by index
        function showModalImage(index) {
            $('#fullSizeImage').attr('src', imageSources[index]);
            $('#imageTitle').text(imageTitles[index]);
            $('#imageModal').css('display', 'block');
            $('body').addClass('modal-open');
        }

        // Close modal
        $('#closeModal').on('click', function() {
            $('#imageModal').css('display', 'none');
            $('body').removeClass('modal-open');
        });

        // Navigate to previous image
        $('#prevImage').on('click', function() {
            currentIndex = (currentIndex - 1 + imageSources.length) % imageSources.length;
            showModalImage(currentIndex);
        });

        // Navigate to next image
        $('#nextImage').on('click', function() {
            currentIndex = (currentIndex + 1) % imageSources.length;
            showModalImage(currentIndex);
        });

        // Close on outside click
        $(window).on('click', function(event) {
            if ($(event.target).is('#imageModal')) {
                $('#imageModal').css('display', 'none');
                $('body').removeClass('modal-open'); 
            }
        });


        let selectedFiles = [];

        // Handle image selection
        $("#imageInput").on("change", function (event) {
            let files = Array.from(event.target.files);
            files.forEach(file => selectedFiles.push(file));

            updatePreview();
        });

        // Function to update the preview section
        function updatePreview() {
            $("#imagePreview").empty();

            selectedFiles.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgWrapper = $("<div>").addClass("position-relative m-2");
                    let img = $("<img>")
                        .attr("src", e.target.result)
                        .addClass("rounded border p-1 shadow-sm")
                        .css({ width: "100px", height: "100px", objectFit: "cover" });

                    let deleteBtn = $("<button>")
                        .html("&times;")
                        .attr("data-index", index)
                        .addClass("btn btn-danger btn-sm position-absolute top-0 end-0 px-2 py-3 small-delete")
                        .on("click", function () {
                            let removeIndex = $(this).attr("data-index");
                            selectedFiles.splice(removeIndex, 1);
                            updatePreview();
                        });

                    imgWrapper.append(img).append(deleteBtn);
                    $("#imagePreview").append(imgWrapper);
                };
                reader.readAsDataURL(file);
            });

            $("#imageInput").val("");
        }

    // Handle AJAX Upload
    $("#uploadBtn").on("click", function () {
        if (selectedFiles.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No Images Selected",
                text: "Please select at least one image before uploading."
            });
            return;
        }

        // Get hCaptcha response
        var hCaptchaResponse = hcaptcha.getResponse();


        if (!hCaptchaResponse) {
            Swal.fire({
                icon: "error",
                title: "hCaptcha Validation Failed",
                text: "Please complete the hCaptcha to proceed."
            });
            return;
        }

        let userName = $("#userName").val();
        let userPhone = $("#userPhone").val();

        let formData = new FormData();
        selectedFiles.forEach((file, index) => {
            formData.append("images[]", file);
        });

        let galleryId = $("#galleryId").val();
        formData.append("gallery_id", galleryId);
        formData.append("h-captcha-response", hCaptchaResponse); // Add hCaptcha response
        formData.append("user_name", userName);
        formData.append("user_phone", userPhone);

        $.ajax({
            url: "{{ route('frontend.gallery.upload') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            beforeSend: function () {
                $("#uploadBtn").text("Uploading...").prop("disabled", true);
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Upload Successful",
                    text: response.message
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                $("#uploadBtn").text("Upload").prop("disabled", false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = Object.values(errors).map(error => error.join("<br>")).join("<br>");

                    Swal.fire({
                        icon: "error",
                        title: "Validation Error",
                        html: errorMessage
                    });
                    // Reset hCaptcha after validation error
                    if (typeof hcaptcha !== "undefined") {
                        hcaptcha.reset();
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Upload Failed",
                        text: "Failed to upload images. Please try again."
                    });
                }
            },
            complete: function () {
                $("#uploadBtn").text("Upload").prop("disabled", false);
            }
        });
    });


        $('.category-link').on('click', function (e) {
            e.preventDefault(); 

            let zillaId = $(this).data('id'); 

            $.ajax({
                url: "{{ route('frontend.search.catagory') }}",
                method: "GET",
                data: { zilla_id: zillaId },
                beforeSend: function () {
                    $('#searchResults').html('<p>Loading...</p>'); 
                },
                success: function (response) {
                    window.location.href = "{{ route('frontend.search.catagory') }}?zilla_id=" + zillaId;
                },
                error: function () {
                    alert('Error loading data');
                }
            });
        });
    });
</script>

@endsection
