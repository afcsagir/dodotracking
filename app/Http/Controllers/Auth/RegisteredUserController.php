<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SMS_ClASS\SMS;
use Tzsk\Otp\Facades\Otp;
use Session;
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
            'phone' => 'required|unique:users,phone|numeric',
            'lineid' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        $unique_secret = 'moinuddin';
        $otp = Otp::generate($unique_secret);

        // Auth::login($user = User::create([
        //     // 'shop_id' => '',
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'contactname' => $request->contactname,
        //     'phone' => $request->phone,
        //     'lineid' => $request->lineid,
        //     'email' => $request->email,
        //     'role' => 'member',
        //     'otp' => $otp,
        //     'is_active' => 0,
        //     'password' => Hash::make($request->password),
        // ]));

      
        
        Session::put('user_phone',$request->phone);
      
        $response = $this->sendOtp($request->phone,$otp);
       
        if($response)
        {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->contactname = $request->contactname;
            $user->phone = $request->phone;
            $user->lineid = $request->lineid;
            $user->email = $request->email;
            $user->role = 'member';
            $user->otp = $otp;
            $user->is_active = 0;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('verify_mobile');
        }
        else
        {
            return redirect()->back()->with('failed',"Ops somethings happened. Please try Again");
        }
        // event(new Registered($user));

        // $company_name = 'hello';
        // if (isset($user->username)) {
        //     $company_name = str_replace(' ', '_', $user->username);
        // }

        // $url = 'http://' . $company_name . '.shaheedrafiqmkj.edu.bd/dodotracking/public/signin';

        // return redirect()->intended($url);

        // return redirect(RouteServiceProvider::HOME);


    }

    public function sendOtp($mobile,$otp)
    {
        $apiKey = '02a756f62c6e6ba391f9680e48814361';
        $apiSecretKey = '0dba9623cacdbeab28c8a84510c1e1bf';
        
        $sms = new SMS($apiKey, $apiSecretKey);
        $body = [
            'msisdn' => $mobile,
            'message' => "Dodo tracking mobile verification. OTP : ".$otp,
            // 'sender' => '',
            // 'scheduled_delivery' => '',
            // 'force' => ''
        ];
       $res = $sms->sendSMS($body);
        
        if ($res->httpStatusCode == 201) {
            return true;
        } else {
          return false;
        }
    }
    
}
