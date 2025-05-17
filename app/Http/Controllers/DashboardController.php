<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;
use OwenIt\Auditing\Models\Audit;
class DashboardController extends Controller
{
    public function index()
    {


        $totalBorrowed = DB::table('borrowing')
        ->where('borrower', auth()->user()->name)
        ->count();
        $currentlyBorrowed = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Approved')
            ->count();
        $pendingBorrowed = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Pending')
            ->count();

        $overdueBorrowed = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Overdue')
            ->count();

        $borrowed_date = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Approved')
            ->value('borrowed_date');
        $return_date = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Approved')
            ->value('return_date');

        $borrowed = Carbon::parse($borrowed_date);
        $return = Carbon::parse($return_date);
        $remainingDays = $borrowed->diffInDays($return);

        $activeBorrowing = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Approved')
            ->get();
        $pendingBorrowing = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Pending')
            ->get();
        $returnedBorrowing = DB::table('borrowing')
            ->where('borrower', auth()->user()->name)
            ->where('status', 'Returned')
            ->get();



        $locationData = DB::table('equipment')
            ->join('rooms', 'equipment.room_id', '=', 'rooms.id')
            ->select('rooms.name as location', DB::raw('count(equipment.id) as total'))
            ->groupBy('rooms.name')
            ->get();

        $labels = $locationData->pluck('location');
        $counts = $locationData->pluck('total');


        $audits = Audit::with('user')
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($audit) {
            $userID = $audit->user_id;

            $user = DB::table('users')
                ->where("id", $userID)
                ->first(['name', 'roles']);

            return [
                'id' => $audit->id,
                'user' => $user ? $user->name : 'Unknown',
                'user_role' => $user ? $user->roles : 'Unknown',
                'event' => $audit->event,
                'old_values' => $audit->old_values,
                'new_values' => $audit->new_values,
                'created_at' => $audit->created_at->toDateTimeString(),
            ];
        });
        // $auditsJson = $audits->toJson();


        $taskCount = DB::table('maintenance')
        ->count();
        $pendingTask = DB::table('maintenance')
        ->where('status', 'Pending')
            ->count();

        $inProgressTask = DB::table('maintenance')
            ->where('tech_assigned', auth()->user()->name)
            ->where('status', 'In Progress')
            ->count();
        $completedTask = DB::table('maintenance')
            ->where('tech_assigned', auth()->user()->name)
            ->where('status', 'Completed')
            ->count();

        $assignedTask= DB::table('maintenance')
            ->where('tech_assigned', auth()->user()->name)
            ->where('status', 'In Progress')
            ->get();

        $pendingRequest = DB::table('maintenance')
            ->where('status', 'Pending')
            ->get();

        return view('dashboard', compact('totalBorrowed',
        'currentlyBorrowed',
        'pendingBorrowed',
        'overdueBorrowed',
        'activeBorrowing',
        'pendingBorrowing',
        'returnedBorrowing',
        'remainingDays',
        'labels',
        'counts',
        'audits',
        'taskCount',
        'pendingTask',
        'inProgressTask',
            'completedTask',
            'assignedTask',
            'pendingRequest',
        ));
    }

    public function issue(Request $request)
    {
        
        DB::table('maintenance')
        ->insert([
            'id' => Str::uuid(),
            'equipment' => $request->input('equipment'),
            'issue' => $request->input('issue'),
            'date_reported' => now(),
            'status' => 'Pending',
            'created_at' => now(),
        ]);
        return back()->with('success', 'Your repair issue has been successfully submitted.');

    }
    public function accept($id)
    {
        DB::table('maintenance')->
        where('id', $id)
        ->update([
            'status' => 'In Progress',
            'tech_assigned' => auth()->user()->name,
        ]);
        return back()->with('success', 'You have successfully accepted the task. The repair issue is now marked as In Progress.');
    }
}
