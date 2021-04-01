<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BulkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $shipper_id = Session::get('shipper_id');
        if($row[0] != "name")
        {
            $today_date = date('Y-m-d');

            $total_tracking_orders = DB::table('orders')
              ->where('orders.seller_id', Auth::user()->id)
              ->whereDate('orders.date', $today_date)
              ->get();
    
              
    
              if(!empty(Auth::user()->package_id)){
                  $this_users_limit = DB::table('packages')
                      ->where('packages.id', Auth::user()->package_id)
                      ->first();
    
                    if(count($total_tracking_orders) <  $this_users_limit->max_limit){
    
                        DB::table('orders')->insert([
                            'shipper_id' => $shipper_id,
                            'tracking_id' => $row[1],
                            'buyer' => $row[0],
                            'seller_id' => Auth::user()->id,
                            'input_method' => 'import',
                            'date' => today('Asia/Jakarta')->toDateString(),
                            'time' => now('Asia/Jakarta')->toTimeString()
                        ]);
                    }
                }
      
        }

    }

    public function dateFormate($date)
    {
        if(is_numeric($date))
        {
            $UNIX_DATE = ($date - 25569) * 86400;
            $date_column = gmdate("Y-m-d H:i:s", $UNIX_DATE);
            return $date_column;
        }
    }
}
