@extends('layouts.adminApp')

@section('title', 'All Messages || Heritage In Khulna')

@section('external_css')

@endsection

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Bordered Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-white">#SL</th>
                            <th class="text-white">User Name</th>
                            <th class="text-white">User Email</th>
                            <th class="text-white">Subject</th>
                            <th class="text-white">Message</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $ind => $message)
                            <tr>
                                <td>{{ $ind + 1 }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td>

                                <td>
                                    <div class="d-flex gap-3">
                                        <a class="btn btn-primary" href="">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-danger" href="">
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

@endsection