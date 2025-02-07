<dialog id="bookingsTermsPopUp">

    <div class="container mt-1">
        <div class="row">
            <div class="col-12">
                <div class="policy-section">
                    <h2 class="policy-title">Payment Policy</h2>
                    <ul class="policy-list">
                        <li>
                            <span class="policy-heading">Full Payment</span>
                            <ul>
                                <li>
                                    <p class="policy-description">The total payment will be immediately deducted in
                                        full
                                        from
                                        your E-wallet upon completion of the transaction.</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="policy-heading">Down Payment</span>
                            <ul>
                                <li>
                                    <p class="policy-description">If there are more than one month before the check-in
                                        date, there will be a 100% refund.</p>
                                </li>
                                <li>
                                    <p class="policy-description">Refund of 50% if less than one month until the
                                        fifteenth day before the date of check-in.</p>
                                </li>
                                <li>
                                    <p class="policy-description">The final fifteen days prior to the check-in date are
                                        not refundable.</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="policy-heading">Failed Transactions</span>
                            <ul>
                                <li>
                                    <p class="policy-description">In the event of a failed transaction due to insufficient funds or other reasons, a <strong>1,000,000-peso processing fee</strong> will be deducted from your E-wallet as a consolation for our system's hard work and your brief will be confiscated along with your house and lot. (Think of it as a small tip for our effort!)</p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="policy-section">
                    <h2 class="policy-title">Cancellation Policy</h2>
                    <div>
                        <ul class="policy-list">
                            <li>
                                <span class="policy-heading">Full Payment</span>
                                <ul>
                                    <li>
                                        <p class="policy-description">If there are more than two months before the
                                            check-in
                                            date,
                                            there will be a 100% refund.</p>
                                    </li>
                                    <li>
                                        <p class="policy-description">If less than two months until one month before
                                            the check-in date, there will be an 80% refund.</p>
                                    </li>
                                    <li>
                                        <p class="policy-description">Refund of 50% if less than one month until the
                                            fifteenth day before the date of check-in.</p>
                                    </li>
                                    <li>
                                        <p class="policy-description">The final fifteen days prior to the check-in date
                                            are not refundable.</p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span class="policy-heading">Down Payment</span>
                                <ul>
                                    <li>
                                        <p class="policy-description">If there are more than two months before the
                                            check-in
                                            date,
                                            there will be a 100% refund.</p>
                                    </li>
                                    <li>
                                        <p class="policy-description">If there are more than two months before the
                                            check-in
                                            date,
                                            there will be a 100% refund.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="policy-section">
                    <h2 class="policy-title">Check-in Policy</h2>
                    <ul class="policy-list">
                        <li>
                            <span class="policy-heading">Check-in Time</span>
                            <p class="policy-description">8:00 AM</p>
                        </li>
                        <li>
                            <span class="policy-heading">Check-out Time</span>
                            <p class="policy-description">6:00 AM</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 btn-container">
                <button type="button" class="btn bg-primary text-white w-25 fw-bold"
                    onclick="closePopUpModal(0)">Accept</button>
            </div>
        </div>
    </div>
    
    <img src="{{ asset('/images/icons/user/close.png') }}" alt="" width="30px"
        style="position: fixed; top:20px; right:20px;cursor: pointer" onclick="closePopUpModal(0)">
</dialog>
