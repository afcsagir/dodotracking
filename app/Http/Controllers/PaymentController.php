<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OmiseCharge;
use OmiseObject;



class PaymentController extends Controller
{
    public function packagePayment(Request $request){
        define('OMISE_PUBLIC_KEY', 'pkey_test_5napb06l501v08zuy8t');
        define('OMISE_SECRET_KEY', 'skey_test_5n9jppbazjgxsmzjhzk');
        $data = OmiseCharge::create(array(
            'amount'=>10000,
            'currency'=>'thb',
            'card'=>$request->omiseToken,
        ));

        dd($data);

    }
}
