<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function profile()
    {
        return view('seller.profile');
    }
    public function changePassword(Request $request)
    {
        $input = $request->all();
        $validator = $this->validatePassword($input);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $user = DB::table('users')->where([
                'id' => Auth()->user()->id
            ])->first();

            $currentPassword = $user->password;

            // validate if inputed password same with current password
            if (Hash::check($input['current-password'], $currentPassword)) {
                $userId = Auth()->user()->id;

                DB::table('users')->where('id', $userId)
                    ->update([
                        'password' => Hash::make($input['new-password'])
                    ]);
                return redirect()->back()->with('success', 'Password succesfully changed');
            } else {
                return redirect()->back()->with('error', 'Wrong Password');
            }
        }
    }
    public function validatePassword(array $input)
    {

        // validating user input
        $rules = [
            'current-password' => 'required|string',
            'new-password' => 'required|string|min:8', //|,confirmed',
        ];
        $message = [
            // 'confirmed' => 'Password confirmation is wrong'
        ];
        $attributes = [
            'new-password' => 'New Password'
        ];
        $validator = Validator::make($input, $rules, $message, $attributes);

        return $validator;
    }
}
