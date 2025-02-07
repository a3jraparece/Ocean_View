<dialog id="bookingOpenModal">
    <div class="container my-3">
        <div class="row g-2">
            <!-- Left Section -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h4 class="">Guest Details</h4>
                    <hr>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" id="firstName" class="form-control" placeholder="Enter First Name"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" id="middleName" class="form-control" placeholder="Enter Middle Name"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" id="surname" class="form-control" placeholder="Enter Surname" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number</label>
                        <input type="text" id="contactNumber" class="form-control" placeholder="Enter Contact Number"
                            readonly>
                    </div>

                    <h4 class="mt-4">Booking Preference</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="checkIn" class="form-label">Check-in</label>
                                <input type="date" id="checkIn" class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="daysStay" class="form-label">Days of Stay</label>
                                <input type="number" id="daysStay" class="form-control" placeholder="Number of days"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="numGuests" class="form-label">Number of Guests</label>
                            <input type="number" id="numGuests" class="form-control" placeholder="Number of guests"
                                readonly>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <img src="{{ asset('/images/room_images/default.jpg') }}" alt="Room" class="img-fluid mb-3"
                        id="bookingROOMimage">
                    <h5>Room: <span id="bookingROOMID"></span></h5>
                    <div class="styled-header my-2">
                        <div class="line"></div>
                        <div class="text-center" id="bookingRESORTNAME"></div>
                        <div class="line"></div>
                    </div>
                    <ul class="list-unstyled">
                        <li><strong>Room Type:</strong> <span id="bookingROOMTYPE"></span></li>
                        <li><strong>Guests:</strong> <span id="bookingNumOfGuest"></span></li>
                        <li><strong>Check-in: </strong> <span id="bookingCheckInDate"></span></li>
                        <li><strong>Check-out: </strong><span id="bookingCheckOutDate"></span></li>
                    </ul>
                    <h6>Amenities:</h6>
                    <div class="amenities-container">
                        <ul class="list-unstyled" id="bookingAmenities">

                        </ul>
                    </div>
                    <div class="container p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ asset('/images/icons/user/info.png') }}" alt="" width="20px"
                                    height="20px" onclick="openStayTotalInfo(1)" class="info_icons">
                            </div>
                            <div>
                                <strong>Stay Total:</strong> ₱<span id="bookingSTAYTOTAL"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ asset('/images/icons/user/info.png') }}" alt="" width="20px"
                                    height="20px" onclick="taxesTotalPopUp(1)" class="info_icons">
                            </div>
                            <div>
                                <strong>Taxes:</strong> ₱<span id="bookingTAXES"> </span>
                            </div>
                        </div>
                        <div>
                            <hr>
                            <strong style="margin-left:20px">Total:</strong> ₱<span id="bookingTOTAL"> </span>
                        </div>

                        <div class="container" style="padding: 10px 0 0 23px">
                            <div class="form-check">
                                <input type="radio" id="downPayment" name="paymentOption" class="form-check-input"
                                    onclick="paymentmethod(0)">
                                <label for="downPayment" class="form-check-label">Down Payment (50% off total)</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="fullPayment" name="paymentOption" class="form-check-input"
                                    checked onclick="paymentmethod(1)">
                                <label for="fullPayment" class="form-check-label">Full Payment (10% discount)</label>
                            </div>
                            <h5 class="mt-4">Total: <span class="text-primary"
                                    id="bookingTOTALPAYMENTTOAPAY"></span>
                            </h5>

                            <p>By completing this booking, you agree to the <span
                                    style="color: rgb(13, 110, 250);cursor:pointer;" onclick="openBookingTermModal()"
                                    class="hover-underline">booking terms</span> and <span
                                    href="URL-to-privacy-policy" target="_blank"
                                    style="color: rgb(13, 110, 250);;cursor:pointer;"
                                    onclick="openBookingPrivacyPolicyModal(1)" class="hover-underline">privacy
                                    policy</span>.</p>
                        </div>

                        <class class="row g-2">
                            <div class="col-sm-3 col-md-12 col-lg-12 col-xl-3">
                                <button type="button" class="closeModal btn btn-secondary w-100">
                                    Cancel
                                </button>
                            </div>
                            <div class="col-sm-9 col-md-12 col-lg-12 col-xl-9">
                                <form
                                    action="{{ route('user.resort.rooms.book', ['resortID' => $resort['resortID']]) }}"
                                    method="post" id="bookNowFormSubmit">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="guestID" id="bookingUSERID">
                                    <input type="hidden" name="resortID" id="bookingRESORTID">
                                    <input type="hidden" name="roomID" id="bookingROOMIDpost">
                                    <input type="hidden" name="payment_method" id="bookingPAYMENTMETHODpost"
                                        value="Full Payment">
                                    <input type="hidden" name="start_date" id="bookingSTARTDATEpost">
                                    <input type="hidden" name="end_date" id="bookingENDDATEpost">
                                    <input type="hidden" name="sub-total" id="bookingSUBTOTALpost">
                                    <input type="hidden" name="total_amount" id="bookingTOTALAMOUNTpost">
                                    <input type="hidden" name="status" id="bookingSTATUSpost" value="Fully Paid">
                                    <button type="button" class="btn btn-primary w-100"
                                        onclick="bookingreadyOpenModal(1)">Confirm & Book</button>
                                </form>
                            </div>
                        </class>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dialog>

@include('user.dialog.stayTotalPopUp')
@include('user.dialog.taxesTotalPopUp')
@include('user.dialog.bookingsTermsPopUp')
@include('user.dialog.bookingsPrivacyPolicyPopUp')
@include('user.dialog.bookingready')

<script src="/js/user/dialog/popUp.js"></script>
