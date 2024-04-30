<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                ]
            );
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'User created successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
<<<<<<< HEAD

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error validasi',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & kata sandi tidak cocok dengan catatan kami'
                ], 401);
            }

            if ($user->status === User::STATUS_PENDING) {
                return response()->json([
                    'status' => false,
                    'message' => 'Akun Anda sedang menunggu persetujuan',
                    'data' => [
                        'status' => 'pending',
                        'token' => $user->createToken("API Token")->plainTextToken
                    ]
                ], 200);
            }

            if ($user->status === User::STATUS_REJECTED) {
                return response()->json([
                    'status' => false,
                    'message' => 'Akun Anda telah ditolak',
                    'data' => [
                        'status' => 'rejected'
                    ]
                ], 403);
            }

            return $this->loginSuccessResponse($user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
=======
    
    public function status(){
        $userData = auth()->user();
        return response()->json([
            'status'=> true,
            'message' => 'Waiting for user decision',
            'data' => $userData,
            'buttons' => [
                'accept' => true, 
                'reject' => true
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
    public function accept(){
    return redirect('/dashboard');
>>>>>>> c3c3739f4c190dc7a2315b97474d09e65efd52fc
    }

    public function getUserData()
    {
        try {
            $user = User::where('status', User::STATUS_PENDING)->get();
            return response()->json([
                'status' => true,
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function acceptAccount(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->markAccountAsAccepted($user);
            return response()->json([
                'status' => true,
                'message' => 'Account accepted successfully',
                'data' => [
                    'status' => 'accepted'
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function rejectAccount(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->markAccountAsRejected($user);
            return response()->json([
                'status' => false,
                'message' => 'Account rejected successfully',
                'data' => [
                    'status' => 'rejected'
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    private function markAccountAsAccepted($user)
    {
        $user->status = User::STATUS_ACCEPTED;
        $user->save();
    }

    private function markAccountAsRejected($user)
    {
        $user->status = User::STATUS_REJECTED;
        $user->save();
    }

    public function loginSuccessResponse($user)
    {
        return response()->json([
            'status' => true,
            'email' => $user->email,
            'message' => 'Log in successful',
            'token' => $user->createToken("API Token")->plainTextToken,
            'data' => [
                'status' => 'accepted'
            ]
        ], 200);
    }

    public function checkAccountStatus(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pengguna tidak terotentikasi.',
                ], 401);
            }

            if ($user->status === User::STATUS_PENDING) {
                return response()->json([
                    'status' => true,
                    'message' => 'Status akun: Menunggu persetujuan',
                    'data' => [
                        'status' => 'pending'
                    ]
                ], 200);
            } elseif ($user->status === User::STATUS_REJECTED) {
                return response()->json([
                    'status' => false,
                    'message' => 'Akun Anda telah ditolak',
                    'data' => [
                        'status' => 'rejected'
                    ]
                ], 403);
            } elseif ($user->status === User::STATUS_ACCEPTED) {
                return response()->json([
                    'status' => true,
                    'message' => 'Akun Anda telah disetujui',
                    'data' => [
                        'status' => 'accepted'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Status akun tidak valid.',
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function profile()
    {
        $userData = auth()->user();
        return response()->json([
            'status' => true,
            'message' => 'User Verification Complete',
            'data' => $userData,
            'id' => auth()->user()->id
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Log out success'
        ]);
    }
}