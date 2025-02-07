<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\Room;

class ResortController extends Controller
{
    //

    public function index()
    {
        return view('admin.dashboard');
    }

    public function resorts(Request $request)
    {
        $paginationLimit = $request->query('pagination_limit', 10);
        $resorts = Resort::paginate($paginationLimit);
        $resortsCount = Resort::count();
        $activeResorts = Resort::where('status', 1)->count();
        $deactivatedResorts = Resort::where('status', 0)->count();

        return view('admin.resorts', compact('resorts', 'resortsCount', 'activeResorts', 'deactivatedResorts', 'paginationLimit'));
    }

    public function resortsWithLimit(Request $request)
    {
        $paginationLimit = $request->input('pagination_limit', 10);
        return redirect()->route('admin.resorts', ['pagination_limit' => $paginationLimit]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'resort_name' => 'required',
                'username' => 'required|unique:resorts_admin,username',
                'password' => 'required',
                'location' => 'required',
                'location_coordinates' => 'required',
                'floorCount' => 'required',
                'roomPerFloor' => 'required',
                'taxRate' => 'required',
                'room_rate' => 'required',
                'status' => 'required',
                'contactDetails' => 'required'
            ]
        );

        Resort::create($data);
        $resortIDs = Resort::where('username', $request->username)->value('resortID');
        // insert naku ning username, resortID, uresort_name og password sa user na table

        // Resort::where('username', $request->username)

        for ($i = 1; $i <= $request->floorCount; $i++) {
            for ($j = 1; $j <= $request->roomPerFloor; $j++) {
                Room::create(['roomID' => "$i-$j", 'status' => 0, 'resortID' => $resortIDs]);
            }
        }

        return redirect(route('admin.resorts'));
    }

    public function destroy($resortID)
    {

        Resort::findOrFail($resortID)->delete();

        return redirect(route('admin.resorts'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $data = $request->validate(
            [
                'resort_name' => 'required',
                'username' => 'required',
                'password' => 'required',
                'location' => 'required',
                'location_coordinates' => 'required',
                'floorCount' => 'required',
                'roomPerFloor' => 'required',
                'taxRate' => 'required',
                'room_rate' => 'required',
                'status' => 'required',
                'contactDetails' => 'required'
            ]
        );

        Resort::findOrFail($request->resortID)->update($data);

        $roomIDs = Room::where('resortID', $request->resortID)->pluck('roomID')->toArray();

        for ($i = 1; $i <= $request->floorCount; $i++) {
            for ($j = 1; $j <= $request->roomPerFloor; $j++) {
                if (!in_array("$i-$j", $roomIDs)) {
                    Room::create(['roomID' => "$i-$j", 'status' => 0, 'resortID' => $request->resortID]);
                }
            }
        }

        return redirect(route('admin.resorts'))->with('success', 'Updated Successfully');
    }

    public function manage()
    {
        if (!session('resort')) {
            return redirect(route('login.resort_admin'));
        }

        $resort = Resort::findOrFail(session('resort')['resortID']);
        return view('resort_admin.manage', ['resort' => $resort]);
    }

    public function manage_update(Request $request)
    {

        $resort = Resort::findOrFail(session('resort')['resortID']);

        $data = $request->validate([
            'mainImage' => 'nullable|image|mimes:jpeg,png|max:8048',
            'image1' => 'nullable|image|mimes:jpeg,png|max:8048',
            'image1_2' => 'nullable|image|mimes:jpeg,png|max:8048',
            'image1_3' => 'nullable|image|mimes:jpeg,png|max:8048',
            'image2' => 'nullable|image|mimes:jpeg,png|max:8048',
            'image3' => 'nullable|image|mimes:jpeg,png|max:8048',
            'resort_description' => 'nullable',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'room_image_1' => 'nullable|image|mimes:jpeg,png|max:8048',
            'room_image_2' => 'nullable|image|mimes:jpeg,png|max:8048',
            'room_image_3' => 'nullable|image|mimes:jpeg,png|max:8048',
            'room_description' => 'nullable',
        ]);

        $data['amenities'] = implode(' | ', $request['amenities']);

        move_image($request, $resort, $data, 'mainImage');
        move_image($request, $resort, $data, 'image1');
        move_image($request, $resort, $data, 'image1_2');
        move_image($request, $resort, $data, 'image1_3');
        move_image($request, $resort, $data, 'image2');
        move_image($request, $resort, $data, 'image3');
        move_image($request, $resort, $data, 'room_image_1');
        move_image($request, $resort, $data, 'room_image_2');
        move_image($request, $resort, $data, 'room_image_3');

        $resort->update($data);

        return redirect(route('resort_admin.manage'))->with('success', 'Updated Successfully');
    }

    public function logout()
    {
        session()->forget('resort');
        return redirect(route('resort_admin.index'));
    }
}

function move_image($request, $resort, &$data, $field)
{
    if ($request->hasFile($field)) {
        $image = $request->file($field);
        $imageName = time() . '_' . $resort['resort_name'] . '_' . $image->getClientOriginalName();

        $i = 1;
        while (file_exists($path = public_path('images/resort_images/' . $imageName))) {
            $filename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $name = pathinfo($filename, PATHINFO_FILENAME);

            $imageName = time() . '_' . $resort['resort_name'] . '_' . $name . "($i)." . $extension;
            $i++;
        }

        $image->move(public_path('images/resort_images'), $imageName);
        $data[$field] = $imageName;

        !empty($resort[$field]) && file_exists($path = public_path('images/resort_images/' . $resort[$field])) ? unlink($path) : null;
    }
}
