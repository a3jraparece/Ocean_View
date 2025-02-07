@extends('user.layout')

@section('title', $resort['resort_name'])
@section('css', '/css/user/resort_details.css')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    @if (session('commentSuccess'))
        <script>
            {{ session('commentSuccess') }}
        </script>
    @endif

    <div id="resortbg" style="background-image: url('{{ asset('/images/resort_images/' . $resort['mainImage']) }}')">
        <div class="resort position-absolute top-50 p-3 start-50 translate-middle text-center">
            <h1 class="resortname">{{ $resort['resort_name'] }}</h1>
            <h3 class="resortlocation text-center">{{ $resort['location'] }}</h3>
        </div>
    </div>
    <br />
    <br />

    <div class="navlink-container col-12 col-md-10 offset-md-1">
        <span style="padding:20px 0 0 20px;  text-transform: uppercase; font-size:14px;">
            <a href="{{ route('user.index') }}" style="text-decoration:none;">Home</a>/
            <a href="{{ route('user.resorts') }}" style="text-decoration:none;">Resorts</a>/
            <span style="color:rgb(0, 0, 0);">{{ $resort['resort_name'] }}</span>
        </span>
        <hr />
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Left -->
            <div class="col-md-6">
                <div class="d-flex">
                    <h1 class="beachname">{{ $resort['resort_name'] }}</h1>
                    <a href="#" class="d-flex ms-auto">
                        @if (session('guest'))
                            <form action="{{ route('user.add_bookmarks') }}" method="POST">
                                @csrf
                                <input type="hidden" name="guestID" value="{{ session('guest')['guestID'] }}">
                                <input type="hidden" name="resortID" value="{{ $resort['resortID'] }}">
                                <button type="submit" style="border: none; background: none;">
                                    <img src="{{ $bvs == 0 ? asset('/images/icons/user/heart (1).png') : asset('/images/icons/user/heart (2).png') }}"
                                        alt="Bookmark" style="width: 30px; height: 30px;">
                                </button>
                            </form>
                        @else
                            <button style="border: none" onclick="sample()">
                                <img id="heart" src="{{ asset('/images/icons/user/heart (1).png') }}" alt="Bookmark"
                                    style="width: 30px; height: 30px;">
                            </button>
                        @endif
                    </a>
                </div>

                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="height: 400px">
                        <div class="carousel-item active ">
                            <img src="{{ asset('/images/resort_images/' . $resort['image1']) }}" class="d-block w-100"
                                style="height: 400px; object-fit:cover" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/images/resort_images/' . $resort['image1_2']) }}" class="d-block w-100"
                                style="height: 400px; object-fit:cover" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/images/resort_images/' . $resort['image1']) }}" class="d-block w-100"
                                style="height: 400px; object-fit:cover" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                    </div>
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
                <div class="row mt-1 ms-0 me-0 g-3">
                    <div class="col-md-6 ps-0">
                        <img src="{{ asset('/images/resort_images/' . $resort['image2']) }}" class="d-block h-100 w-100"
                            alt="..." />
                    </div>
                    <div class="col-md-6 pe-0">
                        <img src="{{ asset('/images/resort_images/' . $resort['image3']) }}" class="d-block h-100 w-100 "
                            alt="..." />
                    </div>
                </div>
                <div class="resort-description mt-4" style="letter-spacing: 1px;">
                    <p>{{ $resort['resort_description'] }}</p>
                </div>
                <div class="amenities mt-5">

                    @php
                        $amenities = !empty($resort['amenities']) ? explode('|', $resort['amenities']) : [];
                    @endphp

                    <div class="row mt-5">
                        <h3 style="font-family: Calistoga, sans-serif; font-size: 25;">Amenities</h3>
                        <div class="container">

                            @isset($amenities)
                                <ul class="row list-styled">
                                    @foreach ($amenities as $amenity)
                                        <div class="col-sm-6 mt-3 ">
                                            @php
                                                $amenityData = explode('/', $amenity);
                                                echo "<strong> $amenityData[0]</strong>";
                                                $amenityLists = explode(',', $amenityData[1]);
                                                for ($i = 0; $i < count($amenityLists); $i++) {
                                                    echo "<li class='col-md-6 col-sm-6'>  $amenityLists[$i]</li>";
                                                }
                                            @endphp
                                        </div>
                                    @endforeach
                                @endisset
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <br />
            <!-- Right -->
            <div class="col-md-6">
                <h1 class="beachname">Location</h1>
                <div class="col-md-12 pe-0">
                    <iframe class="mb-2" src="{{ $resort['location_coordinates'] }}" width="100%" height="300"
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <br>
                <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('/images/resort_images/' . $resort['room_image_1']) }}"
                                class="d-block w-100" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/images/resort_images/' . $resort['room_image_2']) }}"
                                class="d-block w-100" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/images/resort_images/' . $resort['room_image_3']) }}"
                                class="d-block w-100" alt="..." />
                            <div class="gradient-overlay"></div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="room-description mt-3" style="letter-spacing: 1px;">
                    <p>{{ $resort['room_description'] }}</p>
                </div>
                <div class="text-end">
                    <span class="availability bg-primary p-2" style="border-radius:20px ; cursor: pointer;">
                        <a href="{{ route('user.resort.rooms', ['resortID' => $resort['resortID']]) }}"
                            class="text-white text-decoration-none">See Availability</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
        <div class="row">
            <h1 style="font-family: Calistoga, sans-serif;font-size: 30px;letter-spacing: 0.1rem;">
                Guest Reviews</h1>
            <div class="rating d-flex">
                <span class="rate bg-primary px-3 py-1 rounded text-white">
                    <p class="mt-1 mb-1">{{ $reviewsAverage }}</p>
                </span>
                <p class="mx-2 mt-2">out of</p>
                <span class="rate bg-primary px-3 py-1 rounded text-white">
                    <p class="mt-1 mb-1">5</p>
                </span>
                <ul class="mt-2">
                    <li>{{ $reviewsCount }} reviews</li>
                </ul>
            </div>

            {{-- <button onclick="addCard()">Add Card</button> --}}
            <div class="row card-container row-cols-1 row-cols-md-3 row-cols-sm-2 g-4" id="card-container">
                @foreach ($reviews as $review)
                    <div class="col">
                        <div class="card" style="min-height: 240px">
                            <div class="userinfo d-flex" style="background-color: rgba(183, 183, 183, 0.2)">
                                <img src="otenialex/logo.jpg" alt="" class="rounded-circle  p-3"
                                    style="height: 60px; width: 60px;">
                                <div class="nameofUser ps-4 pt-2">
                                    <h6 class="card-subtitle mt-0 text-muted ms-2">{{ $review['guest']['f_name'] }} </h6>
                                    <h7 class="card-subtitle mb-1 text-muted ms-2">{{ $review['reviewDate'] }}</h7>
                                    <p>
                                        @for ($i = 0; $i < $review['rating']; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = 5 - $review['rating']; $i > 0; $i--)
                                            <i class="fa fa-star text-secondary"></i>
                                        @endfor
                                    </p>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <p class="card-text">
                                    {!! nl2br($review['comment']) !!}
                                </p>
                                <p class="card-link text-primary seemore" id="">See more</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="mt-5 text-center" style="background-color: rgb(13, 110, 250); padding: 10px 20px; color:white">Write a
            review</h3>
        <div class="write-review text-center">
            <div class="bg-danger text-start">
                @if ($errors->any())
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li class="p-2 text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @php
                if (session()->has('guest')) {
                    foreach ($reviews as $review) {
                        if (session('guest')['guestID'] == $review['guestID']) {
                            $guest_review = $review;
                            break;
                        }
                    }
                }
            @endphp

            @if (isset($guest_review))
                <form action="{{ route('user.update_review') }}" method="POST"
                    onsubmit="return confirm('Are you sreu you want to update your comment?')">
                    @csrf
                    @method('PUT')

                    <input type="hidden" value="{{ session('guest')['guestID'] }}" name="guestID">
                    <input type="hidden" name="reviewID" value="{{ $guest_review['reviewID'] }}">
                    <input type="hidden" name="resortID" id="resortID" value="{{ $resort['resortID'] }}">
                    <input type="hidden" name="rating" id="formRating" value="1">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label h6">Star Rating</label>
                        <div class="star-rating">
                            @for ($i = 0; $i < $guest_review['rating']; $i++)
                                <i class="fa fa-star checked" data-index="{{ $i + 1 }}"></i>
                            @endfor
                            @for ($i = $guest_review['rating']; $i < 5; $i++)
                                <i class="fa fa-star" data-index="{{ $i + 1 }}"></i>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label for="" class="form-label h6">Name</label>
                        <input type="text" class="form-control review w-50" placeholder="Enter your name" disabled
                            value="{{ session('guest')['f_name'] }} {{ session('guest')['m_name'] }} {{ session('guest')['l_name'] }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label h6">Review Comment</label>
                        <textarea class="form-control review w-50" id="exampleFormControlTextarea1" placeholder="Write your comments here"
                            rows="3" name="comment">{{ $guest_review['comment'] }}</textarea>
                    </div>

                    <div class="review">
                        <p>
                            How we use your data: We’ll only contact you about the review you left, and only if
                            necessary.
                            By submitting your review, you agree to Ocean View's terms, privacy and content policies.
                        </p>
                        <button type="submit" class="btn btn-success mb-3 w-100">Update</button>
                    </div>
                </form>

                <form action="{{ route('user.remove_review') }}" method="POST"
                    onsubmit="return confirm('Are you sreu you want to delete your comment?')">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="reviewID" value="{{ $guest_review['reviewID'] }}">
                    <input type="hidden" name="resortID" id="resortID" value="{{ $resort['resortID'] }}">
                    <button type="submit" class="btn btn-danger mb-3 w-50">Delete</button>
                </form>
            @else
                <form action="{{ route('user.add_review') }}" method="POST" id="addReviewForm">
                    @csrf
                    @method('post')

                    @if (session('guest'))
                        <input type="hidden" value="{{ session('guest')['guestID'] }}" name="guestID">
                    @endif
                    <input type="hidden" name="resortID" id="resortID" value="{{ $resort['resortID'] }}">
                    <input type="hidden" name="rating" id="formRating" value="1">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label h6">Star Rating</label>
                        <div class="star-rating">
                            <i class="fa fa-star checked" data-index="1"></i>
                            <i class="fa fa-star" data-index="2"></i>
                            <i class="fa fa-star" data-index="3"></i>
                            <i class="fa fa-star" data-index="4"></i>
                            <i class="fa fa-star" data-index="5"></i>
                        </div>
                    </div>

                    <div class="mb-3 mt-2">
                        <label for="exampleFormControlTextarea1" class="form-label h6">Review Comment</label>
                        <textarea class="form-control review w-50" id="exampleFormControlTextarea1" placeholder="Write your comments here"
                            rows="3" name="comment" required>{{ old('comment') }}</textarea>
                    </div>

                    <div class="review">
                        <p>
                            How we use your data: We’ll only contact you about the review you left, and only if
                            necessary.
                            By submitting your review, you agree to Ocean View's terms, privacy and content policies.
                        </p>

                        <button type="button" class="btn btn-primary mb-3 w-100"
                            onclick="checkLoginAndSubmit({{ session('guest') ? 'true' : 'false' }})">Send</button>
                </form>
            @endif
        </div>
    </div>

    <script>
        function sample() {
            alert("You must login first to bookmark a resort.");
        }
    </script>

    <script src="{{ asset('/js/user/resort_details.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

@endsection
