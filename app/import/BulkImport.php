<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;
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
            
            DB::table('orders')
            ->insert([
                'shipper_id' => $shipper_id,
                'tracking_id' => $row[1],
                'buyer' => $row[0],
                'input_method' => 'import',
                'date' => today('Asia/Jakarta')->toDateString(),
                'time' => now('Asia/Jakarta')->toTimeString()
            ]);
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
