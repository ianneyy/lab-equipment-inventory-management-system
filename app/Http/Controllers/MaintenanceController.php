<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;
use App\Models\Maintenance;
class MaintenanceController extends Controller
{
    public function read()
    {
        if (auth()->user()->roles !== 'admin') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }
        $maintenance = DB::table('maintenance')
            ->get();
        $pending = DB::table('maintenance')
        ->where('status','Pending')
            ->get();

        $technician = DB::table('users')
            ->where('roles', 'technician')
            ->get();

        $inprogress = DB::table('maintenance')
            ->where('status', 'In Progress')
            ->get();
        $completed = DB::table('maintenance')
            ->where('status', 'Completed')
            ->get();

        $countCompleted = DB::table('maintenance')
            ->where('status', 'Completed')
            ->count();
        $countPending = DB::table('maintenance')
            ->where('status', 'Pending')
            ->count();

        $countTechnician = DB::table('users')
            ->where('roles', 'technician')
            ->count();
        $countRequest = DB::table('maintenance')
            ->count();

        $maintenanceJson = $maintenance->toJson();

        return view('maintenance', compact('maintenanceJson', 'pending', 'technician', 'inprogress', 'completed', 'countCompleted', 'countPending', 'countTechnician', 'countRequest'));

    }
     public function complete($id)
    {


        $maintenance = Maintenance::find($id);
        if (!$maintenance) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $maintenance->status = 'Completed';
        $maintenance->save(); // This triggers the audit

        return redirect()->back()->with('success', 'Status updated successfully.');

    }
    public function assign(Request $request, $id)
    {
        $tech_name = $request->input('tech_name');

        DB::table('maintenance')
        ->where('id', $id) // Assuming the 'id' here is the maintenance record's unique ID
        ->update([
            'tech_assigned' => $tech_name,
            'status' => 'In Progress'
        ]);

        Audit::create([
            'user_type' => User::class,
            'user_id' => Auth::id(),
            'event' => 'Assigned technician: ' . $tech_name,
            'auditable_type' => null,
            'auditable_id' => null,
            'old_values' => ['status' => 'No Technician Assigned'],
            'new_values' => ['status' => 'Technician Assigned'],
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => 'assign'
        ]);

        return back()->with('success', 'Technician assigned successfully.');
    }
}
