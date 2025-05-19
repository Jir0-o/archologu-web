@extends('layouts.app')



@section('title', 'Search || Heritage In Khulna')



@section('external_css')



<style>

    .grid-body-items {

        gap: 16px;

        display: grid;

        grid-template-columns: repeat(4, 1fr);

    }



    .grid-left .grid-item-1 { grid-area: 1 / 1 / 7 / 3; }

    .grid-left .grid-item-2 { grid-area: 1 / 3 / 7 / 4; }

    .grid-left .grid-item-3 { grid-area: 1 / 4 / 7 / 5; }

    .grid-left .grid-item-4 { grid-area: 7 / 1 / 13 / 2; }

    .grid-left .grid-item-5 { grid-area: 7 / 2 / 13 / 3; }

    .grid-left .grid-item-6 { grid-area: 7 / 3 / 13 / 5; }



    .grid-right .grid-item-1 { grid-area: 1 / 1 / 7 / 2; }

    .grid-right .grid-item-2 { grid-area: 1 / 2 / 7 / 3; }

    .grid-right .grid-item-3 { grid-area: 1 / 3 / 7 / 5; }

    .grid-right .grid-item-4 { grid-area: 7 / 1 / 13 / 3; }

    .grid-right .grid-item-5 { grid-area: 7 / 3 / 13 / 4; }

    .grid-right .grid-item-6 { grid-area: 7 / 4 / 13 / 5; }



    .place-heading {

        width: 100%;

        height: 68px;

        overflow: hidden;

        display: -webkit-box;

        -webkit-line-clamp: 2;

        text-overflow: ellipsis;

        -webkit-box-orient: vertical;

    }



    @media (min-width: 768px) and (max-width: 991px) {

        .grid-body-items {

            grid-template-columns: repeat(2, 1fr);

        }

    

        .grid-item-1 { grid-area: auto !important; }

        .grid-item-2 { grid-area: auto !important; }

        .grid-item-3 { grid-area: auto !important; }

        .grid-item-4 { grid-area: auto !important; }

        .grid-item-5 { grid-area: auto !important; }

        .grid-item-6 { grid-area: auto !important; }

    }



    @media (max-width: 767px) {

        .grid-body-items {

            display: block;

        }

    }



    .place-heading a {

        text-decoration: none;

        color: inherit;

        transition: all 0.3s ease;

    }



    .place-heading a:hover {

        color: #ff6347;  /* Change color on hover */

        text-decoration: underline;

    }



    /* Search Css */



    /* Search Box Styling */

    .search-box {

        display: flex;

        justify-content: center;

        align-items: center;

        margin-top: 40px;

        margin-bottom: 40px;

    }



    .search-box .input-form {

        width: 70%;

        outline: none;

        border: 1px solid #524b4b;

        position: relative;

    }



    .search-box input[type="text"] {

        width: 100%;

        padding: 12px 20px;

        font-size: 16px;

        border: 1px solid #524b4b;

        border-radius: 5px;

        outline: none;

        transition: border-color 0.3s ease;

    }



    .search-box input[type="text"]:focus {

        border-color: #ff6347; /* Add a color to the input field on focus */

    }



    .search-box .search-btn {

        background-color: #ff6347;

        color: white;

        font-size: 16px;

        padding: 12px 25px;

        border: none;

        border-radius: 5px;

        cursor: pointer;

        transition: background-color 0.3s ease;

    }



    .search-box .search-btn:hover {

        background-color: #e5533e; /* Darker shade on hover */

    }

    

    .search-results {

        display: flex;

        flex-wrap: wrap;

        justify-content: center;

        margin-top: 20px;

        margin-bottom: 20px;

    }

    .search-results .grid-left {

    display: flex;

    flex-wrap: wrap;

    gap: 20px;

    justify-content: space-between;

    }



    /* search dropdown */

.search-dropdown {

    position: absolute;

    width: 73%;

    background: white;

    border: 1px solid #ccc;

    list-style: none;

    padding: 0;

    margin: 0;

    max-height: 150px;

    overflow-y: auto;

    display: none;

    z-index: 10;

}



.search-dropdown .search-item {

    padding: 8px;

    cursor: pointer;

    border-bottom: 1px solid #eee;

}



.search-dropdown .search-item:hover {

    background: #f1f1f1;

}

</style>



@endsection



@section('content')

<!-- slider Area Start-->

<div class="slider-area ">

    <div class="single-slider slider-height2 d-flex align-items-center"

        data-background="{{ asset('frontend_assets/img/hero/about.jpg') }}">

        <div class="container">

            <div class="row">

                <div class="col-xl-12">

                    <div class="hero-cap text-center">

                        <h2>Search Results</h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- slider Area End-->



<!-- Search Box -->

<div class="row" id="searchContainer">

    <div class="col-xl-12">

        <form id="searchForm" action="{{ route('frontend.search.sites') }}" method="get" class="search-box">

            <div class="input-form mb-30 w-[80%]">

                <input type="text" id="searchInput" name="query" 

                    placeholder="When would you like to go?" 

                    autocomplete="off"

                    value="{{ request('query') }}">

                <ul id="searchDropdown" class="search-dropdown"></ul>

            </div>

            <div class="search-form mb-30">

                <button type="submit" class="search-btn">Search</button>

            </div>

        </form>

    </div>

</div>



<!-- Search Results Start -->

<section class="search-results">

    <div class="container grid-left">

        <legend class="fieldset-legend w-auto px-3 font-bold">

            <i>Search Results</i>

        </legend>

        <div class="grid-body-items"> 

            @if ($sites->count() == 0)

                <div class="grid-item grid-item-1">

                    <div class="single-place mb-30">

                        <div class="place-cap">

                            <h3>No Data Found</h3>

                            <p>No sites match your search query.</p>

                        </div>

                    </div>

                </div>

            @else

                @foreach ($sites as $site)

                    <div class="grid-item grid-item-{{$loop->iteration}}">

                        <div class="single-place mb-30">

                            <div class="place-img">

                                <img class="w-100 h-[250px] object-cover"

                                     src="{{ asset('storage/' . ($site->thumbnail ?? 'default.jpg')) }}" alt="Thumbnail" loading="lazy">

                            </div>

                            <div class="place-heading">

                                <h3>

                                    <a href="{{ route('frontend.show.place', ['id' => $site->id]) }}">

                                        {{$site->site_name_en}} - {{$site->thana->name}}, {{$site->district->name}}

                                    </a>

                                </h3>

                                <p>{{$site->district->name}}</p>

                            </div>

                            <div class="place-cap-bottom">

                                <p class="m-0">Historical Site</p>

                            </div>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>

    </div>

</section>

<!-- Search Results End -->



@endsection



@section('external_js')



<script>

    $(document).ready(function() {



    let searchHistory = JSON.parse(localStorage.getItem('searchHistory')) || [];



    function showSearchDropdown() {

        let dropdown = $('#searchDropdown');

        dropdown.empty(); 

        

        if (searchHistory.length > 0) {

            searchHistory.forEach(query => {

                dropdown.append(`<li class="search-item">${query}</li>`);

            });

            dropdown.show();

        }

    }



    $('#searchInput').on('focus', function() {

        showSearchDropdown();

    });



    $(document).on('click', function(e) {

        if (!$(e.target).closest('#searchContainer').length) {

            $('#searchDropdown').hide();

        }

    });



    $(document).on('click', '.search-item', function() {

        $('#searchInput').val($(this).text());

        $('#searchDropdown').hide();

    });



    $('#searchForm').on('submit', function(e) {

        let query = $('#searchInput').val().trim();

        if (query && !searchHistory.includes(query)) {

            searchHistory.unshift(query); 

            if (searchHistory.length > 5) searchHistory.pop(); 

            localStorage.setItem('searchHistory', JSON.stringify(searchHistory));

        }

    });

});

</script>



@endsection

