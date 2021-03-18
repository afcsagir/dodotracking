<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'shop_id' => 'required|unique:users,shop_id|max:4|alpha',
            'username' => 'required|unique:users,username|string|max:255',
            'name' => 'required|string|max:255',
            'contactname' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'lineid' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            // 'shop_id' => '',
            'name' => $request->name,
            'username' => $request->username,
            'contactname' => $request->contactname,
            'phone' => $request->phone,
            'lineid' => $request->lineid,
            'email' => $request->email,
            'role' => 'member',
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        // $company_name = 'hello';
        // if (isset($user->username)) {
        //     $company_name = str_replace(' ', '_', $user->username);
        // }

        // $url = 'http://' . $company_name . '.shaheedrafiqmkj.edu.bd/dodotracking/public/signin';

        // return redirect()->intended($url);

        return redirect(RouteServiceProvider::HOME);
    }
}
