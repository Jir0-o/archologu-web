@extends('layouts.adminApp')

@section('title', 'Site Addition || Heritage In Khulna')

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
                    <h5 class="mb-0">Site Addititon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.site.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Site Name in Bangla</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="site_name_bn" name="site_name_bn" placeholder="বাংলায় লিখুন" required />
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Site Name in English</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="site_name_en" name="site_name_en" placeholder="Type in English" required />
                            </div>
                        </div>
                    
                        <!-- District Selection -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="district">District</label>
                            <div class="col-sm-10">
                                <select name="district_id" id="district" class="form-select" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <!-- Thana Selection (Dependent on District) -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="thana">Thana</label>
                            <div class="col-sm-10">
                                <select name="thana_id" id="thana" class="form-select" required>
                                    <option value="">Select Thana</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="active">Active</label>
                            <div class="col-sm-10">
                                <select name="active" class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Site</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script>
    document.getElementById('district').addEventListener('change', function () {
        let districtId = this.value;
        let thanaDropdown = document.getElementById('thana');
        thanaDropdown.innerHTML = '<option value="">Loading...</option>';
        
        if (districtId) {
            let url = `{{ route('backend.site.getThanas', ':id') }}`.replace(':id', districtId);

            fetch(url)
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
</script>


@endsection

@section('external_js')


@endsection