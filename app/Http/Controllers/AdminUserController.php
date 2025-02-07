<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;


class AdminUserController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        return view('admin.accounts', compact('guests'));
    }
    public function profile()
    {
        return view('admin.viewuser');
    }
    public function dashboard(){
        
    }
}
