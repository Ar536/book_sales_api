<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //Register a new user.

    public function register(Request $request){
        // SETUP VALIDATOR
        $validator = Validator::make($request->all(), [
            "name" => "required|string|Max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]); 

        // CHECK VALIDATOR
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // CREATE USER
        $user = User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => bcrypt($request ->password) // admin345 | adwoqoo273827190islklqsl! enkripsi otomatis password
        ]);

        // RETURN RESPONSE JSON USER IS CREATED
        if ($user){
            return response()->json([ //ketika berhasil
                "success" => true,
                "message" => "User created succesfully",
                "data" => $user
            ], 201);
        }
        
        //RETURN RESPONSE IF PROCESS FAILED
        return response()->json([ //ketika berhasil
            "success" => false,
            "message" => "User created failed"
        ], 409);// CONFLICT
    }

    //LOGIN USER
    public function login(Request $request){
        // SETUP VALIDATOR
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string"
        ]); 

        // CHECK VALIDATOR
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // GET CREDENTIALS FROM REQUEST
        $credentials = $request->only('email', 'password');

        //IF AUTH FAILED
        if(!$token = auth()->guard('api')->attempt($credentials)){
            return response()->json([ 
                "success" => false,
                "message" => "Email atau Password Anda Salah!"
            ], 401);
        }

        //IF AUTH SUCCESS
        return response()->json([ 
            "success" => true,
            "message" => "Login successfully",
            "data" => auth()->guard('api')->user(),
            "token" => $token
        ], 200);
    }

    /** 
     * LOGOUT USER AND INVALIADATE TOKEN
    */
    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            // IF LOGOUT SUCCESS
            return response()->json([ 
                "success" => true,
                "message" => "Logout successfully!",
            ], 200);

        } catch (JWTException $e) {  
            // IF LOGOUT FAILED
            return response()->json([ 
                "success" => false,
                "message" => "Logout failed!",
            ], 500);
        }
    }
    
}
