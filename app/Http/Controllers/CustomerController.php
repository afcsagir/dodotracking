<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function TrackingDetails()
    {
       
        // $geturl = request()->getHttpHost();
        // $getUrlPrefix = explode('.', $geturl);

        // if (count($getUrlPrefix) == 4) {
        //     $getSellerUsername = $getUrlPrefix[0];

        //     $username = str_replace('_', ' ', $getSellerUsername);

        //     $seller = User::where('username', $username)->where('role','member')->where('is_active', 1)->first();
         
        //     if (isset($seller)) {   
        //         $userLogo = $seller->logo;
                // return view('customer.track-id-list',compact('userLogo','seller'));
                return view('customer.track-id-list');
        //     }

        //     abort(403);
        // }
        // else if (count($getUrlPrefix) == 3) {
        //     return redirect('/signin');
        // }
    }

    public function trackIdReq(Request $request)
    {
        if(isset($request->name) && isset($request->date))
        {
            $name = $request->name;
            $date = date('Y-m-d',strtotime($request->date));
            $data = Order::Where('buyer', 'like', '%' . $name . '%')->where('date',$date)->with('shipper')->get();
            if(isset($request->seller_id))
            {
                $seller = User::find($request->seller_id);
                $userLogo = $seller->logo;
                return redirect()->back()->with(['data' => $data,'seller'=>$seller,'userLogo'=> $userLogo]);
            }
    
            return redirect()->back()->with(['data' => $data]);
        }

        return redirect()->back()->with('error','Please Insert valid input');
    }
}
