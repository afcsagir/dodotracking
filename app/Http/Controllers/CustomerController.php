<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function TrackingDetails()
    {
       
        $geturl = request()->getHttpHost();
        $getUrlPrefix = explode('.', $geturl);

        if (count($getUrlPrefix) == 4) {
            $getSellerUsername = $getUrlPrefix[0];

            $username = str_replace('_', ' ', $getSellerUsername);

            $seller = User::where('username', $username)->where('role','member')->where('is_active', 1)->first();
         
            if (isset($seller)) {   
                $userLogo = $seller->logo;
                return view('customer.track-id-list',compact('userLogo','seller'));
            }

            abort(403);
        }
        else if (count($getUrlPrefix) == 3) {
            return redirect('/signin');
        }
    }
}
