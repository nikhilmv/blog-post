<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Employee;
use App\Models\Company;

class UserController extends Controller
{



        /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        // Check email exist
        $user = User::where('email', $request->email)->first();

        // Check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
                ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'access_token' => $token,
            'token_type' => 'Bearer',

        ];

        return response()->json($response, 200);
    }



    public function getUserInformation(Request $request){
        $data = Employee::with('company')->get()->toArray();
        if($data != null){
            return response()->json($data, 200);
        }
    }



}
