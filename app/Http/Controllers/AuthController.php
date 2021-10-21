<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{

    public function signup(Request $request){

        	$validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string'

            ]);        

     if (!$validator->fails()){

            $data=$request->all();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            $token = $user->createToken('usertoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token

            ];

            return response($response, 201);
        
        }else{

            return $validator->errors();

        }
}


    public function signin(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|string',
        'password' => 'required|string'
        ]);        

     if (!$validator->fails())
       {

        $data=$request->all();

        // Check email
        $user = User::where('email', $data['email'])->first();

        // Check password
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Email or Password is incorrect'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }else{
        return $validator->errors();
    }
    
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    
}
