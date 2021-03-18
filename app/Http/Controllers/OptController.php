<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptController extends Controller
{
    public function verifyMobile()
    {
        return view('otp.verifyOtp');
    }
    public function forgetPassword()
    {
        return view('otp.enterPhoneNumber');
    }
    public function resetPassword()
    {
        return view('otp.resetPassword');
    }
}
