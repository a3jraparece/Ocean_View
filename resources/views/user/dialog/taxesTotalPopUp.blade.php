
<dialog id="taxesTotalPopUp">
    <div class="row">
        <div class="col-md-4 overflow-auto ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">Booking fees and taxes</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Government Tax</span>
                            <spa>10%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Service Charge</span>
                            <span id="serviceCharge"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="border p-3 rounded bg-light overflow-auto">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Staying fee</th>
                            <th>Government Tax</th>
                            <th>Service Charge</th>
                            <th>Tax Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="BFTstayingfee"></td>
                            <td>10%</td>
                            <td id="BFTserviceCharge"></td>
                            <td id="BFTtaxtotal" style="color: rgb(7, 187, 7); font-weight:bold"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <img src="{{ asset('/images/icons/user/close.png') }}" alt="" width="30px"
        style="position: fixed; top:20px; right:20px;cursor: pointer" onclick="taxesTotalPopUp(0)">
</dialog>
