<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ((bool)Auth::user()->is_active) {


            if (Auth::user()->role == 'admin') {
                return redirect('admin/dashboard')->with('success','Welcome to dodotracking');
            }

            // $company_name = 'hello';
            // if (isset(Auth::user()->username)) {
            //     $company_name = str_replace(' ', '_', Auth::user()->username);
            // }

            // $url = 'http://' . $company_name . '.shaheedrafiqmkj.edu.bd/dodotracking/public/dashboard';

            return redirect()->intended(RouteServiceProvider::HOME)->with('success','Welcome to dodotracking');
        }

        Auth::logout();

        return redirect()->back()->with('failed', 'Your account was suspended');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/signin');
        //    return redirect('http://shaheedrafiqmkj.edu.bd/dodotracking/public/signin');
    }
}
