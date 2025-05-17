<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Equipment;
class EquipmentController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles !== 'admin' && auth()->user()->roles !== 'technician') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }
        // Fetch all equipment data from the database using DB facade
        // $equipments = Equipment::with('room')->get();


        $equipmentName = \DB::table('equipment')
            ->leftJoin('rooms', 'equipment.room_id', '=', 'rooms.id')
            ->select('equipment.*', 'rooms.name as room_name')  // Select all columns from equipment and the room name
            ->get();


        $equipmentJson = $equipmentName->toJson();
        // Pass the data to the view
        // dd($equipmentName);
        return view('equipment', compact('equipmentJson'));
    }
}
