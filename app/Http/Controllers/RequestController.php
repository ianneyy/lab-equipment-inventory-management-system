<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;
use OwenIt\Auditing\Models\Audit;

class RequestController extends Controller
{
    public function index()
    {

        $equipment = DB::table('equipment')
            ->join('rooms', 'equipment.room_id', '=', 'rooms.id')
            ->select('equipment.*', 'rooms.name as room_name')
            ->get();

        return view('request_equipment',compact('equipment'));


    }
    public function details(Request $request)
    {
        $selectedIds = $request->input('equipment_ids');

        if (!$selectedIds || !is_array($selectedIds)) {
            return back()->with('error', 'No equipment selected.');
        }
        $selectedEquipment = DB::table('equipment')
        ->whereIn('id', $selectedIds)
        ->get();

        $user = auth()->user();

        return view('request_equipment', compact('selectedEquipment', 'user'));
    }


    public function submit(Request $request)
    {
        $selectedIds = $request->input('selected');
        $purpose = $request->input('purpose');
        $return_date = Carbon::parse($request->input('return_date'))->format('F j Y');
        $student_id = $request->input('student_id');

        if (!$selectedIds || !is_array($selectedIds)) {
            return back()->with('error', 'No equipment selected.');
        }
        $borrowedEquipment = DB::table('equipment')
            ->join('rooms', 'equipment.room_id', '=', 'rooms.id')
            ->whereIn('equipment.id', $selectedIds)
            ->select('equipment.*', 'rooms.name as room_name')
            ->get();
        // $borrowedEquipment = DB::table('equipment')
        //     ->whereIn('id', $selectedIds)
        //     ->get();
        $today = Carbon::now()->format('F j Y');
        $user = auth()->user();

        

        return view('request_equipment', compact('borrowedEquipment', 'user', 'purpose', 'return_date', 'student_id', 'today'));
    }
    public function request(Request $request)
    {
        $formattedBorrowed = Carbon::parse($request->input('borrowed_date'))->format('Y-m-d');
        $formattedReturn = Carbon::parse($request->input('return_date'))->format('Y-m-d');


        $selectedEquipment = $request->input('equipment');
        foreach($selectedEquipment as $e){
            Borrowing::create([
            'id' => Str::uuid(),
            'borrower' => $request->input('borrower'),
            'equipment' => $e,
            'borrowed_date' => $formattedBorrowed,
            'return_date' => $formattedReturn,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }

        Audit::create([
            'user_type' => Borrowing::class,
            'user_id' => Auth::id(),
            'event' => 'request to borrow equipment',
            'auditable_type' => null,
            'auditable_id' => null,
            'old_values' => [],
            'new_values' => ['status' => 'Borrow Equipment'],
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => 'Borrow'
        ]);
      


        // $borrowing->auditEvent('request to borrow equipment');
        return redirect()->route('request')->with('success', 'Borrowing request submitted successfully!');

    }
}
