@extends('layouts.adminApp')

@section('title', 'AdminDashboard || Heritage In Khulna')

@section('external_css')
<style>
    .dashboard-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-value {
        font-size: 2em;
        font-weight: bold;
        color: #007bff;
    }
</style>
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="card-title">Sites</div>
                <div class="card-value">{{$count}}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="card-title">Well Pre. Sites</div>
                <div class="card-value">{{$wellCount}}</div> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="card-title">Critical Sites</div>
                <div class="card-value">{{$criticalCount}}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="card-title">Vulnerable Sites</div>
                <div class="card-value">{{$vulnerableCount}}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="card-title">Unknown/Other Sites</div>
                <div class="card-value">{{$unknownCount}}</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('external_js')

@endsection