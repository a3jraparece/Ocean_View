@extends('user.layout')

@section('title', 'Ocean View | My reservations')
@section('css', '/css/defaultTableStyle.css')

@section('content')

    <div class="container-fluid overflow-auto p-2">
        <div class="navlink-container col-12 d-flex align-items-center gap-3 ps-3">
            <img src="{{ asset('/images/icons/user/back.png') }}" alt="" onclick="goBack()" width="30px" style="cursor: pointer;">
            <span style="font-size: 30px">Reservation Schedule</span>
        </div>
        <hr>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <table>
            <thead>
                <tr>
                    <th>Resort Name</th>
                    <th>Room ID</th>
                    <th>Payment Method</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Sub-total</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking['resort']['resort_name'] }}</td>
                        <td>{{ $booking['roomID'] }}</td>
                        <td>{{ $booking['payment_method'] }}</td>
                        <td>{{ $booking['start_date'] }}</td>
                        <td>{{ $booking['end_date'] }}</td>
                        <td>{{ $booking['sub-total'] }}</td>
                        <td>{{ $booking['total_amount'] }}</td>
                        <td>{{ $booking['status'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking['created_at'])->format('F j, Y') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><b>Total</b></td>
                    <td>P58128</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
