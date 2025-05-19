@extends('layouts.adminApp')

@section('title', 'Site Updation || Heritage In Khulna')

@section('external_css')
<style>
    /* new */
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }

    #heading {
        text-transform: uppercase;
        color: #8789FF;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform textarea {
        width: 469px;
        height: 60px;
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #8789FF;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #8789FF;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #8789FF
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #8789FF;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #8789FF;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
    display: flex;
    justify-content: space-between; 
    counter-reset: step;
    margin-bottom: 30px;
    overflow: hidden;
    padding: 0;
    }

    #progressbar .active {
        color: #8789FF
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12.5px;
        width: 10%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #basic_info:before {
        font-family: FontAwesome;
        content: "\f044"
    }

    #progressbar #condition_problem:before {
        font-family: FontAwesome;
        content: "\f06a"
    }

    #progressbar #integrity_intervension:before {
        font-family: FontAwesome;
        content: "\e4d5"
    }

    #progressbar #survey:before {
        font-family: FontAwesome;
        content: "\f46d"
    }

    #progressbar #plan:before {
        font-family: FontAwesome;
        content: "\f279"
    }

    #progressbar #budget:before {
        font-family: FontAwesome;
        content: "\f662"
    }

    #progressbar #maintenance:before {
        font-family: FontAwesome;
        content: "\f7d9"
    }

    #progressbar #other:before {
        font-family: FontAwesome;
        content: "\e476"
    }

    #progressbar #gallery:before {
        font-family: FontAwesome;
        content: "\f302"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #document:before {
        font-family: FontAwesome;
        content: "\f0c5"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #8789FF
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #8789FF
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
    #progressbar ol, ul {
    padding-left: 0rem ;
    }
    /* new */

    /* image preview css */

    .image-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Space between images */
    }

    .image-preview {
        position: relative;
        display: inline-block;
    }

    .image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover; /* Ensure images fit well */
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .delete-image {
    background: rgb(245, 245, 245);
    color: rgb(236, 88, 88);
    border: none;
    cursor: pointer;
    font-size: 14px;
    border-radius: 50%;
    width: 30px;  
    height: 30px; 
    display: inline-block; 
    text-align: center; 
    line-height: 30px; 
    }

    /* image preview css */
    .preview-area {
        display: flex;
        flex-wrap: wrap; 
        gap: 10px; 
    }

    .preview-item {
        width: 150px; 
        margin: 5px; 
        position: relative;
        overflow: hidden;
        height: 100px;
    }

    .preview-item iframe {
        width: 100%; 
        height: 100%; 
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        border: none;
        padding: 5px;
        cursor: pointer;
    }

    .remove-btn:hover {
        background-color: rgba(255, 0, 0, 1);
    }

    .existing-file iframe {
        height: 80px; 
    }

</style>
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
            <img id="previewImage" src="" class="img-fluid" alt="Preview"> 
            </div>
        </div>
        </div>
    </div>

    <!-- new -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center p-0 mb-2">
                <div class="card px-4 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Heritage Informaton Updation</h2>
                    {{-- <p>Fill all form field to go to next step</p> --}}
                    <form id="msform" action="{{ route('backend.siteAddition.update', $site->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                                <li class="active" id="basic_info"><strong>Basic Info</strong></li>
                                <li id="condition_problem"><strong>Condition & Problems</strong></li>
                                <li id="integrity_intervension"><strong>Integrity & Intervension</strong></li>
                                <li id="survey"><strong>Survey</strong></li>
                                <li id="plan"><strong>Plans & Actions</strong></li>
                                <li id="budget"><strong>Budget & Fund</strong></li>
                                <li id="maintenance"><strong>Maintenance</strong></li> 
                                <li id="document"><strong>Documents</strong></li>
                                <li id="other"><strong>Others</strong></li>
                                <li id="gallery"><strong>Site Gallery</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> <br> <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Basic Site Info:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 11</h2>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels">Site Name in English: *</label> 
                                        <input type="text" name="site_name_en" value="{{ $site->site_name_en }}" /> 
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels">Site Name in Bangla: *</label> 
                                        <input type="text" name="site_name_bn" value="{{ $site->site_name_bn }}" /> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels">Site Google Map URL: </label>
                                        <input type="text" id="map_url" name="map_url" value="{{ $site->map_url }}">
                                    </div>
                                <div class="col-3">
                                    <label class="fieldlabels" for="district">District: *</label>
                                    <select name="district_id" id="district" class="form-select" required>
                                        <option value="">Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" 
                                                {{ $district->id == $site->district_id ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="fieldlabels">Thana: *</label> 
                                    <select name="thana_id" id="thana" class="form-select" required>
                                        <option value="">Select Thana</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Image Upload and Preview -->
                            <div class="row">
                                <div class="col-6">
                                    <label class="fieldlabels" for="thumbnail">Site Thumbnail Image:</label>
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                                    @if($site->thumbnail)
                                        <img src="{{ asset('storage/' . $site->thumbnail) }}" 
                                            alt="Thumbnail" class="img-thumbnail mt-2" width="100">
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label class="fieldlabels" for="thumbnail_title">Thumbnail Title:</label>
                                    <input type="text" name="thumbnail_title" id="thumbnail_title" value="{{ $site->thumbnail_title }}">
                                </div>
                                
                                <div class="col-6">
                                    <label class="fieldlabels" for="banner">Site Banner Image:</label>
                                    <input type="file" name="banner" id="banner" accept="image/*">
                                    @if($site->banner)
                                        <img src="{{ asset('storage/' . $site->banner) }}" 
                                            alt="Banner" class="img-thumbnail mt-2" width="150">
                                    @endif
                                </div>

                                    <div class="col-6">
                                        <label class="fieldlabels" for="value">Value: </label>
                                        <textarea id="value" name="value">{!!$site->value !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="priority">Priorities: </label>
                                        <textarea name="priority" id="priority">{!! $site->priorities !!}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="ownership">Ownership</label>
                                        <textarea id="ownership" name="ownership">{!! $site->ownership !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="description">Site Description & Boundary Definition</label>
                                        <textarea name="description" id="description">{!! $site->site_description !!}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="history">History of the Site</label>
                                        <textarea id="history" name="history">{!! $site->history !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="historic_febric">Historic Fabric</label>
                                        <textarea name="historic_febric" id="historic_febric">{!! $site->historic_fabric !!}</textarea>
                                    </div>
                                </div>
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Condition:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 11</h2>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="cur_condition">Current Condition: </label>
                                        <select name="cur_condition" id="cur_condition" class="form-select">
                                            <option value="">Select Condition</option>
                                            <option value="1" {{ $site->current_condition == 1 ? 'selected' : '' }}>Well Preserved</option>
                                            <option value="2" {{ $site->current_condition == 2 ? 'selected' : '' }}>Vulnerable</option>
                                            <option value="3" {{ $site->current_condition == 3 ? 'selected' : '' }}>Critical</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="demo_growth">Demographic Growth: </label>
                                        <textarea name="demo_growth" id="demo_growth" >{!! $site->demographic_growth !!}</textarea>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="authentic_design">Authenticity in Design: </label>
                                        <textarea id="authentic_design" name="authentic_design">{!! $site->authentic_design !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="authentic_setting">Authenticity in Setting: </label>
                                        <textarea id="authentic_setting" name="authentic_setting">{!! $site->authentic_setting !!}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="authentic_material">Authenticity in Material: </label>
                                        <textarea id="authentic_material" name="authentic_material">{!! $site->authentic_material !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="physical_feature">Physical Features: </label>
                                        <textarea id="physical_feature" name="physical_feature">{!! $site->physical_features !!}</textarea>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-12 pt-4">
                                        <h2 class="fs-title">Problems:</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="immediate_problem">Immediate Problem: </label>
                                        <textarea id="immediate_problem" name="immediate_problem">{!! $site->immediate_problem !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="urgent_problem">Urgent Problem: </label>
                                        <textarea id="urgent_problem" name="urgent_problem">{!! $site->urgent_problem !!}</textarea>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="threat">Threats: </label>
                                        <textarea id="threat" name="threat">{!! $site->threats !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                    </div>
                                </div>  
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Integrity:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 11</h2>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="integrity">Integrity of the Site: </label>
                                        <textarea name="integrity" id="integrity">{!! $site->integrity !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="physical_integrity">Physical Integrity: </label>
                                        <textarea name="physical_integrity" id="physical_integrity">{!! $site->physical_integrity !!}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="structural_integrity">Structural Integrity: </label>
                                        <textarea name="structural_integrity" id="structural_integrity">{!! $site->structural_integrity !!}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 pt-4">
                                        <h2 class="fs-title">Intervension:</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="intervension">Intervension: </label>
                                        <textarea name="intervension" id="intervension">{!! $site->intervension !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="degree_intervension">Degree of Intervension: </label>
                                        <textarea name="degree_intervension" id="degree_intervension">{!! $site->degree_intervension !!}</textarea>
                                    </div>
                                </div>
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Survey:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 11</h2>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fieldlabels" for="keep_watch">Keep Watch: </label>
                                        <textarea name="keep_watch" id="keep_watch">{!! $site->keep_watch !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="initial_survey">Initial Survey: </label>
                                        <input type="file" class="form-control" name="initial_survey" id="initial_survey">
                                        
                                        @if(!empty($site->initial_survey))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->initial_survey) }}" target="_blank">
                                                    {{ $site->initial_survey }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="fieldlabels" for="monitoring_reporting">Systematic Monitoring and Reporting:</label>
                                        <input type="file" class="form-control" name="monitoring_reporting" id="monitoring_reporting">
                                        
                                        @if(!empty($site->monitoring_reporting))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->monitoring_reporting) }}" target="_blank">
                                                    {{ $site->monitoring_reporting }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>                                  
                                </div>
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Plans:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 5 - 11</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="long_plan">Long Term Plan: </label>
                                        <textarea name="long_plan" id="long_plan">{!! $site->long_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="medium_plan">Medium Term Plan: </label>
                                        <textarea name="medium_plan" id="medium_plan">{!! $site->medium_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="short_plan">Short Term Plan: </label>
                                        <textarea name="short_plan" id="short_plan">{!! $site->short_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="management_plan">Management Plan: </label>
                                        <textarea name="management_plan" id="management_plan">{!! $site->management_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="financial_plan">Longer Term Financial Plan: </label>
                                        <textarea name="financial_plan" id="financial_plan">{!! $site->financial_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="plan_action">Planning and Acion Document:</label>
                                        <input type="file" class="form-control" name="plan_action" id="plan_action">

                                        @if(!empty($site->planning_action))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->planning_action) }}" target="_blank">
                                                    {{ $site->planning_action }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="annual_plan">Revised Work Programme & Next Annual Plan:</label>
                                        <input type="file" class="form-control" name="annual_plan" id="annual_plan">

                                        @if(!empty($site->annual_plan))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->annual_plan) }}" target="_blank">
                                                    {{ $site->annual_plan }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="disaster_plan">Disaster Hazarad Plan: </label>
                                        <textarea name="disaster_plan" id="disaster_plan">{!! $site->disaster_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="conservation_plan">Conservation Plan: </label>
                                        <textarea name="conservation_plan" id="conservation_plan">{!! $site->conservation_plan !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="master_plan">Conservation Master Plan:</label>
                                        <input type="file" class="form-control" name="master_plan" id="master_plan">

                                        @if(!empty($site->master_plan))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->master_plan) }}" target="_blank">
                                                    {{ $site->master_plan }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <h2 class="fs-title">Actions:</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="preventive_action">Preventive Action: </label>
                                        <textarea name="preventive_action" id="preventive_action">{!! $site->preventive_action !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="special_care">Special Treatment & Care: </label>
                                        <textarea name="special_care" id="special_care">{!! $site->special_care !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="execution_work">Execution of Works:</label>
                                        <input type="file" class="form-control" name="execution_work" id="execution_work">

                                        @if(!empty($site->execution_work))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->execution_work) }}" target="_blank">
                                                    {{ $site->execution_work }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </div> 
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Budget:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 6 - 11</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="budget">Budgeting: </label>
                                        <textarea name="budget" id="budget">{!! $site->budget !!}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <h2 class="fs-title">Fund:</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="fund">Technical Assistance/World Heritage Fund:</label>
                                        <input type="file" class="form-control" name="fund" id="fund">

                                        @if(!empty($site->technical_assistance))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->technical_assistance) }}" target="_blank">
                                                    {{ $site->technical_assistance }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </div> 
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Maintenance:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 7 - 11</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="strategy">Maintenance Strategy: </label>
                                        <textarea name="strategy" id="strategy">{!! $site->maintenance_strategy !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="inventory">Inventory/Documentation/Relevent Document:</label>
                                        <input type="file" class="form-control" name="inventory" id="inventory">

                                        {{-- @if(!empty($site->inventory))
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $site->inventory) }}" target="_blank">
                                                    {{ $site->inventory }}
                                                </a>
                                            </p>
                                        @endif --}}
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="interpretation">Interpretations of the Ruins: </label>
                                        <textarea name="interpretation" id="interpretation">{!! $site->interpretation !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="lack_maintenance">Lack of Maintenance: </label>
                                        <textarea name="lack_maintenance" id="lack_maintenance">{!! $site->lack_maintenance !!}</textarea>
                                    </div>
                                </div> 
                                </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Documents:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 8 - 11</h2>
                                    </div>
                        
                                    <div class="col-6 mb-3">
                                        <label class="fieldlabels" for="publications">Relevant Publications: </label>
                                        <input type="file" class="form-control file-input" name="publications[]" id="publications" multiple>
                                        <div id="publications-preview" class="preview-area">
                                            <h6>Selected Files</h6>
                                            <div id="publications-selected-files" class="preview-area"></div> 
                                    
                                            <div id="publications-existing-files" class="preview-area">
                                                <h6>Existing Files</h6>
                                                <br>
                                                @foreach(explode(',', $site->publication ?? '') as $publication)
                                                    @if($publication)
                                                    @php
                                                        $extension = pathinfo($publication, PATHINFO_EXTENSION); 
                                                        $filename = basename($publication); 
                                                        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME); 
                                                    @endphp
                                                        <div class="preview-item existing-file">
                                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                                <img src="{{ asset('storage/' . $publication) }}" width="100" height="100" alt="Image Preview">
                                                            @elseif(strtolower($extension) == 'pdf') 
                                                                <a href="{{ asset('storage/' . $publication) }}" target="_blank">{{ $filename }}</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $publication) }}" target="_blank">{{ $filename }}</a>
                                                            @endif
                                                            <button type="button" class="remove-btn" data-file="{{ $publication }}" data-id="{{ $site->id }}">×</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        <h6>Publications Text:</h6>
                                        <textarea name="publication_text" id="publication_text">{!! $site->publication_text!!}</textarea>
                                    </div>
                                    
                                    <div class="col-6 mb-3">
                                        <label class="fieldlabels" for="archives">Archive Documents: </label>
                                        <input type="file" class="form-control file-input" name="archives[]" id="archives" multiple>
                                        <div id="archives-preview" class="preview-area">
                                            <h6>Selected Files</h6>
                                            <div id="archives-selected-files" class="preview-area"></div> 
                                    
                                            <div id="archives-existing-files" class="preview-area">
                                                <h6>Existing Files</h6>
                                                <br>
                                                @foreach(explode(',', $site->archives ?? '') as $archive)
                                                    @if($archive)
                                                        @php
                                                            $extension = pathinfo($archive, PATHINFO_EXTENSION);
                                                            $filename = basename($archive);
                                                            $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
                                                           
                                                        @endphp
                                                        <div class="preview-item existing-file">
                                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                                <img src="{{ asset('storage/' . $archive) }}" width="100" height="100" alt="Image Preview">
                                                            @elseif(strtolower($extension) == 'pdf') 
                                                                <a href="{{ asset('storage/' . $archive) }}" target="_blank">{{ $filenameWithoutExt }}</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $archive) }}" target="_blank">{{ $filenameWithoutExt }}</a>
                                                            @endif
                                                            <button type="button" class="remove-btn" data-file="{{ $archive }}" data-id="{{ $site->id }}">×</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        <h6>Archives Text:</h6>
                                        <textarea name="archive_text" id="archive_text">{!! $site->archive_text!!}</textarea>
                                    </div>
                                    
                                    <div class="col-6 mb-3">
                                        <label class="fieldlabels" for="documentory">Documentary Research Work: </label>
                                        <input type="file" class="form-control file-input" name="documentory[]" id="documentory" multiple>
                                        <div id="documentory-preview" class="preview-area">
                                            <h6>Selected Files</h6>
                                            <div id="documentory-selected-files" class="preview-area"></div> 
                                    
                                            <div id="documentory-existing-files" class="preview-area">
                                                <h6>Existing Files</h6>
                                                <br>
                                                @foreach(explode(',', $site->documentory ?? '') as $doc)
                                                    @if($doc)
                                                        @php
                                                            $extension = pathinfo($doc, PATHINFO_EXTENSION);
                                                            $filename = basename($doc);
                                                            $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
                                                        @endphp
                                                        <div class="preview-item existing-file">
                                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                                <img src="{{ asset('storage/' . $doc) }}" width="100" height="100" alt="Image Preview">
                                                            @elseif(strtolower($extension) == 'pdf') 
                                                                <a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ $filenameWithoutExt }}</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ $filenameWithoutExt }}</a>
                                                            @endif
                                                            <button type="button" class="remove-btn" data-file="{{ $doc }}" data-id="{{ $site->id }}">×</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        <h6>Documentary Text:</h6>
                                        <textarea name="documentory_text" id="documentory_text">{!! $site->documentory_text!!}</textarea>
                                    </div>                                                                               
                                </div>      
                            </div>                          
                        
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        
                        <!-- Add your modal or inline delete button UI below each preview -->
                        
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Others:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 9 - 11</h2>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="education">Education: </label>
                                        <textarea name="education" id="education">{!! $site->edu_research !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="tourism">Tourism: </label>
                                        <textarea name="tourism" id="tourism">{!! $site->tourism !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="typology">Typology: </label>
                                        <textarea name="typology" id="typology">{!! $site->typology !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="condition">Condition: </label>
                                        <textarea name="condition" id="condition">{!! $site->condition !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="social_impact">Social Impact of Tourism: </label>
                                        <textarea name="social_impact" id="social_impact">{!! $site->social_impact !!}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label class="fieldlabels" for="over_utilization">Over-utilization of Historic Center: </label>
                                        <textarea name="over_utilization" id="over_utilization">{!! $site->over_utilization !!}</textarea>
                                    </div>
                                </div> 
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Site Gallery:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 10 - 11</h2>
                                    </div>
                                    <div class="col-12">
                                        <label class="fieldlabels" for="media">Upload Images & Videos:</label>
                                        <input type="file" name="media[]" id="media" multiple accept="image/*,video/*">
                                        <h6>Selected Files</h6>
                                        <div id="selectedImages" class="table-responsive mt-3">
                                            <table id="selectedImagesTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SL No</th>
                                                        <th>Preview</th>
                                                        <th>File Name</th>
                                                        <th style="width: 300px;">Caption</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input type=hidden class="form-control image-title" name="titles[]" data-name="${newFile.name}" placeholder="Enter title">
                                                    <!-- Dynamic content -->
                                                </tbody>
                                            </table>
                                        </div> 
                                        <br>
                                        <!-- Show Existing Images -->
                                        <div class="col-12">
                                            <div id="existingImages" class="table-responsive mt-3">
                                            <h6>Existing Images</h6>
                                            <table id="existingImagesTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Preview</th>
                                                        <th>File Name</th>
                                                        <th>Caption</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medias as $index => $media)
                                                        @if ($media->file_type == 'image')
                                                            <tr id="imageRow-{{ $media->id }}">
                                                                <td>{{ $index + 1 }}</td>
                                                            
                                                                <td>
                                                                    <img src="{{ asset('storage/' . $media->file_path) }}" 
                                                                        alt="Uploaded Image" 
                                                                        width="60" 
                                                                        class="preview-image" 
                                                                        style="cursor:pointer;" 
                                                                        data-full="{{ asset('storage/' . $media->file_path) }}">
                                                                </td>
                                                            
                                                                <td>{{ basename($media->file_path) }}</td>
                                                            
                                                                <td>
                                                                    <input type="text" name="existing-image-title[]" 
                                                                           id="existing-image-title-{{ $media->id }}" 
                                                                           class="form-control existing-image-title" 
                                                                           value="{{ $media->title ?? '' }}" 
                                                                           data-id="{{ $media->id }}">
                                                                </td>
                                                            
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-danger delete-image" data-id="{{ $media->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                            <input type="submit" name="next" class="next action-button submit_btn" value="Submit" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 11 - 11</h2>
                                    </div>
                                </div> <br><br>
                                <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="{{asset('backend_assets/assets/img/elements/tick.png')}}" class="fit-image"> </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">Successfully Edited A Site.</h5>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- new -->
    
</div>

@endsection

@section('external_js')

<script>
    $(document).ready(function(){
        $('#existingImagesTable').DataTable();

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 500,
            });
            setProgressBar(++current);
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                'display': 'none',
                'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 500,
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
            .css("width",percent+"%")
        }

        $(".submit").click(function(){
            return false;
        })

        $('#submit_btn').on('submit', (e)=>{
            e.preventDefault();

            let form_data = new form();
            console.log(form_data);
            
        })

    });

    document.getElementById('district').addEventListener('change', function () {
        let districtId = this.value;
        let thanaDropdown = document.getElementById('thana');
        thanaDropdown.innerHTML = '<option value="">Loading...</option>';
        console.log(districtId);
        if (districtId) {
            fetch(`/get-thanas/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    thanaDropdown.innerHTML = '<option value="">Select Thana</option>';
                    data.forEach(thana => {
                        thanaDropdown.innerHTML += `<option value="${thana.id}">${thana.name}</option>`;
                    });
                })
                .catch(error => console.error('Error fetching thanas:', error));
        } else {
            thanaDropdown.innerHTML = '<option value="">Select Thana</option>';
        }
    });

    let selectedThana = "{{ $site->thana_id }}"; // Pre-selected Thana

    function loadThanas(districtId) {
        if (!districtId) return;

        $.ajax({
            url: "{{ route('frontend.get.thanas') }}",
            type: "GET",
            data: { zilla_id: districtId },
            success: function(response) {
                $('#thana').empty().append('<option value="">Select Thana</option>');

                response.forEach(function(thana) {
                    let selected = (thana.id == selectedThana) ? 'selected' : '';
                    $('#thana').append(`<option value="${thana.id}" ${selected}>${thana.name}</option>`);
                });
            },
            error: function() {
                alert('Failed to load Thanas.');
            }
        });
    }

    // Load Thanas on page load (if editing)
    let selectedDistrict = $('#district').val();
    if (selectedDistrict) {
        loadThanas(selectedDistrict);
    }

    // Load Thanas when changing District
    $('#district').change(function() {
        loadThanas($(this).val());
    });

    $(document).ready(function () {
    //handle selected images
    let selectedFiles = [];
    let table = $('#selectedImagesTable').DataTable({
    });

    $("#media").on("change", function (event) {
        let newFiles = Array.from(event.target.files);

        newFiles.forEach((newFile) => {
            if (!selectedFiles.some((file) => file.name === newFile.name)) {
                selectedFiles.push({ file: newFile, title: "" });

                let reader = new FileReader();
                reader.onload = function (e) {
                    let rowNode = table.row.add([
                        table.rows().count() + 1,
                        `<img src="${e.target.result}" class="img-thumbnail preview-img" data-src="${e.target.result}" style="width: 60px; height: 60px; cursor: pointer;">`,
                        newFile.name,
                        `<input type="text" class="form-control image-title" data-name="${newFile.name}" placeholder="Enter title">`,
                        `<button type="button" class="btn btn-danger btn-sm delete-selected-image" data-name="${newFile.name}">🗑️</button>`
                    ]).draw(false).node();

                    $(rowNode).find('.preview-img').on('click', function () {
                        let src = $(this).data('src');
                        Swal.fire({
                            title: 'Image Preview',
                            imageUrl: src,
                            imageAlt: 'Selected Image',
                            imageWidth: '90%', 
                            imageHeight: 'auto'
                        });
                    });
                };
                reader.readAsDataURL(newFile);
            }
        });

        refreshInputFiles();
    });

    $(document).on("click", ".delete-selected-image", function () {
        let fileName = $(this).data("name");

        selectedFiles = selectedFiles.filter(obj => obj.file.name !== fileName);

        table.rows(function (idx, data, node) {
            return data[2] === fileName;
        }).remove().draw(false);

        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            this.data()[0] = rowIdx + 1;
            this.invalidate();
        });

        refreshInputFiles();
    });

    $(document).on("input", ".image-title", function () {
        let fileName = $(this).data("name");
        let titleValue = $(this).val();

        let fileObj = selectedFiles.find(obj => obj.file.name === fileName);
        if (fileObj) {
            fileObj.title = titleValue;
        }
    });

    function refreshInputFiles() {
        let dataTransfer = new DataTransfer();
        selectedFiles.forEach((obj) => dataTransfer.items.add(obj.file));
        $("#media")[0].files = dataTransfer.files;
    }

    $('#msform').on('submit', function () {
    $('.dynamic-titles').remove();
        selectedFiles.forEach((obj, index) => {
            const input = $('<input>')
                .attr('type', 'hidden')
                .attr('name', `titles[${index}]`) 
                .attr('value', obj.title)
                .addClass('dynamic-titles'); 

            $(this).append(input);
        });
    });

    //     // Update Title on input
    //     $(document).on("input", ".existing-image-title", function () {
    //     let id = $(this).data("id");
    //     let newTitle = $(this).val();

    //     // Create hidden input to submit updated titles
    //     if ($(`#existing-title-${id}`).length === 0) {
    //         $('#msform').append(`<input type="hidden" id="existing-title-${id}" name="existing_titles[${id}]" value="${newTitle}" class="dynamic-titles">`);
    //     } else {
    //         $(`#existing-title-${id}`).val(newTitle);
    //     }
    // });

    $(document).on('click', '.delete-image', function() {
        let imageId = $(this).data('id');
        let imageElement = $('#image-' + imageId);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to recover this image!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('backend.admin.deleteImage', ':id') }}".replace(':id', imageId),
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        image_id: imageId
                    },
                    success: function(response) {
                        if (response.success) {
                            let table = $('#existingImagesTable').DataTable();
                            let row = table.row('#imageRow-' + imageId);
                            
                            row.remove().draw();

                            Swal.fire("Deleted!", "The image has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", response.message || "Failed to delete image.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred. Please try again.", "error");
                    }
                });
            }
        });
    });


    $('#msform').on('submit', function () {
        $('.dynamic-titles').remove(); 

        selectedFiles.forEach((obj, index) => {
            const input = $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'titles[]')
                .attr('value', obj.title)
                .addClass('dynamic-titles');
            $('#msform').append(input);
        });
    });

    $(document).on('click', '.preview-image', function () {
        let fullImageUrl = $(this).data('full');
        $('#previewImage').attr('src', fullImageUrl);
        $('#imagePreviewModal').modal('show');
    });

    //
    function handleFileSelect(input, inputId) {
        let selectedFilesContainer = $('#' + inputId + '-selected-files');
        selectedFilesContainer.empty();  // Clear old previews

        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileURL = URL.createObjectURL(file);

            const previewItem = $(`
                <div class="preview-item new-file">
                    ${file.type.startsWith('image') ? 
                        `<img src="${fileURL}" width="100" height="100" alt="Image Preview">` :
                        `<iframe src="${fileURL}" width="100%" height="100px"></iframe>`}
                    <button type="button" class="remove-btn">&times;</button>
                </div>
            `);

            previewItem.find('.remove-btn').on('click', function () {
                previewItem.remove();

                // Remove file from input (limited browser support)
                let dataTransfer = new DataTransfer();
                let newFiles = Array.from(files).filter((f, index) => index !== i);
                newFiles.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            });

            selectedFilesContainer.append(previewItem);
        }
    }

    // File input change handler
    $('.file-input').on('change', function () {
        const inputId = $(this).attr('id'); // publications / archives / documentory
        handleFileSelect(this, inputId);
    });

    $(document).on('click', '.remove-btn', function () {
        var filePath = $(this).attr('data-file');
        var siteId = $(this).attr('data-id'); 
        var $button = $(this); 

        $.ajax({
            url: "{{ route('backend.delete.file' , ':id') }}".replace(':id', siteId),
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                file_path: filePath,
                id: siteId
            },
            success: function (response) {
                if (response.success) {
                    alert('File deleted successfully!');
                    $button.closest('.preview-item').remove();
                } else {
                    alert('Error deleting file.');
                }
            },
            error: function () {
                alert('An error occurred.');
            }
        });
    });
});


</script>
@endsection