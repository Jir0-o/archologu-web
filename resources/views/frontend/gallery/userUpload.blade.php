@extends('layouts.app')



@section('title', 'My Uploads || Heritage In Khulna')



@section('external_css')



@endsection



@section('content')



<!-- Contact Form Section -->

<section class="contact-section">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h2 class="contact-title">Uploads</h2>

            </div>



            <!-- Search by Phone Number -->

            <div class="col-12 mb-3">

                <form id="searchForm" action="{{ route('frontend.contact.search') }}" method="GET">

                    <div class="form-group">

                        <label for="searchPhone">Search by Phone Number</label>

                        <input type="text" class="form-control" id="searchPhone" name="phone" placeholder="Enter Phone Number" value="{{ request()->input('phone') }}">

                        <button type="submit" class="btn btn-primary mt-2">Search</button>

                    </div>

                </form>

            </div>



            <!-- DataTable for Search Results -->

            <div class="col-12">

                @if(request()->has('phone') && !empty(request()->input('phone')) && $contacts->count() > 0)

                    <!-- Only show if there are search results -->

                    <table id="searchResultsTable" class="table table-striped table-bordered">

                        <thead>

                            <tr>

                                <th>S.L</th>

                                <th>Image</th>

                                <th>Name</th>

                                <th>Phone Number</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($contacts as $contact)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#imageModal{{ $contact->id }}">

                                            <img src="{{ asset('storage/' . $contact->file_path) }}" alt="Image" width="50" height="50" style="object-fit: cover;">

                                        </a>

                                    </td>

                                    <td>{{ $contact->user_name }}</td>

                                    <td>{{ $contact->phone_no }}</td>

                                    <td>

                                        @if ($contact->status == 0)

                                            <span class="badge bg-label-warning">Pending</span>

                                        @elseif ($contact->status == 1)

                                            <span class="badge bg-label-success">Approved</span>

                                        @elseif ($contact->status == 2)

                                            <span class="badge bg-label-danger">Rejected</span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                    
                    @elseif(request()->has('phone') && !empty(request()->input('phone')) && $contacts->isEmpty())

                    <p>No photos found for the given phone number.</p>

                @endif

            </div>

        </div>

    </div>

</section>







<!-- contact form end -->



@endsection



@section('external_js')



<script>

    $(document).ready(function() {

        if ($('#searchResultsTable').length > 0) {

            $('#searchResultsTable').DataTable();

        }

    });

</script>

@endsection