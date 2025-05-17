<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
     public function index(){
        if (auth()->user()->roles !== 'admin'&& auth()->user()->roles !== 'technician') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }
        $room = DB::table('rooms')
        ->get();
        $roomJson = $room->toJson();

        return view('room', compact('roomJson'));


    }
}
