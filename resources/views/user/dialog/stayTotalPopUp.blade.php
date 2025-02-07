<dialog id="stayTotalPopUp">
    <div class="container my-4">
        <div class="row g-3">
            <!-- Room Rate -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary">Stay Total</h5>
                        <h6 class="mt-3 fw-bold">Room Rate</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Price Per Night:</span>
                                <spa id="currentStayTotalRoomRate"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span id="currentStayTotalBedType"></span>
                                <span id="currentStayTotalBedTypePercent"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Sub-total:</span>
                                <span id="currentStaySubTotal"></span>
                            </li>
                        </ul>
                        <hr>
                        <h6 class="fw-bold">Discount</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Special Days:</span>
                                <span>8%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Long Stay:</span>
                                <span>2% × weeks up to 20%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Special Days Discount -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <div class="border p-3 rounded bg-light overflow-auto">
                            <h5 class="section-title">Special Days Discount</h5>
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Room Type</th>
                                        <th>Room Rate</th>
                                        <th>SD Discount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="specialDayTBody">

                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Special Days Total Discount</td>
                                        <td id="stayTotalDiscount"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="border p-3 rounded bg-light overflow-auto">
                                <h5 class="section-title">Long Stay Discount</h5>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Day/s</th>
                                            <th>Week/s</th>
                                            <th>Total</th>
                                            <th>Discount</th>
                                            <th> Discount Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="currentStayTotalDaysOfStay"></td>
                                            <td id="currentStayTotalInWeeks"></td>
                                            <td id="STsubtotal"></td>
                                            <td id="STtotalStayPercentDiscount"></td>
                                            <td id="STtotalStayDiscount"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Long Stay Discount -->

            <div class="col-12 overflow-auto">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Total Payment</th>
                            <th>Special Day Discount</th>
                            <th>Long Stay Discount</th>
                            <th style="min-width: 150px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="STFinalTotalPaymentBefore"></td>
                            <td id="STFinalSpecialDays"></td>
                            <td id="STFinalLongStayDiscount"></td>
                            <td id="STFinalTotalPayment" style="color: rgb(7, 187, 7); font-weight:bold"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <img src="{{ asset('/images/icons/user/close.png') }}" alt="" width="30px"
        style="position: fixed; top:20px; right:20px;cursor: pointer" onclick="openStayTotalInfo(0)">

</dialog>
