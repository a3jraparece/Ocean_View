<dialog id="roomOpenModalBooking">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="card shadow rounded-0" style="position: relative">
                    <img src="" alt="Room Image" class="card-img-top" id="room_image"
                        style="width: 100%; height: auto;" >
                    <button type="button" class="btn btn-book bg-primary text-light w-50 openRoomBookNowButton"
                        data-resort = "{{ json_encode($resort) }}" data-room_rate="{{ $room_rate }}"
                        data-user="{{ json_encode(session('guest')) }}" data-loginURL = "{{ route('login.user') }}"
                        data-events="{{ json_encode($events) }}"
                        style="position: absolute; bottom:0px; left:50%; transform:translate(-50%, -50%)">
                        Book Now
                    </button>
                </div>
            </div>
        </div>
        <!-- Room Details -->
        <div class="row g-0 mt-4 px-4">
            <div class="col-12">
                <!-- Room Title -->
                <h2 class="" id="roomID">Room 10</h2>
                <p class="text-muted text-center" id="room_description">
                    Satisfy your eyes with the postcard-worthy beauty of Resort Name, and satiate your palates with
                    sumptuous buffet meals that reflect Mindanao’s colorful culture.
                </p>

                <!-- Inclusions -->
                <h5 class="mt-4"><b>Inclusions</b></h5>
                <ul id="inclusions" class="d-flex flex-wrap">

                </ul>

                <!-- Payment Policy -->
                <h5 class="mt-4"><b>Payment Policy</b></h5>
                <h6><b>Full Payment</b></h6>
                <ul>
                    <li>The total payment will be immediately deducted in full from your E-wallet upon completion of the
                        transaction.</li>
                </ul>
                <h6><b>Down Payment</b></h6>
                <ul>
                    <li>In order to complete the reservation, a 50% down payment will be deducted first from your
                        account’s E-wallet.</li>
                    <li>50% of the payment will be deducted automatically on your account’s wallet 3 days prior to the
                        check-in date.</li>
                </ul>

                <!-- Cancellation Policy -->
                <h5 class="mt-4"><b>Cancellation Policy</b></h5>
                <ul>
                    <li>If the reservation is canceled seven (7) or more days before the check-in date, there will be a
                        50% refund.</li>
                    <li>If the reservation is canceled three (3) to six (6) days before the check-in date, there will be
                        a 25% refund.</li>
                    <li>There will be no refund for cancellations made two (2) days or less before the check-in date.
                    </li>
                </ul>

                <!-- Check-in & Room Capacity -->
                <h5 class="mt-4"><b>Check-in Policy</b></h5>
                <ul>
                    <li>Check-in Time: 2:00 PM</li>
                    <li>Check-out Time: 12:00 PM</li>
                </ul>

                <h5 class="mt-4">Maximum Room Capacity</h5>
                <div class="row g-0">
                    <div class="col-6">
                        <ul>
                            <li id="capacity"></li>
                        </ul>
                    </div>
                </div>

                <h5 class="mt-4">Amenities:</h5>
                <ul id="amenities" class="d-flex flex-wrap">
                </ul>

                <div class="row  g-3">
                    <div class="col-sm-6">
                        <h5 class="mt-4">Discount</h5>
                        <table class="table table-bordered">
                            <tr>
                                <td>Special Days</td>
                                <td>8%</td>
                            </tr>
                            <tr>
                                <td>long Stay</td>
                                <td>
                                    2%(weeks)
                                    upto 20%
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mt-4">Room Rates</h5>
                        <table class="table table-bordered">
                            <tr>
                                <td>Price per Night </td>
                                <td>₱{{ $room_rate }}</td>
                            </tr>
                            <tr>
                                <td id="room_type"></td>
                                <td id="room_percentage"></td>
                            </tr>
                            <tr>
                                <td>Sub-Total</td>
                                <td id="sub-total"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mt-3">Booking fees and taxes</h5>
                        <table class="table table-bordered">
                            <tr>
                                <td>Government Tax</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Service Charge</td>
                                <td><span id="service_charge"></span>%</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6><b>Total</b></h6>
                                </td>
                                <td id="total"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <div class="row g-1">
                        <div class="col-sm-4">
                            <button type="button" class="closeModal btn btn-book bg-secondary text-light w-100">
                                Cancel
                            </button>
                        </div>
                        <div class="col-sm-8">
                            <button type="button"
                                class="btn btn-book bg-primary text-light w-100 openRoomBookNowButton"
                                data-resort = "{{ json_encode($resort) }}" data-room_rate="{{ $room_rate }}"
                                data-user="{{ json_encode(session('guest')) }}"
                                data-loginURL = "{{ route('login.user') }}" data-events="{{ json_encode($events) }}">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dialog>
