@extends('user.layout')

@section('title', $resort['resort_name'] . ' | Available Rooms')
@section('css', '/css/user/resort_room_list.css')

@section('content')
    <div id="userImageView">
        <div id="userImageViewContainer">
            <img src="{{ asset('/images/room_images/default.jpg') }}" alt="" id="imageToSwap">
            <div><img src="{{ asset('/images/icons/user/close.png') }}" alt="" width="30px" onclick="closeImageView()"
                    style="cursor: pointer"></div>
        </div>
    </div>

    <p style="padding:20px 0 0 20px;  text-transform: uppercase; font-size:14px;">
        <a href="{{ route('user.index') }}" style="text-decoration:none;">Home</a>/
        <a href="{{ route('user.resorts') }}" style="text-decoration:none;">Resorts</a>/
        <a href="{{ route('user.resort.details', ['resortID' => $resort['resortID']]) }}"
            style="text-decoration:none;">{{ $resort['resort_name'] }}</a>|
        <span style="color:rgb(0, 0, 0)">Available rooms</span>
    </p>

    {{-- I THINK MAS NICE OG BUTANGAN PUG MURAG TABLE FOR MGA ROOMS NA OCCUPIED --}}

    @if (session()->has('booking_success') && session('booking_success') == true)
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById('bookingreadyProcess').showModal();
                document.body.classList.add("no-scroll");
            });
        </script>
    @endif

    @if (session()->has('booking_success') && session('booking_success') == false)
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById('bookingreadyProcessFailed').showModal();
                document.body.classList.add("no-scroll");
            });
        </script>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="row g-2 mb-3">
        <div class="col-md-4">
            <div class="container mt-1">
                <form action="{{ route('resort_available_rooms', ['resortID' => $resort['resortID']]) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="card p-3">
                        <iframe class="mb-2" src="{{ $resort['location_coordinates'] }}" width="100%" height="300"
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <h5 class="mb-4">Filter by:</h5>
                        <!-- Budget Slider -->
                        <div class="mb-3">
                            <label for="budgetRange" class="form-label range-label">Your budget (per night)</label>
                            <input type="range" class="form-range update_input" id="budgetRange" min="4000"
                                max="40000" step="1000" value="4000" oninput="updateBudgetValue(this.value)"
                                disabled>
                            <div class="slider-value">₱4,000 - ₱40,000+</div>
                        </div>

                        <input type="hidden"
                            value="{{ isset($bookingPreferenceInputs['startDateInput']) ? $bookingPreferenceInputs['startDateInput'] : null }}"
                            name="currentStartDate" id="currentStartDate">
                        <input type="hidden"
                            value="{{ isset($bookingPreferenceInputs['daysOfStay']) ? $bookingPreferenceInputs['daysOfStay'] : null }}"
                            name="currentDaysOfStay" id="currentDaysOfStay">

                        <div class="row g-2 mb-3">
                            <div class="col-md-7">
                                <label for="checkinDate" class="form-label ">Check-in</label>
                                <input type="date" id="checkinDate" class="form-control update_input" name="start_date"
                                    disabled {{-- value="{{ isset($bookingPreferenceInputs['startDate']) ? $bookingPreferenceInputs['startDate'] : today() }}" --}}
                                    value="{{ isset($bookingPreferenceInputs['startDate']) ? \Carbon\Carbon::parse($bookingPreferenceInputs['startDate'])->format('Y-m-d') : \Carbon\Carbon::today()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-5">
                                <label for="daysOfStay" class="form-label">Days of Stay</label>
                                <input type="number" name="daysOfStay" id="daysOfStay" class="form-control update_input"
                                    placeholder="" min="1"
                                    value="{{ isset($bookingPreferenceInputs['daysOfStay']) ? $bookingPreferenceInputs['daysOfStay'] : 1 }}"
                                    required disabled>
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label for="floorSelect" class="form-label">Floor</label>
                                <select id="floorSelect" class="form-select update_input" disabled>
                                    <option value="all" selected>All</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="roomNumberSelect" class="form-label">Room Number</label>
                                <select id="roomNumberSelect" class="form-select update_input" disabled>
                                    <option value="all" selected>All</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="roomTypeSelect" class="form-label">Room Type</label>
                                <select id="roomTypeSelect" class="form-select update_input" disabled>
                                    <option value="all" selected>All</option>
                                    <option value="King Size Bed">King Size Bed</option>
                                    <option value="Queen Size Bed">Queen Size Bed</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Double">Double</option>
                                    <option value="Suite">Suite</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="maxGuests" class="form-label">Max Guests</label>
                                <input type="number" id="maxGuests" class="form-control update_input"
                                    placeholder="Enter a number" value="5" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="checkbox" name="consent" id="consent" checked>
                            <span>By proceeding or selecting this option, you consent to the use of this form for submitting
                                your booking details, or for future reference in connection with your booking.</span>
                            <button class="btn btn-success w-100 mt-3" disabled id="updated_button">Update
                                Preference</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="container my-4">
                @if (isset($bookingPreferenceInputs))
                    <hr>
                    <div class="d-flex justify-content-center">
                        <span>
                            {{ \Carbon\Carbon::parse($bookingPreferenceInputs['startDate'])->format('F j, Y') }} -
                            {{ \Carbon\Carbon::parse($bookingPreferenceInputs['endDate'])->format('F j, Y') }}
                        </span>
                    </div>
                    <hr>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3 p-1">
                    <span style="font-size:20px">Avaliable Rooms</span>
                    <a href="{{ route('resort_available_rooms_view', ['resortID' => $resort['resortID']]) }}"
                        style="text-decoration: none" target="_blank">View available rooms</a>
                </div>

                @if (isset($availableRooms) && $availableRooms->isNotEmpty())
                    @php
                        $withAvailableRooms = false;
                    @endphp
                    @foreach ($availableRooms as $room)
                        @if ($room['status'] != 0)
                            @php
                                $withAvailableRooms = true;
                            @endphp
                            {{-- @if (true) --}}
                            <div class="container my-4">
                                <div class="room-card row p-2 g-2 d-flex align-items-center">
                                    <div class="col-md-5">
                                        <img src="{{ isset($room['room_image']) ? asset('images/room_images/' . $room['room_image']) : asset('images/room_images/default.jpg') }}"
                                            alt="Room Image" id="roomImg" class="h-100"
                                            style="max-height: 220px; border-radius:5px;cursor:pointer;"
                                            onclick="viewImage(this)">
                                    </div>
                                    <div class="col-md-7 g-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5>Room ID: {{ $room['roomID'] }}</h5>
                                                <hr>
                                            </div>
                                            <div class="col-md-8 d-flex flex-column justify-content-between">
                                                <p class="room-details">
                                                    {{ $room['description'] }}
                                                </p>
                                                <div class="col-lg-8">
                                                    </button>
                                                    <button type="button"
                                                        style="border: none; border-radius:5px; color:rgb(5, 5, 221); padding:1.5px 7px"
                                                        class="openRoomInfoButton" data-room="{{ json_encode($room) }}"
                                                        data-room_rate="{{ json_encode($room_rate) }}"
                                                        data-resort = "{{ json_encode($resort) }}">
                                                        View Details
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-3 mt-md-0 text-md-end col-md-4">
                                                <p class="price">₱
                                                    @php
                                                        $roomTypes = [
                                                            'King Size Bed' => 1.2,
                                                            'Queen Size Bed' => 1.15,
                                                            'Suite' => 1.1,
                                                            'Double Bed' => 1.05,
                                                            'Single Bed' => 1.0,
                                                        ];
                                                    @endphp
                                                    @if ($room['room_type'])
                                                        {{ number_format($room_rate * $roomTypes[$room['room_type']], 2) }}
                                                    @endif
                                                </p>
                                                <p class="capacity">Capacity - {{ $room['capacity'] }}</p>
                                                <span
                                                    class="badge bg-secondary mb-2 w-100 p-2">{{ $room['room_type'] }}</span>
                                                <button type="button"
                                                    class="btn btn-book bg-primary text-light w-100 openRoomBookNowButton"
                                                    data-resort = "{{ json_encode($resort) }}"
                                                    data-room="{{ json_encode($room) }}"
                                                    data-room_rate="{{ $room_rate }}"
                                                    data-user="{{ json_encode(session('guest')) }}"
                                                    data-loginURL = "{{ route('login.user') }}"
                                                    data-events="{{ json_encode($events) }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if (!$withAvailableRooms)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            No available rooms for the selected dates.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @else
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle"></i>
                        <p>Booking preferences may not have been updated yet.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('user.dialog.roomOpenModalBooking')
    @include('user.dialog.bookingOpenModal')

    <script src="/js/user/resort_room_list.js"></script>

@endsection
