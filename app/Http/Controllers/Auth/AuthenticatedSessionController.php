<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        // if (request()->routeIs('admin.login')) {
        //     return view('backend.pages.auth.login');
        // }

        if (request()->routeIs('admin.login')) {
            return view('backend.pages.auth.login');
        }




        return view('frontend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */



    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();


        $request->session()->regenerate();
        /** @var User $user */

        $user = Auth::user();


        // dd(request());
        
        $isAdminLoginRoute = request()->routeIs('admin.login.post');
        $isUserLoginRoute = request()->routeIs('login');

        dd($isAdminLoginRoute);


        // منع الأدمن من الدخول عبر صفحة المستخدم العادي

        if ($user->hasRole('admin') && $isUserLoginRoute) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Please log in through the admin login page only',
            ]);
        }


        // منع المستخدم العادي من الدخول عبر صفحة الأدمن
        if (!$user->hasRole('admin') && $isAdminLoginRoute) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Please log in through the user login page only',
            ]);
        }

        // توجيه حسب الدور
        if ($user->hasRole('admin')) {
            // dd("here");
            return redirect()->route('admin');
        }

        return redirect()->route('home');
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
