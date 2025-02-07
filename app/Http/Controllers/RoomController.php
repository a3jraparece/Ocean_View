<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Resort;

class RoomController extends Controller
{
    //
    public function index()
    {
        if (! session('resort')) {
            return redirect(route('login.resort_admin'));
        }

        return view('resort_admin.index');
    }


    public function rooms()
    {

        if (! session('resort')) {
            return redirect(route('login.resort_admin'));
        }

        $resortID = session('resort')['resortID'];

        return view('resort_admin.rooms', ['rooms' => Room::where('resortID', $resortID)->orderBy('roomID')->get(), 'resort_name' => Resort::where('resortID', $resortID)->pluck('resort_name')->first()]);
    }

    public function  room_status($id, $status)
    {
        Room::findOrFail($id)->update(['status' => $status]);

        return redirect(route('resort_admin.rooms'));
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $path = public_path('images/room_images/' . $room['room_image']);

        file_exists($path) ? unlink($path) : '';

        $room->delete();
        return redirect(route('resort_admin.rooms'));
    }

    public function  update(Request $request)
    {

        $data = $request->validate([
            'room_type' => 'required',
            'room_image' => 'nullable|image|mimes:jpeg,png|max:8048',
            'description' => 'nullable',
            'inclusions' => 'nullable',
            'capacity' => 'nullable',
            'amenities' => 'nullable',
        ]);

        // dinhi sa image, e add sa file path name sa resort, para dali nalamng ma tan aw asa na nga iamgena belong

        if ($request->hasFile('room_image')) {
            $image = $request->file('room_image');
            $imageName = time() . '_' . Resort::where('resortID', $request['resortID'])->pluck('resort_name')->first() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/room_images'), $imageName);
            $data['room_image'] = $imageName;

            $room = Room::findOrFail($request['id']);
            !empty($room['room_image']) && file_exists($path = public_path('images/room_images/' . $room['room_image'])) ? unlink($path) : null;
        }

        Room::findOrFail($request->id)->update($data);

        return redirect(route('resort_admin.rooms'));
    }
}
