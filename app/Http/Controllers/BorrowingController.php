<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
     public function read()
    {
        if (auth()->user()->roles !== 'admin') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }
        $borrowing = DB::table('borrowing')
        ->get();
        $borrowingJson = $borrowing->toJson();

        return view('borrowing', compact('borrowingJson'));

    }

    public function reject($id)
    {
        $updated = DB::table('borrowing')
        ->where('id', $id)
        ->update(['status' => 'Rejected']);


        if ($updated) {
            return response()->json([
                'message' => 'Status updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update status.'
            ], 400);
        }

    }
    public function approve($id)
    {
        $updated = DB::table('borrowing')
            ->where('id', $id)
            ->update(['status' => 'Approved']);


        if ($updated) {
            return response()->json([
                'message' => 'Status updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update status.'
            ], 400);
        }

    }
    public function returned($id)
    {
        $updated = DB::table('borrowing')
            ->where('id', $id)
            ->update(['status' => 'Returned']);


        if ($updated) {
            return response()->json([
                'message' => 'Status updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update status.'
            ], 400);
        }

    }
}
