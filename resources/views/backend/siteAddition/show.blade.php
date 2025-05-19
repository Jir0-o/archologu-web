@extends('layouts.adminApp')

@section('title', 'Site Details || Heritage In Khulna')

@section('external_css')

<style>
    .banner-box {
        background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset("storage/". $site->banner) }}');
        background-repeat: no-repeat;
        background-size: 100%;
        background-position: center;
        aspect-ratio: 5/2;
        display: grid;
        place-content: center;
    }
</style>

@endsection

@section('content')

<!-- Content -->
<section class="site-view">
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="banner-box">
                            <h1 class="m-0 py-5 text-white">{{ $site->site_name_en }}</h1>
                        </div>
                        <div class="icon-row">
                            <div class="d-flex gap-3">
                                <span class="icon-item">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $site->thana->name }}, {{ $site->district->name }}
                                </span>
                                <span class="icon-item">
                                    <i class="fa-solid fa-building-columns"></i>
                                    In {!! $site->current_condition !!}
                                </span>
                            </div>
                        </div>
                        @if ($site->site_description != '<br>')
                            <div class="site-des py-3">
                                <h5 class="fw-bold">Description</h5>
                                {!! $site->site_description !!}
                            </div>
                        @endif
                        <img src="{{ asset('storage/' . ($site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" class="img-fluid">                    
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <strong class="d-block">Immediate Problem: </strong>
                            {!! $site->immediate_problem !!}
                        </p>
                        <p>
                            <strong class="d-block">Urgent Problem: </strong>
                            {!! $site->urgent_problem !!}
                        </p>
                        <p>
                            <strong class="d-block">Threats: </strong>
                            {!! $site->threats !!}
                        </p>
                        <p>
                            <strong class="d-block">Ownership: </strong>
                            {!! $site->ownership !!}
                        </p>
                        <p>
                            <strong class="d-block">Map Link: </strong>
                            <a href="{{ $site->map_url }}" target="_blank">View Map</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-des-tab" data-bs-toggle="pill" data-bs-target="#pills-des" type="button" role="tab" aria-controls="pills-des" aria-selected="true">Site Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-main" type="button" role="tab" aria-controls="pills-main" aria-selected="false">Site Maintenence</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-report-tab" data-bs-toggle="pill" data-bs-target="#pills-report" type="button" role="tab" aria-controls="pills-report" aria-selected="false">Reports</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-document-tab" data-bs-toggle="pill" data-bs-target="#pills-document" type="button" role="tab" aria-controls="pills-document" aria-selected="false">Document</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-des" role="tabpanel" aria-labelledby="pills-des-tab" tabindex="0">
                                @php
                                    $fields = [
                                        'Integrity' => $site->integrity,
                                        'Value' => $site->value,
                                        'Priorities' => $site->priorities,
                                        'History' => $site->history,
                                        'Physical Integrity' => $site->physical_integrity,
                                        'Physical Features' => $site->physical_features,
                                        'Structural Integrity' => $site->structural_integrity,
                                        'Historic Fabric' => $site->historic_fabric,
                                        'Authentic Design' => $site->authentic_design,
                                        'Authentic Setting' => $site->authentic_setting,
                                        'Authentic Material' => $site->authentic_material,
                                        'Demographic Growth' => $site->demographic_growth,
                                        ];
                                    $validFields = array_filter($fields, function($content) {
                                        return trim($content) !== '<br>';
                                    });
                                @endphp
                                @if(count($validFields) > 0)
                                @foreach($validFields as $title => $content)
                                    <div class="mb-3">
                                        <strong class="d-block">{{ $title }}: </strong>
                                        {!! $content !!}
                                    </div>
                                @endforeach
                                @else
                                <div class="mb-3">
                                    <strong class="d-block">No Data Found</strong>
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab" tabindex="0">
                                @php
                                    $fields = [
                                        'Keep Watch' => $site->keep_watch,
                                        'Budget' => $site->budget,
                                        'Long Term Plan' => $site->long_plan,
                                        'Medium Term Plan' => $site->medium_plan,
                                        'Short Term Plan' => $site->short_plan,
                                        'Financial Plan' => $site->financial_plan,
                                        'Management Plan' => $site->management_plan,
                                        'Maintenance Strategy' => $site->maintenance_strategy,
                                        'Special Treatment & Care' => $site->special_care,
                                        'Intervension' => $site->intervension,
                                        'Interpretations of the Ruins' => $site->interpretation,
                                        'Preventive Action' => $site->preventive_action,
                                        'Lack of Maintenance' => $site->lack_maintenance,
                                        'Disaster Hazarad Plan' => $site->disaster_plan,
                                        'Education & Research' => $site->edu_research,
                                        'Tourism' => $site->tourism,
                                        'Typology' => $site->typology,
                                        'Condition' => $site->condition,
                                        'Conservation Plan' => $site->conservation_plan,
                                        'Degree of Intervension' => $site->degree_intervension,
                                        'Social Impact of Tourism' => $site->social_impact,
                                        'Over Utilization of Historic Center' => $site->over_utilization,
                                        ];
                                    $validFields1 = array_filter($fields, function($content) {
                                        return trim($content) !== '<br>';
                                    });
                                @endphp
                                @if(count($validFields1) > 0)
                                    @foreach($validFields1 as $title => $content)
                                        <div class="mb-3">
                                            <strong class="d-block">{{ $title }}: </strong>
                                            {!! $content !!}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-3">
                                        <strong class="d-block">No Data Found</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
                                <h5>Gallery</h5>
                                <div class="row">
                                    @if ($media)
                                        @foreach ($media as $img)
                                            <div class="col-sm-6 col-md-4">
                                                <div class="text-center mb-2">
                                                    <strong>{{ $img->title }}</strong>
                                                </div>
                            
                                                <img class="img-fluid" src="{{ asset('storage/'.$img->file_path) }}" alt="{{ $img->file_path }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No Image Found In Gallery</p>
                                    @endif
                                </div>
                            </div>                            
                            <div class="tab-pane fade" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4"> 
                                            @if($site->relevant_doc)
                                                <strong class="d-block">Relevant Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->relevant_doc) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->relevant_doc) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Relevant Doc: </strong>
                                                <p>No relevant document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->monitoring_reporting)
                                                <strong class="d-block">Systematic Monitoring & Reporting Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->monitoring_reporting) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->monitoring_reporting) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Systematic Monitoring & Reporting Doc: </strong>
                                                <p>No Systematic Monitoring & Reporting document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->planning_action)
                                                <strong class="d-block">Planning & Action Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->planning_action) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->planning_action) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Planning & Action Doc: </strong>
                                                <p>No Planning & Action document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->technical_assistance)
                                                <strong class="d-block">Technical Assistance/World Heritage Fund Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->technical_assistance) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->technical_assistance) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Technical Assistance/World Heritage Fund Doc: </strong>
                                                <p>No Technical Assistance/World Heritage Fund document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->initial_survey)
                                                <strong class="d-block">Initial Survey Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->initial_survey) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->initial_survey) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Initial Survey Doc: </strong>
                                                <p>No Initial Survey document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->execution_work)
                                                <strong class="d-block">Execution of Works Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->execution_work) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->execution_work) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Execution of Works Doc: </strong>
                                                <p>No Execution of Works document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->annual_plan)
                                                <strong class="d-block">Revised Work Programme & Next Annual Plan Doc: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->annual_plan) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->annual_plan) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Revised Work Programme & Next Annual Plan Doc: </strong>
                                                <p>No Revised Work Programme & Next Annual Plan document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            @if($site->master_plan)
                                                <strong class="d-block">Conservation Master Plan: </strong>
                                                <iframe class="w-100" style="height: 300px" src="{{ asset('storage/'. $site->master_plan) }}" frameborder="1"></iframe>
                                                <strong><a href="{{ asset('storage/'. $site->master_plan) }}" download>Click For Download</a></strong>
                                            @else
                                                <strong class="d-block">Conservation Master Plan: </strong>
                                                <p>No Conservation Master Plan document available.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            @if($site->publication)
                                                <strong class="d-block">Publication: </strong>
                                                @foreach(explode(',', $site->publication) as $publication)
                                                    <div class="mb-2">
                                                        @php
                                                            $fileName = pathinfo($publication, PATHINFO_FILENAME);
                                                            $extension = pathinfo($publication, PATHINFO_EXTENSION);
                                                        @endphp
                                    
                                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                            <img src="{{ asset('storage/'. $publication) }}" alt="{{ $fileName }}" class="w-100" style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <strong><a href="{{ asset('storage/'. $publication) }}" download>Click For Download ({{ $fileName }}.{{ $extension }})</a></strong>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <strong class="d-block">Publication: </strong>
                                                <p>No document available.</p>
                                            @endif
                                        </div>
                                    
                                        <div class="mb-4">
                                            @if($site->archives)
                                                <strong class="d-block">Archives: </strong>
                                                @foreach(explode(',', $site->archives) as $archive)
                                                    <div class="mb-2">
                                                        @php
                                                            $fileName = pathinfo($archive, PATHINFO_FILENAME);
                                                            $extension = pathinfo($archive, PATHINFO_EXTENSION);
                                                        @endphp
                                    
                                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                            <img src="{{ asset('storage/'. $archive) }}" alt="{{ $fileName }}" class="w-100" style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <strong><a href="{{ asset('storage/'. $archive) }}" download>Click For Download ({{ $fileName }}.{{ $extension }})</a></strong>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <strong class="d-block">Archives: </strong>
                                                <p>No document available.</p>
                                            @endif
                                        </div>
                                    
                                        <div class="mb-4">
                                            @if($site->documentory)
                                                <strong class="d-block">Documentory: </strong>
                                                @foreach(explode(',', $site->documentory) as $documentory)
                                                    <div class="mb-2">
                                                        @php
                                                            $fileName = pathinfo($documentory, PATHINFO_FILENAME);
                                                            $extension = pathinfo($documentory, PATHINFO_EXTENSION);
                                                        @endphp
                                    
                                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                            <img src="{{ asset('storage/'. $documentory) }}" alt="{{ $fileName }}" class="w-100" style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <strong><a href="{{ asset('storage/'. $documentory) }}" download>Click For Download ({{ $fileName }}.{{ $extension }})</a></strong>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <strong class="d-block">Documentory: </strong>
                                                <p>No document available.</p>
                                            @endif
                                        </div>
                                    </div>                                                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Content -->


@endsection

@section('external_js')

@endsection