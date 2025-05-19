@extends('layouts.adminApp')

@section('title', 'Site Maintenance || Heritage In Khulna')

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
                    <h5 class="mb-0">Site Maintenance Info</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.maintenance.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="col-sm-2 col-form-label" for="keep_watch">Keep Watch</label>
                            <div class="col-sm-10">
                                <textarea name="keep_watch" id="keep_watch" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="monitoring_reoprting">Systematic monitoring and Reporting</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="monitoring_reoprting[]" id="monitoring_reoprting" multiple accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="planning_action">Planning and Action Document</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="planning_action" id="planning_action" accept="application/pdf">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="technical_assistance">Technical Assistance</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="technical_assistance" id="technical_assistance" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="budget">Budgeting</label>
                            <div class="col-sm-10">
                                <textarea name="budget" id="budget" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="financial_plan">Longer Term Financial Plan</label>
                            <div class="col-sm-10">
                                <textarea name="financial_plan" id="financial_plan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="management_plan">Management Plan</label>
                            <div class="col-sm-10">
                                <textarea name="management_plan" id="management_plan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="maintenance_strategy">Maintenance Strategy Plan</label>
                            <div class="col-sm-10">
                                <textarea name="maintenance_strategy" id="maintenance_strategy" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="relevant_doc">Relevant Documentation</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="relevant_doc" id="relevant_doc" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="special_care">Special Treatment & Care</label>
                            <div class="col-sm-10">
                                <textarea name="special_care" id="special_care" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="intervension">Interventions</label>
                            <div class="col-sm-10">
                                <textarea name="intervension" id="intervension" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="interpretation">Interpretations of the ruins</label>
                            <div class="col-sm-10">
                                <textarea name="interpretation" id="interpretation" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="preventive_action">Preventive Action</label>
                            <div class="col-sm-10">
                                <textarea name="preventive_action" id="preventive_action" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="lack_maintenance">Lack of Maintenance</label>
                            <div class="col-sm-10">
                                <textarea name="lack_maintenance" id="lack_maintenance" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="disaster_plan">Disaster Hazard Plan</label>
                            <div class="col-sm-10">
                                <textarea name="disaster_plan" id="disaster_plan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="initial_servey">Initial Servey</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="initial_servey" id="initial_servey" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="execution_work">Execution of Works</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="execution_work" id="execution_work" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="annual_plan">Reivised Work & Next Annual Plan</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="annual_plan" id="annual_plan" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="edu_research">Education & Research</label>
                            <div class="col-sm-10">
                                <textarea name="edu_research" id="edu_research" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tourism">Tourism</label>
                            <div class="col-sm-10">
                                <textarea name="tourism" id="tourism" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="typology">Typology</label>
                            <div class="col-sm-10">
                                <textarea name="typology" id="typology" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="condition">Condition</label>
                            <div class="col-sm-10">
                                <textarea name="condition" id="condition" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="conservation_plan">Conservation Plan</label>
                            <div class="col-sm-10">
                                <textarea name="conservation_plan" id="conservation_plan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="master_plan">Conservation Master Plan</label>
                            <div class="col-sm-10">
                                <textarea name="master_plan" id="master_plan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="degree_intervension">Degree of Intervension</label>
                            <div class="col-sm-10">
                                <textarea name="degree_intervension" id="degree_intervension" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="social_impact">Social Impact of Tourism</label>
                            <div class="col-sm-10">
                                <textarea name="social_impact" id="social_impact" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="over_utilization">Over-utilization of Historic Center</label>
                            <div class="col-sm-10">
                                <textarea name="over_utilization" id="over_utilization" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Maintenance Info</button>
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
    CKEDITOR.replace('keep_watch');
    CKEDITOR.replace('budget');
    CKEDITOR.replace('financial_plan');
    CKEDITOR.replace('management_plan');
    CKEDITOR.replace('maintenance_strategy');
    CKEDITOR.replace('special_care');
    CKEDITOR.replace('intervension');
    CKEDITOR.replace('interpretation');
    CKEDITOR.replace('preventive_action');
    CKEDITOR.replace('lack_maintenance');
    CKEDITOR.replace('disaster_plan');
    CKEDITOR.replace('edu_research');
    CKEDITOR.replace('tourism');
    CKEDITOR.replace('typology');
    CKEDITOR.replace('condition');
    CKEDITOR.replace('conservation_plan');
    CKEDITOR.replace('master_plan');
    CKEDITOR.replace('degree_intervension');
    CKEDITOR.replace('social_impact');
    CKEDITOR.replace('over_utilization');
</script>




@endsection

@section('external_js')

@endsection