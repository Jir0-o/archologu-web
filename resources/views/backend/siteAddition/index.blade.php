@extends('layouts.adminApp')

@section('title', 'All Sites || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="pb-2">
        <a href="{{ route('backend.siteAddition.create') }}" class="btn btn-primary">Add Site</a>
    </div>
    <!-- Bordered Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-white">#SL</th>
                            <th class="text-white">Site Name</th>
                            <th class="text-white">District</th>
                            <th class="text-white">Thana</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Location</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sites as $ind => $site)
                            <tr>
                                <td>{{ $ind + 1 }}</td>
                                <td>{{ $site->name }}</td>
                                <td>{{ $site->district->name }}</td>
                                <td>{{ $site->thana->name }}</td>
                                <td>
                                    <span class="badge bg-label-{{ $site->active ? 'primary' : 'danger' }}">
                                        {{ $site->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ $site->map_url }}">View Map</a>
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a class="btn btn-primary" href="{{ route('backend.siteAddition.view', ['id' => $site->id]) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-warning" href="{{ route('backend.siteAddition.edit', ['id' => $site->id]) }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger delete-btn" data-url="{{ route('backend.siteAddition.delete', ['id' => $site->id]) }}">
                                            <i class="fa-solid fa-trash"></i>                                    
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->   
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
                duration: 2000,
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
                duration: 2000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
        });
    </script>
@endif

<script>
    $(document).ready(function() {
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault(); 

        let deleteUrl = $(this).data('url');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl; 
            }
        });
    });
});
</script>

@endsection