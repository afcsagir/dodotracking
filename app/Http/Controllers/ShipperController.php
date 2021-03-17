<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Datatables;

class ShipperController extends Controller
{
    public function index()
    {
    	return view('admin.manage-shipper');
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'Column name is required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInpu();
        }

        DB::table('shippers')->insert([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Data successfully created');
    }

    public function data(Request $request)
    {
    	// if ($request->ajax()) {

        if (isset($request->id) && $request->id != null) {
            $data = DB::table('shippers')
            ->where([
                'id' => $request->id
            ])->first();

            $id = $request->id;

            return view('elements.form-update-shipper', compact(['data', 'id']));
        }


        $data = DB::table('shippers')
                    // ->where('date', today('Asia/Jakarta')->toDateString())
        ->orderBy('id', 'desc')
        ->get();


        $table = Datatables::of($data)
        ->addColumn('manage', function ($row) {
            return '<span x-on:click=" showEditModal=true"class="modal-open bg-green-500 text-white rounded px-2 py-1 mr-4 capitalize cursor-pointer" data-id="' . $row->id . '" id="BtnUpdate">Edit</span><span class="bg-red-500 text-white rounded px-2 py-1 capitalize cursor-pointer" data-id="' . $row->id . '" id="BtnDelete">Delete</span>';
        })
        ->rawColumns(['manage'])
        ->make(true);
        return $table;
        // }
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
        }

        $orders = DB::table('orders')->where('shipper_id',$request->id)->count();

        if ($orders > 0) {
            return [
                'status' => 2,
                'failed' => 'Data failed deleted'
            ];
        }

        DB::table('shippers')->where('id',$request->id)->delete();

        return [
            'status' => 1
        ];
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ], [
            'id.required' => 'Column id is required',
            'name.required' => 'Column name is required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInpu();
        }

        DB::table('shippers')->where('id',$request->id)->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Data successfully updated');
    }
}
