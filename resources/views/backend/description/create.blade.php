@extends('layouts.adminApp')

@section('title', 'Site Info || Heritage In Khulna')

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
                    <h5 class="mb-0">Site Description</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.description.store') }}" method="POST">
                        @csrf
                        <!-- Site Selection -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="site">Site</label>
                            <div class="col-sm-10">
                                <select name="site_id" id="site" class="form-select" required>
                                    <option value="">Select Site</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->site_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="site_description">Site Description & Boundary Definition</label>
                            <div class="col-sm-10">
                                <textarea name="site_description" id="site_description" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="current_condition">Current Condition</label>
                            <div class="col-sm-10">
                                <textarea name="current_condition" id="current_conditon" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="immediate_problem">Immediate Problem</label>
                            <div class="col-sm-10">
                                <textarea name="immediate_problem" id="immediate_problem" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="urgent_problem">Urgent Problem</label>
                            <div class="col-sm-10">
                                <textarea name="urgent_problem" id="urgent_problem" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="threats">Threats</label>
                            <div class="col-sm-10">
                                <textarea name="threats" id="threats" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="integrity">Integrity of Site</label>
                            <div class="col-sm-10">
                                <textarea name="integrity" id="integrity" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="value">Value</label>
                            <div class="col-sm-10">
                                <textarea name="value" id="value" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="priorities">Priorities</label>
                            <div class="col-sm-10">
                                <textarea name="priorities" id="priorities" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ownership">Ownership</label>
                            <div class="col-sm-10">
                                <textarea name="ownership" id="ownership" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="map_url">Google Map URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="map_url" name="map_url" placeholder="Paste Google Map URL here">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="history">History</label>
                            <div class="col-sm-10">
                                <textarea name="history" id="history" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="physical_integrity">Physical Integrity</label>
                            <div class="col-sm-10">
                                <textarea name="physical_integrity" id="physical_integrity" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="structural_integrity">Structural Integrity</label>
                            <div class="col-sm-10">
                                <textarea name="structural_integrity" id="structural_integrity" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="physical_features">Physical features</label>
                            <div class="col-sm-10">
                                <textarea name="physical_features" id="physical_features" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="historic_fabric">Historic Fabric</label>
                            <div class="col-sm-10">
                                <textarea name="historic_fabric" id="historic_fabric" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="authentic_design">Authenticity in Design</label>
                            <div class="col-sm-10">
                                <textarea name="authentic_design" id="authentic_design" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="authentic_setting">Authenticity in Setting</label>
                            <div class="col-sm-10">
                                <textarea name="authentic_setting" id="authentic_setting" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="authentic_material">Authenticity in Material</label>
                            <div class="col-sm-10">
                                <textarea name="authentic_material" id="authentic_material" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Description</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script src="{{ asset('backend_assets/assets/ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('site_description');
    CKEDITOR.replace('current_condition');
    CKEDITOR.replace('immediate_problem');
    CKEDITOR.replace('urgent_problem');
    CKEDITOR.replace('threats');
    CKEDITOR.replace('integrity');
    CKEDITOR.replace('value');
    CKEDITOR.replace('priorities');
    CKEDITOR.replace('ownership');
    CKEDITOR.replace('history');
    CKEDITOR.replace('physical_integrity');
    CKEDITOR.replace('structural_integrity');
    CKEDITOR.replace('physical_features');
    CKEDITOR.replace('historic_fabric');
    CKEDITOR.replace('authentic_design');
    CKEDITOR.replace('authentic_setting');
    CKEDITOR.replace('authentic_material');
</script>




@endsection

@section('external_js')

@endsection