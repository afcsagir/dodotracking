<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Datatables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function product()
    {
        $products = DB::table('products')
            ->get();
        return view('seller.product', compact('products'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {

            if (isset($request->id) && $request->id != null) {
                $data = product::where([
                    'id' => $request->id
                ])->first();

                $id = $request->id;

                return view('elements.form-update-package', compact(['data', 'id']));
            }


            $data = product::orderBy('id', 'desc')->get();


            $table = Datatables::of($data)
         
                ->addColumn('image', function ($row) {
                    return '<img src="'.asset($row->image).'" height="60" weight="50" >';
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
            'product_name' => 'required',
            'product_code' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new Product();
        $data->product_name = $request->product_name;
        $data->category_id = $request->category_id;
        $data->product_code = $request->product_code;
        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('uploads/product');
            $upload->move($destinationPath, $upload_name);
            $data->image = 'uploads/product/'.$upload_name;
        }
    
        $result = $data->save();

        if ($result) {
            return redirect()->back()->with('success', 'Product successfully created');
        } else {
            return redirect()->back()->with('error', 'Wrong Password');
        }

       
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required'
        ],);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = product::find($request->id);
        $data->product_name = $request->product_name;
        $data->category_id = $request->category_id;
        $data->product_code = $request->product_code;
        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('uploads/product');
            $upload->move($destinationPath, $upload_name);
            $data->image = 'uploads/product/'.$upload_name;
        }
    
        $result = $data->save();

        if ($result) {
            return redirect('/seller/product')->with('success', 'Product successfully Updated');
        } else {
            return redirect('/seller/product')->with('error', 'Wrong Password');
        }
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

            DB::table('products')->where([
                'id' => $request->id
            ])->delete();

            return [
                'status' => 1
            ];
        }
    }

 
}
