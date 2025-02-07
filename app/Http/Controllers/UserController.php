<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\Room;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Bookmark;
use App\Models\Review;
use App\Models\Guest;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{
    public function logout()
    {
        session()->forget('guest');
        return redirect(route('user.index', ['resorts' => Resort::all()]));
    }
    public function home()
    {
        session()->forget('currentResort');
        session()->forget('currentResortDetails');
        session()->forget('currentResortRooms');
        return view('home.index');
    }
    public function home_about_us()
    {
        return view('home.about_us');
    }
    public function resort_lists()
    {
        session()->forget('currentResort');
        session()->forget('currentResortDetails');
        session()->forget('currentResortRooms');

        $resorts = Resort::with('reviews')
        ->withAvg('reviews', 'rating')
        ->where('status','1')
        ->orderBy('reviews_avg_rating', 'desc')
        ->take(3)
        ->get();

    return view('user.index', compact('resorts'));
    }

    public function resort_details($resortID)
    {
        session(['currentResort' => $resortID]);
        session(['currentResortDetails' => true]);
        session(['currentResortRooms' => false]);

        $bs = 0;

        if (session('guest')) {
            $bookmarks = Bookmark::where('resortID', $resortID)
                ->where('guestID', session('guest')['guestID'])
                ->first();
            $bs = $bookmarks ? 1 : 0;
        }

        if (Resort::where('resortID', $resortID)->pluck('status')->first() == 0) {
            session()->flash('error', 'Resort may be not available or doesnt exist');
            return view('error');
        }


        $reviews = Review::where('resortID', $resortID)->with('guest')->get();
        $reviewsCount = count(Review::where('resortID', $resortID)->get());
        $reviewsAverage = number_format(Review::where('resortID', $resortID)->avg('rating'), 1);

        return view('user.resort_details', ['resort' => Resort::findOrFail($resortID), 'bvs' => $bs, 'reviews' => $reviews, 'reviewsCount' => $reviewsCount, 'reviewsAverage' => $reviewsAverage]);
    }

    public function resort_rooms($resortID)
    {
        if (!session('currentResort')) {
            session(['currentResort' => $resortID]);
        }

        session(['currentResortDetails' => false]);
        session(['currentResortRooms' => true]);

        if (Resort::where('resortID', $resortID)->pluck('status')->first() == 0) {
            session()->flash('error', "Cannot view rooms of the resortID $resortID, Resort may be not available or doesnt exist");
            return view('error');
        }

        $availableRooms = null;

        $room_rate = Resort::where('resortID', $resortID)->pluck('room_rate')->first();
        return view('user.resort_room_list', ['resort' => Resort::findOrFail($resortID), 'availableRooms' => $availableRooms, 'room_rate' => $room_rate, 'events' => Event::where('resortID', $resortID)->get()]);
    }

    public function resort_available_rooms($resortID, Request $request)
    {

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('start_date'))->addDays($request['daysOfStay'] - 1);

        $bookedRoomIDs = Booking::where('resortID', $resortID)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$startDate])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$endDate]);
            })
            ->pluck('roomID')
            ->toArray();

        $allRooms = Room::where('resortID', $resortID)->get();

        $availableRooms = $allRooms->reject(function ($room) use ($bookedRoomIDs) {
            return in_array($room->roomID, $bookedRoomIDs);
        });

        $bookingPreferenceInputs = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'startDateInput' => $request['start_date'],
            'daysOfStay' => $request['daysOfStay'],
        ];

        // error ni siyag url, pang log out na url, tas ang problem dri is dapat blank s ajud sa sugod then dapat kay before mag booking need pa e check if yung inouts is gi reload ba kay didto baya to kwaon ang data huhu. then dapat if mag reload kay yung checkbos to enable update preference kay mo siga to then maka book raka if disabled to kay ni agree ka na final natu na inouts

        $room_rate = Resort::where('resortID', $resortID)->pluck('room_rate')->first();
        return view('user.resort_room_list', ['resort' => Resort::findOrFail($resortID), 'availableRooms' => $availableRooms, 'room_rate' => $room_rate, 'events' => Event::where('resortID', $resortID)->get(), 'bookingPreferenceInputs' => $bookingPreferenceInputs]);
    }

    public function resort_available_rooms_view($resortID)
    {

        $resort = Resort::findOrFail($resortID);
        $roomLists = Room::where('resortID', '=', $resortID)->where('status', '=', 1)->pluck('roomID')->all();

        if ($resort['status'] == 0) {
            session()->flash('error', "Cannot view room Schedules of the resortID $resortID, Resort may be not available or doesnt exist");
            return view('error');
        }

        $startDate = Carbon::parse(request()->get('startDate', Carbon::today()));

        $endDate = $startDate->copy()->addDays(14); // Add 14 days to the start date

        $floorCount = $resort['floorCount'];
        $RoomPerFloor = $resort['roomPerFloor'];

        // Get all bookings that overlap with the 15-day range
        $bookings = Booking::where('resortID', $resortID)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $endDate)
                            ->where('end_date', '>=', $startDate);
                    });
            })
            ->get();

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
        return view('user.resortRoomSchedules', compact('resort', 'data', 'roomLists', 'startDate'));
    }

    public function bookings_store($resortID, Request $request)
    {

        // NOTE FOR SECURITY KWAA DAYUN MGA BOOKINGS SA ROOM TAS E CHECK IF NAA NABAY ANAK KUHA

        $data = $request->validate([
            'guestID' => 'required',
            'resortID' => 'required',
            'roomID' => 'required',
            'payment_method' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'sub-total' => 'nullable',
            'total_amount' => 'required',
            'status' => 'required',
        ]);

        $guestBaalnce =  Guest::findOrFail($request['guestID'])['balance'];

        $guestNewBalance = 0;

        if ($request['payment_method'] == 'Full Payment') {
            if ($guestBaalnce < $request['total_amount']) {
                session()->flash('booking_success', false);
                return redirect(route('user.resort.rooms', ['resortID' => $resortID]));
            }
            $guestNewBalance = $guestBaalnce -  $request['total_amount'];
        } else {
            if ($guestBaalnce < $request['sub-total']) {
                session()->flash('booking_success', false);
                return redirect(route('user.resort.rooms', ['resortID' => $resortID]));
            }
            $guestNewBalance = $guestBaalnce -  $request['sub-total'];
        }

        Guest::findOrFail($request['guestID'])->fill(['balance' => $guestNewBalance])->save();

        Booking::create($data);

        session()->flash('booking_success', true);
        return redirect(route('user.resort.rooms', ['resortID' => $resortID]));
    }

    public function transcation_history()
    {
        if (!session('guest')) {
            return view('login.user');
        }
        $guest = session('guest');
        return view('user.transaction_history', ['guest' => $guest]);
    }

    public function bookmarks()
    {
        if (!session('guest')) {
            return view('login.user');
        }

        $guest = session('guest');

        $bookmarks = Bookmark::where('guestID', $guest['guestID'])->with('resort')->get();

        return view('user.bookmarks', ['guest' => $guest, 'bookmarks' => $bookmarks]);
    }
    public function destroy_bookmak($id)
    {
        Bookmark::findOrFail($id)->delete();

        return redirect(route('user.bookmarks'));
    }
    public function add_bookmarks(Request $request)
    {
        $request->validate([
            'guestID' => 'required|integer',
            'resortID' => 'required|integer',
        ]);

        $bookmark = Bookmark::where('guestID', $request->guestID)
            ->where('resortID', $request->resortID)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmark::create([
                'guestID' => $request->guestID,
                'resortID' => $request->resortID,
            ]);
        }
        return redirect(route('user.resort.details', ['resortID' => $request->resortID]));
    }
    public function my_account()
    {
        if (!session('guest')) {
            return view('login.user');
        }
        $guest = session('guest');
        return view('user.my_account', ['guest' => $guest]);
    }

    public function my_reservations()
    {
        if (!session('guest')) {
            return view('login.user');
        }

        $bookings = Booking::where('guestID', session('guest')['guestID'])->with('resort')->get();

        $guest = session('guest');
        return view('user.my_reservations', ['guest' => $guest, 'bookings' => $bookings]);
    }

}
