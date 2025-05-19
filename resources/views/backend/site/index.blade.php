@extends('layouts.adminApp')

@section('title', 'Home || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="pb-2">
        <a href="{{ route('backend.site.create') }}" class="btn btn-primary">Add Site</a>
    </div>
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">All Sites</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Site Name Bangla</th>
                            <th>Site Name English</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sites as $site)
                        <tr>
                            <td>{{ $site->site_name_bn }}</td>
                            <td>{{ $site->site_name_en }}</td>
                            <td>{{ $site->district->name }}, {{ $site->thana->name }}</td>
                            <td>
                                <span class="badge bg-label-{{ $site->active ? 'primary' : 'danger' }}">
                                    {{ $site->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
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

@endsection