<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OmiseCharge;
use OmiseObject;



class PaymentController extends Controller
{

    public function payment($id)
    {
        $package = Package::find($id);
        return view('seller.payment', compact('package'));
    }

    public function packagePayment(Request $request){
        define('OMISE_PUBLIC_KEY', 'pkey_test_5napb06l501v08zuy8t');
        define('OMISE_SECRET_KEY', 'skey_test_5n9jppbazjgxsmzjhzk');
        $data = OmiseCharge::create(array(
            'amount'=>$request->package_price*100,
            'currency'=>'usd',
            'card'=>$request->omiseToken,
        ));

        if($data['status'] == 'successful')
        {
            $payment = new Payment();
            $payment->package_id = $request->package_id;
            $payment->seller_id = Auth::user()->id;
            $payment->amount = $request->package_price;
            $payment->currency ='usd';
            $payment->payment_status =1;
            $payment->start_date =  Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $payment->end_date =  Carbon::now('Asia/Jakarta')->addMonth()->format('Y-m-d');
            $payment->save();

            $user = User::find(Auth::user()->id);
            $user->package_start_date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $user->package_end_date = Carbon::now('Asia/Jakarta')->addMonth()->format('Y-m-d');
            $user->package_id = $request->package_id;
            $user->save();
             
            return redirect('/payment-success')->with('success','Package Purchase Successfully');
        }
         return redirect('/payment-success')->with('failed','Something Worng Happened');
    }

    public function paymentSccuess()
    {
        return view('seller.payment_success');
    }
}
