<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getUsers(){
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }
    public function getUser($id){
        $user = User::find($id);
        if ($user) {
            return response()->json(['data' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function getToken(Request $request)
    {
        $credentials=\Validator::make(
                    $request->all(),
                    [
                        'email' => 'required|email:dns',
                        'password' => 'required',
                    ],
                    [
                        'email.required' => 'Email harus diisi',
                        'email.email' => 'Format email tidak valid',
                        'password.required' => 'Password harus diisi',
                    ]);
        if ($credentials->fails()) {
            return response()->json([
                'status' => false,
                'message' => $credentials->errors(),
            ], 422);
        }
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        }
        return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
            ], 401);


    }
}
