<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|exists:users,email',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {

            return BaseController::msg(0, $validator->getMessageBag(), 422);
        }

        $user = User::whereEmail($request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return BaseController::msg(1, 'Login Successfully', 200, $request->user());
            }else {
                return BaseController::msg(1, 'Password does not match', 404);
            }
        }else {
            return BaseController::msg(1, 'There is no user found', 404);
        }

        // if(Auth::attempt($request->all())) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Login Successfully',
        //         'user' => $request->user()
        //     ], 200);
        // }
    }

}
