<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\TrackingLog;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use App\Models\User;
use Auth;
use Datatables;
use OmiseAccount;

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

    public function package()
    {
        $packages = DB::table('packages')
            ->get();
        return view('seller.package', compact('packages'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {

            if (isset($request->id) && $request->id != null) {
                $data = Package::where([
                    'id' => $request->id
                ])->first();

                $id = $request->id;

                return view('elements.form-update-package', compact(['data', 'id']));
            }


            $data = package::orderBy('id', 'desc')->get();


            $table = Datatables::of($data)
                ->addColumn('price', function ($row) {
                        return '$ '.$row->price;
                })
                ->addColumn('package_type', function ($row) {
                    if($row->package_type == 1)
                    {
                        return 'Daily';
                    }
                    else
                    {
                        return 'Monthly';
                    }
                })
                ->addColumn('manage', function ($row) {
                    return '<span x-on:click=" showEditModal=true"class="modal-open bg-green-500 text-white rounded px-2 py-1 mr-4 capitalize cursor-pointer" data-id="' . $row->id . '" id="BtnUpdate">Edit</span><span class="bg-red-500 text-white rounded px-2 py-1 capitalize cursor-pointer" data-id="' . $row->id . '" id="BtnDelete">Delete</span>';
                })
                
                ->rawColumns(['manage'])
                ->make(true);
            return $table;
        }
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Package::create([
            'package_name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'max_limit' => $request->max_limit,
            'package_type' => $request->package_type
        ]);

        return redirect()->back()->with('success', 'Package successfully created');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|',
            'price' => 'required',
        ],);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('packages')
            ->where('id', $request->id)
            ->update([
                'package_name' => $request->name,
                'price' => $request->price,
                'details' => $request->details,
                'max_limit' => $request->max_limit,
                'package_type' => $request->package_type
            ]);

        if ($request->password) {
            return $this->changePassword($request);
        }

        return redirect('/package')->with('success', 'Package successfully updated');
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Field id is required'
            ]);
        } else {

            DB::table('packages')->where([
                'id' => $request->id
            ])->delete();

            return [
                'status' => 1
            ];
        }
    }

    public function TrackId(Request $request)
    {
       $userLimit = Auth::user()->max_limit;
       $userStartDate = Auth::user()->package_start_date;
       $userEndDate = Auth::user()->package_end_date;
       $today = date('Y-m-d',strtotime('today'));
       $trackingLogs = TrackingLog::where('seller_id',Auth::user()->id)->where('date',$today)->get();
       $trackinLogCount = count($trackingLogs);
        //    dump($userLimit);
        //    dump($trackinLogCount);
        //    exit;
            if(($userEndDate>$today))
            {
                if($userLimit > $trackinLogCount)
                {
                    $orderDetails = Order::where('tracking_id',$request->track_id)->first();

                    if(!isset($orderDetails) && empty($orderDetails))
                    {
                        return redirect()->back()->with('danger', "Invalid Tracking id Or tracking id is not exist on your database."); 
                    }
                    else{
                        $trackingLog = new TrackingLog();
                        $trackingLog->seller_id = Auth::user()->id;
                        $trackingLog->date = $today;
                        $trackingLog->track_id = $request->track_id;
                        $trackingLog->save();
                    return redirect()->back();
                    }
                }
                else{
                    return redirect()->back()->with('danger', "Today's user Search Limit is over. Please update your plan.");
                }

            }
        
        //    if($userLimit>0)
        //    {
        //         $orderDetails = Order::where('tracking_id',$request->track_id)->first();

        //         if(!isset($orderDetails) && empty($orderDetails))
        //         {
        //             return redirect()->back()->with('danger', "Invalid Tracking id Or tracking id is not exist on your database."); 
        //         }

        //    }
       return redirect()->back()->with('danger', "User Search Limit is over. Please update your plan.");
    }

}
