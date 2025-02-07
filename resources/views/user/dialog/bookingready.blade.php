<dialog id="bookingready">
    <div class="container">
        <div class="card shadow-sm p-2">
            <h4 class="fw-bold" style="border-bottom: 1px solid rgb(214, 214, 214)">Ready to Complete Your Booking?</h4>
            <p class="text-muted">
                Please take a moment to review the following important details before confirming your reservation:
            </p>
            <ul>
                <li class="mb-3">
                    <strong>Non-Changeable Rooms</strong>
                    <p class="text-muted mb-0">
                        Once your room is booked, no changes can be made to your reservation, including room type,
                        check-in/check-out dates, and guest details.
                    </p>
                </li>
                <li>
                    <strong>Booking is Final and Non-Transferable</strong>
                    <p class="text-muted mb-0">
                        The booking will be in your name and cannot be transferred to another guest. Please ensure that
                        the name and contact details are accurate before confirming.
                    </p>
                </li>
            </ul>
            <div class="d-flex justify-content-between pt-2" style="border-top: 1px solid rgb(214, 214, 214)">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="bookingreadyOpenModal(0)">Back</button>
                <button type="button" class="btn btn-primary"
                    onclick="bookingreadyProcessOpenModal(1)">Continue</button>
            </div>
        </div>
    </div>
</dialog>

<dialog id="bookingreadyProcess">
    <div class="header">
        <div class="stars mb-2">
            <span style="margin-top: 20px">★</span>
            <span style="margin-top: 10px">★</span>
            <span>★</span>
            <span style="margin-top: 10px">★</span>
            <span style="margin-top: 20px">★</span>
        </div>
        <h1>BOOKING CONFIRMED</h1>
    </div>

    <p class="text-muted text-center">
        We are pleased to inform you that your reservation request has been received, confirmed and has been deducted
        from your e-wallet.
    </p>
    <p class="fw-bold text-center">
        Your booking has been successfully confirmed! Thank you for choosing us. Here are your booking details:
    </p>

    <p class="text-muted mt-4 text-center">
        You can still view the complete booking details in your booking history.
    </p>

    <div class="text-center">
        <hr>
        <button type="button" class="btn btn-primary w-25" onclick="bookingreadyProcessOpenModal(0)">Home</button>
    </div>
</dialog>

<dialog id="bookingreadyProcessFailed"
    style="border: none; border-radius: 10px; padding: 20px; max-width: 500px; width: 100%; background: #ffe6e6; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <div class="header text-center">
        <div class="stars mb-2">
            <span style="color: #d9534f; font-size: 1.5rem; margin-top: 20px;">★</span>
            <span style="color: #c9302c; font-size: 2rem; margin-top: 10px;">★</span>
            <span style="color: #b52b27; font-size: 2.5rem;">★</span>
            <span style="color: #c9302c; font-size: 2rem; margin-top: 10px;">★</span>
            <span style="color: #d9534f; font-size: 1.5rem; margin-top: 20px;">★</span>
        </div>
        <h1 style="color: #a94442; font-weight: bold;">BOOKING FAILED</h1>
    </div>

    <p class="text-danger text-center fw-bold">
        Unfortunately, your reservation could not be processed.
    </p>
    <p class="text-center text-muted">
        This might be due to one of the following reasons:
    </p>
    <ul class="text-danger">
        <li>Insufficient balance in your e-wallet.</li>
        <li>The selected room is no longer available.</li>
        <li>Technical error occurred during the booking process.</li>
    </ul>

    <p class="text-muted mt-4 text-center">
        Please review the details and try again or contact support for assistance.
    </p>

    <div class="text-center">
        <hr style="border-color: #d9534f;">
        <button type="button" class="btn btn-danger w-25" onclick="bookingreadyProcessFailedOpenModal(0)">Home</button>
    </div>
</dialog>
