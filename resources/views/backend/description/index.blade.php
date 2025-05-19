@extends('layouts.adminApp')

@section('title', 'Site Description || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <a href="{{ route('backend.description.create') }}" class="btn btn-primary">Add Site Description</a>

    <div class="mb-3 mt-3">
        <label for="site-select" class="form-label">Select Site</label>
        <select id="site-select" class="form-control">
            <option value="">-- Select Site --</option>
            @foreach ($sites as $site)
                <option value="{{ $site->id }}">{{ $site->site_name_en }}</option>
            @endforeach
        </select>
    </div>

    <div id="site-descriptions">
        <!-- Site descriptions will be loaded here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#site-select').change(function() {
        var siteId = $(this).val();
        if (siteId) {
            $.ajax({
                url: "{{ route('backend.description.getBySite') }}",
                type: "GET",
                data: { site_id: siteId },
                dataType: "json",
                success: function(response) {
                    var descriptionsHtml = "";
                    if (response.length > 0) {
                        descriptionsHtml += `<div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Site Description</th>
                                        <th>Current Condition</th>
                                        <th>Immediate Problem</th>
                                        <th>Urgent Problem</th>
                                        <th>Threats</th>
                                        <th>Integrity</th>
                                        <th>Value</th>
                                        <th>Priorities</th>
                                        <th>Ownership</th>
                                        <th>Map URL</th>
                                        <th>History</th>
                                        <th>Physical Integrity</th>
                                        <th>Structural Integrity</th>
                                        <th>Physical Features</th>
                                        <th>Historic Fabric</th>
                                        <th>Authenticity in Design</th>
                                        <th>Authenticity in Setting</th>
                                        <th>Authenticity in Material</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        $.each(response, function(index, desc) {
                            descriptionsHtml += `<tr>
                                <td>${desc.site_description}</td>
                                <td>${desc.current_condition}</td>
                                <td>${desc.immediate_problem}</td>
                                <td>${desc.urgent_problem}</td>
                                <td>${desc.threats}</td>
                                <td>${desc.integrity}</td>
                                <td>${desc.value}</td>
                                <td>${desc.priorities}</td>
                                <td>${desc.ownership}</td>
                                <td><a href="${desc.map_url}" target="_blank">View Map</a></td>
                                <td>${desc.history}</td>
                                <td>${desc.physical_integrity}</td>
                                <td>${desc.structural_integrity}</td>
                                <td>${desc.physical_features}</td>
                                <td>${desc.historic_fabric}</td>
                                <td>${desc.authentic_design}</td>
                                <td>${desc.authentic_setting}</td>
                                <td>${desc.authentic_material}</td>
                            </tr>`;
                        });

                        descriptionsHtml += `</tbody></table></div>`;
                    } else {
                        descriptionsHtml = "<p class='text-danger'>No descriptions found for this site.</p>";
                    }

                    $('#site-descriptions').html(descriptionsHtml);
                }
            });
        } else {
            $('#site-descriptions').html('');
        }
    });
});
</script>


@endsection

@section('external_js')

@endsection