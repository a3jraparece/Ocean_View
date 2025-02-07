<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\Room;
use App\Models\Booking;



class BookingController extends Controller
{
    public function index()
    {

        $resort = Resort::findOrFail(session('resort')['resortID']);

        $roomLists = Room::where('resortID', '=', $resort['resortID'])->where('status', '=', 1)->get();

        if ($resort['status'] == 0) {
            session()->flash('error', "Cannot view room Reservation of the resortID" . $resort['resortID'] . ", Resort may be not available or doesnt exist");
            return view('error');
        }

        $startDate = Carbon::parse(request()->get('startDate', Carbon::today()));

        $endDate = $startDate->copy()->addDays(14); // Add 14 days to the start date

        $floorCount = $resort['floorCount'];
        $RoomPerFloor = $resort['roomPerFloor'];

        // Get all bookings that overlap with the 15-day range
        $bookings = Booking::where('resortID', $resort['resortID'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $endDate)
                            ->where('end_date', '>=', $startDate);
                    });
            })->with('guest')->with('resort')
            ->get();

        // dd($bookings);

        // Initialize the data array with empty rooms
        $data = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dayLabel = 'Day ' . $date->day;
            $year = $date->year;
            $month = $date->format('F');

            // Ensure the year and month exist in the array
            if (!isset($data[$year][$month])) {
                $data[$year][$month] = [];
            }

            if (!isset($data[$year][$month][$dayLabel])) {
                $data[$year][$month][$dayLabel] = [];
            }

            for ($floor = 1; $floor <= $floorCount; $floor++) {
                for ($room = 1; $room <= $RoomPerFloor; $room++) {
                    $roomID = "{$floor}-{$room}";

                    // Check if the room is booked for this specific day
                    $bookingForDay = $bookings->filter(function ($booking) use ($date, $roomID) {
                        // A booking is valid if the room ID matches and the date is within the booking's range
                        return $booking->roomID == $roomID && $date->between($booking->start_date, $booking->end_date);
                    })->first();

                    // If a booking exists for the room, store the guestID, otherwise store null
                    $data[$year][$month][$dayLabel][$roomID] = $bookingForDay ? $bookingForDay : null;
                }
            }
        }

        // dd($data);
        $startDate = $startDate->toDateString();

        $roomIds = $roomLists->pluck('roomID');

        return view('resort_admin.reservations', compact('resort', 'data', 'roomLists', 'startDate', 'roomLists', 'roomIds'));
    }
}
