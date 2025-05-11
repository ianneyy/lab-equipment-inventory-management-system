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

        return view('dashboard', compact('totalBorrowed',
        'currentlyBorrowed',
        'pendingBorrowed',
        'overdueBorrowed',
        'activeBorrowing',
        'pendingBorrowing',
        'returnedBorrowing',
        'remainingDays'
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
}
