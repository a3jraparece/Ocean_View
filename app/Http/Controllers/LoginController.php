<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Resort;

class LoginController extends Controller
{
    public function ocean_view()
    {
        return view('login.oceanview');
    }
    public function resort_admin()
    {
        return view('login.resort_admin');
    }
    public function user()
    {
        if (session('guest')) {
            return view('user.index');
        }
        return view('login.user');
    }

    public function register()
    {
        return view('login.register');
    }

    public function user_login_verify(Request $request)
    {
        $guests = Guest::all();

        foreach ($guests as $guest) {
            if ($guest['username'] == $request['username'] && $guest['password'] == $request['password']) {
                session(['guest' => $guest]);

                if (session('currentResortDetails')) {
                    return redirect(route('user.resort.details', ['resortID' => session('currentResort')]));
                }
                if (session('currentResortRooms')) {
                    return redirect(route('user.resort.rooms', ['resortID' => session('currentResort')]));
                }

                return view('user.index', ['resorts' => Resort::all()]);
            }
        }

        return redirect(route('login.user'))->with('error', 'Incorrect Credentials');
    }

    public function resort_admin_login_verify(Request $request)
    {
        $resorts = Resort::all();

        foreach ($resorts as $resort) {
            if ($resort['username'] == $request['username'] && $resort['password'] == $request['password']) {
                // mag if dria na if ang status naka disable kay i pop up niya na dele siya pede maka book |!!! Apilon ang web yung url ba if e try nilag bypass
                session(['resort' => $resort]);
                return redirect(route('resort_admin.index'));
            }
        }

        return redirect(route('login.resort_admin'))->with('error', 'Incorrect Credentials');
    }
}
