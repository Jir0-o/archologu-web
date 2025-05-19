@extends('layouts.adminApp')

@section('title', 'Requested Images || Heritage In Khulna')

@section('external_css')

@endsection

<style>
    #datatable img {
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s ease;
    }

    #datatable img:hover {
        transform: scale(1.1);
    }
</style>

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabs for Image Status -->
    <ul class="nav nav-tabs" id="imageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected</a>
        </li>
    </ul>

    <div class="tab-content" id="imageTabsContent">
        <!-- Pending Tab -->
        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Pending Images</h5>
                </div>
                <div class="card-body">
                    <table id="datatable-pending" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Image</th>
                                <th>Site Name</th>
                                <th>User Name</th>
                                <th>Phone No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            @if($image->status == 0)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="Image" width="50" height="50" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td>{{ $image->site->site_name_en }}</td>
                                <td>{{ $image->user_name }}</td>
                                <td>{{ $image->phone_no }}</td>
                                <td><span class="badge bg-label-warning">Pending</span></td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="approveImage({{ $image->id }})">Approve</button>
                                    <button type="button" class="btn btn-warning" onclick="rejectImage({{ $image->id }})">Reject</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteImage({{ $image->id }})">Delete</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Approved Tab -->
        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Approved Images</h5>
                </div>
                <div class="card-body">
                    <table id="datatable-approved" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Image</th>
                                <th>Site Name</th>
                                <th>User Name</th>
                                <th>Phone No</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            @if($image->status == 1)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="Image" width="50" height="50" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td>{{ $image->site->site_name_en }}</td>
                                <td>{{ $image->user_name }}</td>
                                <td>{{ $image->phone_no }}</td>
                                <td><span class="badge bg-label-success">Approved</span></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rejected Tab -->
        <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Rejected Images</h5>
                </div>
                <div class="card-body">
                    <table id="datatable-rejected" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Image</th>
                                <th>Site Name</th>
                                <th>User Name</th>
                                <th>Phone No</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            @if($image->status == 2)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="Image" width="50" height="50" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td>{{ $image->site->site_name_en }}</td>
                                <td>{{ $image->user_name }}</td>
                                <td>{{ $image->phone_no }}</td>
                                <td><span class="badge bg-label-danger">Rejected</span></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal to view full-size image -->
    @foreach($images as $image)
    <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $image->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{ $image->id }}">Full Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $image->file_path) }}" alt="Full Image" class="img-fluid">
                    <input type="hidden" id="image_id_{{ $image->id }}" value="{{ $image->id }}">
                </div>
                @if ($image->status == 0)
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="approveImage({{ $image->id }})">Approve</button>
                    <button type="button" class="btn btn-danger" onclick="rejectImage({{ $image->id }})">Reject</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
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
                gravity: "top", 
                position: "right", 
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

        $('#datatable-pending').DataTable();
        $('#datatable-approved').DataTable();
        $('#datatable-rejected').DataTable();

        window.approveImage = function(imageId) {
            let imageIdInput = $('#image_id_' + imageId).val();

            $.ajax({
                url: "{{ route('backend.admin.approveImage', ':id') }}".replace(':id', imageId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_id: imageIdInput
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Image approved successfully!', 'success');
                        $('#imageModal' + imageId).modal('hide');
                        location.reload();
                    } else {
                        Swal.fire('Error', 'Failed to approve image.', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                }
            });
        };

        window.rejectImage = function(imageId) {
            let imageIdInput = $('#image_id_' + imageId).val();

            $.ajax({
                url: "{{ route('backend.admin.rejectImage', ':id') }}".replace(':id', imageId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_id: imageIdInput
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Image rejected successfully!', 'success');
                        $('#imageModal' + imageId).modal('hide');
                        location.reload();
                    } else {
                        Swal.fire('Error', 'Failed to reject image.', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                }
            });
        };

        //delete image
        window.deleteImage = function(imageId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let imageIdInput = $('#image_id_' + imageId).val();

                    $.ajax({
                        url: "{{ route('backend.admin.deleteImage', ':id') }}".replace(':id', imageId),
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            image_id: imageIdInput
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Success', 'Image deleted successfully!', 'success');
                                $('#imageModal' + imageId).modal('hide');
                                location.reload();
                            } else {
                                Swal.fire('Error', 'Failed to delete image.', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Cancelled', 'Your image is safe!', 'info');
                }
            });
        };
    });
</script>

@endsection