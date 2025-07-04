<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        return view('frontend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Invalid login credentials',
            ]);
        }

        /** @var User $user */
        $user = Auth::guard('web')->user();

        if ($user->hasRole('admin')) {
            Auth::guard('web')->logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Access is restricted. Please use the admin login page to sign in',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }



    /**
     * Display the login view.
     */

    public function createAdmin(): View
    {
        return view('backend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Invalid credentials or you do not have permission to access',
            ]);
        }

        /** @var User $user */
        $user = Auth::guard('admin')->user();

        if (!$user->hasRole('admin')) {
            Auth::guard('admin')->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Access is restricted. Please use the user login page to sign in',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::DASHBOARD);
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



      public function destroyAdmin(Request $request): RedirectResponse
    {

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
