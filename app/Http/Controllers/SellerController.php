<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use App\Models\User;
use Auth;
use Datatables;




class SellerController extends Controller
{
    public function dashboard()
    {
       
        $user = Auth::user();

        $orders = $user->orders()
            ->whereBetween('date', [today('Asia/Jakarta')->subDays(6), today('Asia/Jakarta')])
            ->count();
        function dates($format)
        {
            $dates = [
                Carbon::now('Asia/Jakarta')->addDays(-6)->format($format),
                Carbon::now('Asia/Jakarta')->addDays(-5)->format($format),
                Carbon::now('Asia/Jakarta')->addDays(-4)->format($format),
                Carbon::now('Asia/Jakarta')->addDays(-3)->format($format),
                Carbon::now('Asia/Jakarta')->addDays(-2)->format($format),
                Carbon::now('Asia/Jakarta')->addDays(-1)->format($format),
                Carbon::now('Asia/Jakarta')->format($format)
            ];

            return $dates;
        }

        foreach (dates('Y-m-d') as $date) {
            $data[] = $user->orders()->where('date', $date)->count();
        }

        $dates = dates('d M');

        return view('seller.dashboard', compact(['data', 'dates', 'orders']));
    }
}
