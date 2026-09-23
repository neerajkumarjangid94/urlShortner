<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        //if super admin then redirect on company listing page.
        if (auth()->user()->role->name === Role::SUPER_ADMIN) {
            return redirect()->route('company.companylistings');
        }

         //if  admin then redirect on company listing page.
        if (auth()->user()->role->name === Role::ADMIN) {
            return redirect()->route('admin.dashboard');
        }

          //if  admin then redirect on company listing page.
        if (auth()->user()->role->name === Role::MEMBER) {
            return redirect()->route('member.dashboard');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
