<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            $validateUser = Validator::make($request ->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            if ($validateUser->fails()){
                return response()->json([
                    'status'=>false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json([
                'status'=>true,
                'user' => $user,
                'message' => 'User created successfully'
            ],200);
        }catch (\Throwable $th){
            return response()->json([
                'status'=>false,
                'message' => $th ->getMessage(),
            ],500);
        }
    }
    public function login(Request $request){
        try{
            $validateUser = Validator::make($request ->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validateUser->fails()){
                return response()->json([
                    'status'=>false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],422);
            }
            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status'=>false,
                    'message' => 'Email & password does not match with our record'
                ],401);
            }
            $user = User::where('email',$request->email)->first();
            return response()->json([
                'status'=>true,
                'message' => 'Log in successful',
                'token' => $user->createToken("API Token")->plainTextToken
            ],200);
            
        }catch (\Throwable $th){
            return response()->json([
                'status'=>false,
                'message' => $th ->getMessage(),
            ],500);
        }
    }
    public function status(){
        $userData = auth()->user();
        return response()->json([
            'status'=> true,
            'message' => 'Waiting for user decision',
            'data' => $userData,
            'buttons' => [
                'accept_url' => '/accept',
                'reject_url' => '/reject'
            ]
        ],200);
    }
    public function profile(){
        $userData = auth()->user();
        return response()->json([
            'status'=> true,
            'message' => 'User Verification Complete',
            'data' => $userData,
            'id'=>auth()->user()->id
        ],200);
    }
    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'status'=> true,
            'message' => 'User Logged Out',
            'data' => [],
        ],200);
    }
}