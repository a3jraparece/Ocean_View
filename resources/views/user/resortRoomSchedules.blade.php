<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $resort['resort_name'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/resort_admin/tableStyle.css') }}">
</head>

<body>

    <div class="container-fluid pt-2">
        <h4>Reservation Schedules for {{ $resort['resort_name'] }}</h4>
        <div class="filters border p-2 rounded mb-3">
            <form method="GET"
                action="{{ route('resort_available_rooms_view', ['resortID' => $resort['resortID']]) }}"
                id="formStartDate">
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
        <style>
            .page-link {
                cursor: pointer;
            }
        </style>
        <!-- Pagination -->
        <div aria-label="Page navigation">
            <ul class="pagination justify-content-center bg-primary p-2">
                <li class="page-item">
                    <span class="page-link" aria-label="Previous"
                        onclick="changeDateAndSubmit('{{ $startDate }}', -5)" title="-5">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Previous"
                        onclick="changeDateAndSubmit('{{ $startDate }}', -1)" title="-1">
                        <span aria-hidden="true">&laquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Next" onclick="changeDateAndSubmit('{{ $startDate }}', +1)" title="+1">
                        <span aria-hidden="true">&raquo;</span>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link" aria-label="Next" onclick="changeDateAndSubmit('{{ $startDate }}', +5)" title="+5">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </span>
                </li>
            </ul>
        </div>

        <table id="reservationTable">
            <thead style="text-align: center;">
                <tr>
                    <td rowspan="3"></td>

                    @php
                        $yearsCount = count($data);
                        foreach ($data as $years => $months) {
                            if ($yearsCount == 1) {
                                echo "<td colspan=\"" .
                                    count(array_reduce($months, 'array_merge', [])) .
                                    "\">$years</td>";
                            } else {
                                foreach ($months as $MonthName => $days) {
                                    echo "<td colspan=\"" . count($days) . "\">$years</td>";
                                }
                            }
                        }
                    @endphp
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
                                if (in_array($room, $roomLists)) {
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
                
                    for ($i = 0; $i < count($occupants); $i++) {
                        if ($occupants[$i] === '') {
                            echo '<td></td>';
                        } else {
                            echo "<td style='background-color:rgba(13, 21, 250, 0.841);'></td>";
                        }
                    }
                }
                
                echo '</tr>';
                ?>
            </tbody>
        </table>
        <br>
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
</body>

</html>
