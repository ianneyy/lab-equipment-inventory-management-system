<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use OwenIt\Auditing\Models\Audit;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        Audit::create([
            'user_type' => Auth::user()::class,
            'user_id' => Auth::id(),
            'event' => 'login',
            'auditable_type' => null,
            'auditable_id' => null,
            'old_values' => [],
            'new_values' => ['status' => 'Logged in'],
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => 'login'
        ]);
    
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Audit::create([
            'user_type' => Auth::user()::class,
            'user_id' => Auth::id(),
            'event' => 'logout',
            'auditable_type' => null,
            'auditable_id' => null,
            'old_values' => [],
            'new_values' => ['status' => 'Logged Out'],
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => 'logout'
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
