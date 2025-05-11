<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\DB;
class AuditsController extends Controller
{
    public function index(){

        if (auth()->user()->roles !== 'admin') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }

        $audits = Audit::with('user')->latest()->get()->map(function ($audit) {
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
        $auditsJson = $audits->toJson();
        return view('audits', compact('auditsJson'));
    }
}
