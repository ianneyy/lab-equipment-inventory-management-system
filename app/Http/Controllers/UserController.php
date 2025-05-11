<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use OwenIt\Auditing\Models\Audit;
class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles !== 'admin') {
            return redirect()->back()->with('error', 'Access denied. Admins only.');

        }
        $users = DB::table('users')
            ->orderBy('created_at', 'asc')
            ->get();
        $usersJson = $users->toJson();

        return view('users', compact('usersJson'));


    }

    public function destroy($id)
    {

         DB::table('users')
        ->where('id', $id)
            ->delete();

        return response()->json(['message' => 'User deleted successfully']);


    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:student,faculty/staff,technician,admin',
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'roles' => $validated['role'],
        ]);

        Audit::create([
            'user_type' => User::class,
            'user_id' => Auth::id(),
            'event' => 'Added a new user with role: ' . $validated['role'],
            'auditable_type' => null,
            'auditable_id' => null,
            'old_values' => [],
            'new_values' => [],
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => 'create'
        ]);

        return back()->with('success', 'User successfully added.');
    }

}
