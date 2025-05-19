@extends('layouts.adminApp')

@section('title', 'Site Gallery || Heritage In Khulna')

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
                    <h5 class="mb-0">Site Images/Videos</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.gallery.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="col-sm-2 col-form-label" for="keep_watch">Upload Images & Videos:</label>
                            <div class="col-sm-10">
                                <input type="file" name="media[]" id="media" multiple accept="image/*,video/*">
                            </div>
                        </div>
                    
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Image/Video</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->



@endsection

@section('external_js')

@endsection