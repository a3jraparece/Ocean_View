@extends('user.layout')

@section('title', 'Ocean View Resorts')
@section('css', '/css/user/resorts.css')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

    <div class="container">
        <h1 style="font-family: Calistoga, sans-serif; letter-spacing: 1px" class="mt-5 text-center text-primary">
            Reserve your favorite spot on the beach
        </h1>
<div class="input-group mt-5">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                aria-describedby="search-button" />
            <button class="btn btn-primary" type="button" id="search-button">
                <i class="bi bi-search"></i>
                Search
            </button>
        </div>

        <br />
        <hr />
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner" style="height: 100%">
                <!-- First Slide -->
                @foreach($resorts as $index=>$resort)
                <div class="carousel-item {{$index === 0 ? 'active' : ''}} col-md-12">
                    <div class="d-flex flex-wrap">
                        <div class="gradient-overlay"></div>
                        <div class="col-md-8 col-sm-12 yeah" style="position: relative;">
                            <div class="carousel-holder">
                                <img src="{{ asset('/images/resort_images/default.jpg') }}" class="" alt="..."
                                    style="width:100%;height: 300px; object-fit: cover" />
                                <div class="carousel-caption d-none d-md-block text-center">
                                    <span>{{$resort['resort_name']}}</span>
                                    <p>
                                        {{$resort['location']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="carousel-content col-md-4 col-sm-12 d-flex justify-content-center text-center bg-primary">
                            <div class="description p-3">
                                <h2>{{$resort['resort_name']}}</h2>
                                <div class="hrkunocarousel">
                                    <i class="fi fi-br-horizontal-rule"></i>
                                </div>
                                <p class="p-1" style=" pointer-events: none;">
                                    {{$resort['resort_description']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach 

                <!-- Second Slide -->
                {{-- <div class="carousel-item  col-md-12">
                    <div class="d-flex flex-wrap">
                        <div class="gradient-overlay"></div>
                        <div class="col-md-8 col-sm-12 yeah" style="position: relative;">
                            <div class="carousel-holder">
                                <img src="{{ asset('/images/resort_images/default.jpg') }}" class="" alt="..."
                                    style="width:100%;height: 300px; object-fit: cover" />
                                <div class="carousel-caption d-none d-md-block text-center">
                                    <span>Punta Verde Beaxh Resort</span>
                                    <p>
                                        Panabo Sea wall
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="carousel-content col-md-4 col-sm-12 d-flex justify-content-center text-center bg-primary">
                            <div class="description p-3">
                                <h2>Friday’s Beach Resort</h2>
                                <div class="hrkunocarousel">
                                    <i class="fi fi-br-horizontal-rule"></i>
                                </div>
                                <p class="p-1" style=" pointer-events: none;">
                                    Fridays Beach in Boracay Island, Philippines is a resort
                                    with boundless opportunities for family adventures,
                                    productive meetings, and memorable special events.
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Third Slide -->
                {{-- <div class="carousel-item  col-md-12">
                    <div class="d-flex flex-wrap">

                        <div class="col-md-8 col-sm-12 yeah" style="position: relative;">
                            <div class="gradient-overlay"></div>
                            <div class="carousel-holder">
                                <img src="{{ asset('/images/resort_images/default.jpg') }}" class="" alt="..."
                                    style="width:100%;height: 300px; object-fit: cover" />
                                <div class="carousel-caption d-none d-md-block text-center">
                                    <span>Punta Verde Beaxh Resort</span>
                                    <p>
                                        Panabo Sea wall
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="carousel-content col-md-4 col-sm-12 d-flex justify-content-center text-center bg-primary">
                            <div class="description p-3">
                                <h2>Friday’s Beach Resort</h2>
                                <div class="hrkunocarousel">
                                    <i class="fi fi-br-horizontal-rule"></i>
                                </div>
                                <p class="p-1" style=" pointer-events: none;">
                                    Fridays Beach in Boracay Island, Philippines is a resort
                                    with boundless opportunities for family adventures,
                                    productive meetings, and memorable special events.
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="navlink-container mt-3">
            <ol class="breadcrumb position-relative" style="bottom: -10px;">
                <li class="breadcrumb-item "><a href="{{ route('user.index') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Resorts</li>
            </ol>
            <hr>
        </div>
        <!-- resorts -->
        <div class="card-container">
            <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4 mt-0" id="card-row">
                @foreach ($resorts as $resort)
                    @if ($resort['status'] == 1)
                        <div class="col">
                            <div class="card" style="position: relative; overflow: hidden; height: 350px;">
                                <img src="{{ $resort['mainImage'] ? asset('/images/resort_images/' . $resort['mainImage']) : asset('/images/resort_images/default.jpg') }}"
                                    class="card-img" alt="{{ $resort['resort_name'] }}_image"
                                    style="height: 100%; width: 100%; object-fit: cover;" />
                                <div
                                    class="card-img-overlay d-flex flex-column justify-content-end  align-items-center p-0">
                                    <p class="card-title text-white  text-center p-0 "  style="background-color: rgba(0, 0, 0, .2)"> 
                                        {{ $resort['resort_name'] }}
                                    </p>
                                    <p class="card-text text-white d-flex flex-column justify-content-end  align-items-center p-1 mb-2 "  style="background-color: rgba(0, 0, 0, .2)">
                                        {{ $resort['location'] }}
                                    </p>
                                    <a href="{{ route('user.resort.details', ['resortID' => $resort['resortID']]) }}"
                                        class="text-decoration-none  visitnow-card-button bg-primary text-white p-2 mb-2 w-75 mx-auto p-md-1 p-sm-1 text-center">
                                        Visit now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script> --}}
@endsection
