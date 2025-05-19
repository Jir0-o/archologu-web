@extends('layouts.adminApp')

@section('title', 'Site Maintenance || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <a href="{{ route('backend.maintenance.create') }}" class="btn btn-primary"> Add Site Maintenance Info</a>

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
    
    <div id="maintenance-info"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#site-select').change(function() {
        var siteId = $(this).val();
        if (siteId) {
            $.ajax({
                url: "{{ route('backend.maintenance.getBySite') }}",
                type: "GET",
                data: { site_id: siteId },
                dataType: "json",
                success: function(response) {
                    var maintenancesHtml = "";
                    if (response.length > 0) {
                        maintenancesHtml += `<div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Keep Watch</th>
                                        <th>Budgeting</th>
                                        <th>Longer Term Financial Plan</th>
                                        <th>Management Plan</th>
                                        <th>Maintenance Strategy Plan</th>
                                        <th>Special Treatment & Care</th>
                                        <th>Interventions</th>
                                        <th>Interpretations of the ruins</th>
                                        <th>Preventive Action</th>
                                        <th>Lack of Maintenance</th>
                                        <th>Disaster Hazard Plan</th>
                                        <th>Education & Research</th>
                                        <th>Tourism</th>
                                        <th>Typology</th>
                                        <th>Condition</th>
                                        <th>Conservation Plan</th>
                                        <th>Conservation Master Plan</th>
                                        <th>Degree of Intervension</th>
                                        <th>Social Impact of Tourism</th>
                                        <th>Over-utilization of Historic Center</th>
                                        <th>Planning and Action Document</th>
                                        <th>Technical Assistance</th>
                                        <th>Relevant Documentation</th>
                                        <th>Initial Survey</th>
                                        <th>Execution of Works</th>
                                        <th>Revised Work & Next Annual Plan</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        $.each(response, function(index, desc) {
                            let basePath = "{{ asset('storage/maintenance_docs') }}";
                            maintenancesHtml += `<tr>
                                <td>${desc.keep_watch}</td>
                                <td>${desc.budget}</td>
                                <td>${desc.financial_plan}</td>
                                <td>${desc.management_plan}</td>
                                <td>${desc.maintenance_strategy}</td>
                                <td>${desc.special_care}</td>
                                <td>${desc.intervension}</td>
                                <td>${desc.interpretation}</td>
                                <td>${desc.preventive_action}</td>
                                <td>${desc.lack_maintenance}</td>
                                <td>${desc.disaster_plan}</td>
                                <td>${desc.edu_research}</td>
                                <td>${desc.tourism}</td>
                                <td>${desc.typology}</td>
                                <td>${desc.condition}</td>
                                <td>${desc.conservation_plan}</td>
                                <td>${desc.master_plan}</td>
                                <td>${desc.degree_intervension}</td>
                                <td>${desc.social_impact}</td>
                                <td>${desc.over_utilization}</td>

                                <td>` + (desc.planning_action ? `<a href="${basePath}/${desc.planning_action}" target="_blank" class="btn btn-primary btn-sm">View PDF</a>` : 'No PDF') + `</td>
                                <td>` + (desc.technical_assistance ? `<a href="${basePath}/${desc.technical_assistance}" target="_blank" class="btn btn-success btn-sm">View PDF</a>` : 'No PDF') + `</td>
                                <td>` + (desc.relevant_doc ? `<a href="${basePath}/${desc.relevant_doc}" target="_blank" class="btn btn-info btn-sm">View PDF</a>` : 'No PDF') + `</td>
                                <td>` + (desc.initial_servey ? `<a href="${basePath}/${desc.initial_servey}" target="_blank" class="btn btn-warning btn-sm">View PDF</a>` : 'No PDF') + `</td>
                                <td>` + (desc.execution_work ? `<a href="${basePath}/${desc.execution_work}" target="_blank" class="btn btn-danger btn-sm">View PDF</a>` : 'No PDF') + `</td>
                                <td>` + (desc.annual_plan ? `<a href="${basePath}/${desc.annual_plan}" target="_blank" class="btn btn-secondary btn-sm">View PDF</a>` : 'No PDF') + `</td>
                            </tr>`;
                        });

                        maintenancesHtml += `</tbody></table></div>`;
                    } else {
                        maintenancesHtml = "<p class='text-danger'>No descriptions found for this site.</p>";
                    }

                    $('#maintenance-info').html(maintenancesHtml);
                }
            });
        } else {
            $('#maintenance-info').html('');
        }
    });
});

</script>



@endsection

@section('external_js')

@endsection