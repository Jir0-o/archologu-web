@extends('layouts.adminApp')

@section('title', 'Thana Creation || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Edit Thana Modal -->
    <div class="modal fade" id="editThanaModal" tabindex="-1" aria-labelledby="editThanaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editThanaModalLabel">Edit Thana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form id="editThanaForm">
                        @csrf
                        <input type="hidden" name="thana_id" id="thana_id">

                        <!-- District Dropdown -->
                        <div class="mb-3">
                            <label for="district_id" class="form-label">Select District</label>
                            <select class="form-control" id="district_id" name="district_id" required>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Thana Name -->
                        <div class="mb-3">
                            <label for="thana_name" class="form-label">Thana Name</label>
                            <input type="text" class="form-control" id="thana_name" name="thana_name" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Thana Addititon</h5> 
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.location.storeThana') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="district">Select District</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="district" name="district_id" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Thana Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Type here" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Thana</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table for Districts -->
    <div class="card mb-4"> 
        <div class="card-header">
            <h5 class="mb-0">Thana List</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>S.L</th>
                        <th>District Name</th>
                        <th>Thana Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Populate this table with data from the backend -->
                    @foreach($districts as $district)
                    @foreach($district->thanas as $thana)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $district->name }}</td>
                            <td>{{ $thana->name }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit-thana"
                                    data-thana-id="{{ $thana->id }}">
                                    Edit
                                </button>
                                <form action="#" method="POST" style="display:inline;"></form>
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" class="btn btn-sm btn-danger" id="deleteThanaBtn" data-id="{{ $thana->id }}">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
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
                duration: 5000,
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
                duration: 5000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
        });
    </script>
@endif

<script>
$(document).ready(function () {
    $('.btn-edit-thana').click(function (e) {
        e.preventDefault();

        var thanaId = $(this).data('thana-id');
        var url = "{{ route('backend.location.getThanaData', ':id') }}".replace(':id', thanaId);
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#thana_id').val(response.id);
                $('#thana_name').val(response.name);
                $('#district_id').val(response.district_id); 
                $('#editThanaModal').modal('show');
            },
            error: function () {
                alert('Error fetching thana data');
            }
        });
    });

    $('#editThanaForm').submit(function (e) {
        e.preventDefault();

        var thanaId = $('#thana_id').val();
        var thanaName = $('#thana_name').val();
        var districtId = $('#district_id').val();

        var url = "{{ route('backend.location.updateThana', ':id') }}".replace(':id', thanaId);

        $.ajax({
            url: url,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name: thanaName,
                district_id: districtId
            },
            success: function(response) {
                $('#editThanaModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Thana updated successfully.',
                }).then(() => {
                    location.reload(); 
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error updating the thana.',
                });
            }
        });
    });

    // Handle Thana Deletion
    $('#datatable').on('click', '#deleteThanaBtn', function (e) {
        e.preventDefault();

        var thanaId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ route('backend.location.deleteThana', ':id') }}".replace(':id', thanaId);
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            location.reload();
                    },
                    error: function () {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the thana.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});

</script>


@endsection