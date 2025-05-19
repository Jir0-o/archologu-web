@extends('layouts.adminApp')

@section('title', 'District Creation || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Edit District Modal -->
    <div class="modal fade" id="editDistrictModal" tabindex="-1" aria-labelledby="editDistrictModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDistrictModalLabel">Edit District</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form id="editDistrictForm">
                        @csrf
                        <input type="hidden" name="id" id="district_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">District Name</label>
                            <input type="text" class="form-control" id="district_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
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
                    <h5 class="mb-0">District Addition</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.location.storeDistrict') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">District Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Type here" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add District</button>
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
            <h5 class="mb-0">Districts List</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>S.L</th>
                        <th>District Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Populate this table with data from the backend -->
                    @foreach($districts as $district)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $district->name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-id="{{ $district->id }}">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-sm btn-danger" id="deleteDistrictBtn" data-id="{{ $district->id }}">Delete</a>
                            </form>
                        </td>
                    </tr>
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
    $(document).ready(function() {
        $('.btn-warning').click(function(e) {
            e.preventDefault(); 
    
            var districtId = $(this).data('id');
            
            var url = "{{ route('backend.location.getDistrictData', ':id') }}".replace(':id', districtId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#district_id').val(response.id);
                    $('#district_name').val(response.name);
                    $('#editDistrictModal').modal('show');
                },
                error: function() {
                    alert('Error fetching district data');
                }
            });
        });
    
        $('#editDistrictForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
    
            var districtId = $('#district_id').val();
            var name = $('#district_name').val();

            var url = "{{ route('backend.location.updateDistrict', ':id') }}".replace(':id', districtId);
            
            // Send updated data via AJAX
            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: districtId,
                    name: name
                },
                success: function(response) {
                    $('#editDistrictModal').modal('hide');
                        Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'District updated successfully.',
                    }).then(() => {
                        location.reload(); // Optionally reload the page to reflect the changes
                    });
                },
                error: function() {
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong while updating the district.',
                    });
                }
            });
        });
    
        $('#deleteDistrictBtn').click(function(e) {
            e.preventDefault();

            var districtId = $(this).data('id');
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
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('backend.location.deleteDistrict', ':id') }}".replace(':id', districtId),
                        method: 'DELETE',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            location.reload();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the district.',
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