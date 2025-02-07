@extends('resort_admin.layout')
@section('title', 'Punta Verde' . ' | Admin')
@section('css', '/css/resort_admin/tableStyle.css')
@section('content')

    <div class="container-fluid mt-3">
        <h4>Reservation schedules</h4>
        <div class="filters border p-2 rounded mb-3">
            <form method="GET" action="{{ route('resort_admin.reservations') }}" id="formStartDate">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label for="startDate" class="form-label">Select Start Date:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control"
                            value="{{ $startDate }}">
                    </div>
                    <button type="submit" class="btn btn-primary" id="dateUpdateBTN" hidden>Update</button>
                </div>
            </form>
        </div>
        <!-- Pagination -->
        <style>
            .page-link {
                cursor: pointer;
            }
        </style>
        <div aria-label="Page navigation">
            <ul class="pagination justify-content-center bg-primary p-2">
                <li class="page-item">
                    <span class="page-link" aria-label="Previous" onclick="changeDateAndSubmit('{{ $startDate }}', -5)">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Previous" onclick="changeDateAndSubmit('{{ $startDate }}', -1)">
                        <span aria-hidden="true">&laquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Next" onclick="changeDateAndSubmit('{{ $startDate }}', +1)">
                        <span aria-hidden="true">&raquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Next" onclick="changeDateAndSubmit('{{ $startDate }}', +5)">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="pagination-container text-end mt-4 overflow-x-auto">
            <table id="reservationTable">
                <thead style="text-align: center;">
                    <tr>
                        <td rowspan="3"></td>
                        <?php
                        
                        $yearsCount = count($data);
                        foreach ($data as $years => $months) {
                            if ($yearsCount == 1) {
                                echo "<td colspan=\"" . count(array_reduce($months, 'array_merge', [])) . "\">$years</td>";
                            } else {
                                foreach ($months as $MonthName => $days) {
                                    echo "<td colspan=\"" . count($days) . "\">$years</td>";
                                }
                            }
                        }
                        ?>
                    </tr>
                    <tr style="color: blue;">
                        <?php
                        foreach ($data as $years => $months) {
                            foreach ($months as $month => $days) {
                                echo "<td colspan=\"" . count($days) . "\">$month</td>";
                            }
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        foreach ($data as $years => $months) {
                            foreach ($months as $monthName => $days) {
                                foreach ($days as $dayName => $dayDetails) {
                                    echo "<td>$dayName</td>";
                                }
                            }
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><b>Rooms</b></td>
                        <?php
                        
                        foreach ($data as $year => $months) {
                            foreach ($months as $month => $days) {
                                foreach ($days as $day => $rooms) {
                                    $count = 0;
                                    foreach ($rooms as $room => $person) {
                                        if (!empty($person)) {
                                            $count++;
                                        }
                                    }
                                    echo "<td style='background-color: rgb(45, 214, 19);'>$count</td>";
                                }
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $roomOccupancy = [];
                    foreach ($data as $year => $months) {
                        foreach ($months as $month => $days) {
                            foreach ($days as $day => $rooms) {
                                foreach ($rooms as $room => $person) {
                                    if (in_array($room, $roomIds->toArray())) {
                                        if (!isset($roomOccupancy[$room])) {
                                            $roomOccupancy[$room] = [];
                                        }
                                        $roomOccupancy[$room][] = !empty($person) ? $person : '';
                                    }
                                }
                            }
                        }
                    }
                    
                    foreach ($roomOccupancy as $room => $occupants) {
                        echo "<tr style = 'text-align: center; color: white;'>";
                        echo "<td style= 'color: black;'><b>$room</b></td>";
                    
                        $currentOccupant = null;
                        $colspan = 1;
                    
                        for ($i = 0; $i < count($occupants); $i++) {
                            if ($occupants[$i] === '') {
                                // If the current occupant is not empty, output it with its colspan
                                if ($currentOccupant !== null) {
                                    $status = $currentOccupant['status']; // The status part (if available)
                    
                                    $status === 'Fully Paid' ? ($bgColor = 'blue') : ($status === 'Partially Paid' ? ($bgColor = 'orange') : ($bgColor = ''));
                    
                                    // Output the table cell with or without background color
                                    if ($bgColor) {
                                        echo "<td colspan='$colspan' style='background-color:$bgColor;' data-info='$currentOccupant' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                                        // echo "<td colspan='$colspan' style='background-color:$bgColor;' data-info='$currentOccupant' data-info='$roomLists'>" . $currentOccupant['guestID'] . '</td>';
                                    } else {
                                        echo "<td colspan='$colspan' data-info='$currentOccupant' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                                    }
                    
                                    $currentOccupant = null; // Reset after outputting
                                    $colspan = 1; // Reset colspan
                                }
                    
                                echo '<td></td>';
                            } else {
                                // If first non-empty occupant or no current occupant, set it
                                if ($currentOccupant === null) {
                                    $currentOccupant = $occupants[$i];
                                } elseif ($occupants[$i] === $currentOccupant) {
                                    // If current occupant is the same as the last one, increase colspan
                                    $colspan++;
                                } else {
                                    // If the occupant changes, print the previous occupant with colspan
                                    $status = $currentOccupant['status'];
                    
                                    $status === 'Fully Paid' ? ($bgColor = 'blue') : ($status === 'Partially Paid' ? ($bgColor = 'orange') : ($bgColor = ''));
                    
                                    if ($bgColor) {
                                        echo "<td colspan='$colspan' style='background-color:$bgColor;' data-info='$currentOccupant' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                                    } else {
                                        echo "<td colspan='$colspan' data-info='$currentOccupant' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                                    }
                    
                                    $currentOccupant = $occupants[$i];
                                    $colspan = 1;
                                }
                            }
                        }
                        // Output the last occupant if any remains at the end of the loop
                        if ($currentOccupant !== null) {
                            $status = $currentOccupant['status'];
                    
                            $status === 'Fully Paid' ? ($bgColor = 'blue') : ($status === 'Partially Paid' ? ($bgColor = 'orange') : ($bgColor = ''));
                    
                            if ($bgColor) {
                                echo "<td colspan='$colspan' style='background-color:$bgColor;' data-info='" . json_encode($currentOccupant) . "' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                            } else {
                                echo "<td colspan='$colspan' data-info='" . json_encode($currentOccupant) . "' data-roomlists='" . json_encode($roomLists) . "'>" . $currentOccupant['guest']['username'] . '</td>';
                            }
                        }
                    
                        echo '</tr>';
                    }
                    
                    ?>
                </tbody>
            </table>

            <div id="tooltip" class="hidden">
                <div id="tooltipHeading">
                    <div id="tooltipName" style="color:white;">Alex Aparece</div>
                    <div id="tooltipDeleteIcon">
                        <img src="{{ asset('/images/icons/user/delete.png') }}" alt="" width="100%"
                            data-user-id="0" style="cursor:pointer;">
                    </div>
                </div>
                <div id="tooltipBody">
                    <div id="tooltipIMGHolder">
                        <img src="images/King Size Bed.jpg" alt="" id="tooltipRoomIMG">
                    </div>
                    <div id="tooltipResortTitle">
                        <div id="tooltipResortNameHodler">
                            <div id="tooltipRoom" style="background-color: rgb(233, 233, 233); padding:2px;">Floor 1 - Room
                                1</div>
                        </div>
                    </div>
                    <table id="tooltipTable">
                        <tr>
                            <td>Capacity: </td>
                            <td id="tooltipGuest">3</td>
                        </tr>
                        <tr>
                            <td>Room Type: </td>
                            <td id="tooltipRoomType">Kings Size Bed</td>
                        </tr>
                        <tr>
                            <td>Check-in:</td>
                            <td id="tooltipCheckIn">December 23, 2024</td>
                        </tr>
                        <tr>
                            <td>Check-out:</td>
                            <td id="tooltipCheckOut">December 26, 2024</td>
                        </tr>
                    </table>
                    <div id="tooltipTotalHolder" style="border-top: 1px solid rgb(221, 221, 221)">
                        <div id="tooltipTotal">
                            <h4>Total</h4>
                            <h2 id="tooltipTotalStay" style="color: rgba(0, 0, 0, 0.908);">P74,054.5</h2>
                        </div>
                    </div>
                    <div class="tooltipRadioButton" style="border-top: 1px solid rgb(221, 221, 221)">
                        <input type="radio" name="paymentType" id="toolDown" value="down"><label for="toolDown">Down
                            Payment |
                            50% out off total payment</label>
                    </div>
                    <div class="tooltipRadioButton">
                        <input type="radio" name="paymentType" id="toolFull" value="full" checked><label
                            for="toolFull">Full
                            Payment | 10% Discount</label>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <script src="/js/resort_admin/scriptTable.js"></script>
        <script>
            document.getElementById('startDate').onchange = () => {
                document.getElementById('dateUpdateBTN').click();
            }

            function changeDateAndSubmit(currentDate, daysToAddOrSubtract) {
                var date = new Date(currentDate);
                date.setDate(date.getDate() + daysToAddOrSubtract);
                var formattedDate = date.toISOString().split('T')[0];
                document.getElementById('startDate').value = formattedDate;
                document.getElementById('formStartDate').submit();
            }
        </script>
        </script>
    @endsection
