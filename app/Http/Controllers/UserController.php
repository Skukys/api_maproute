<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        if ($validation->fails())
            return $this->validationError($validation->errors());

        User::create($request->only(['password', 'name', 'email', 'role']));

        return response([
            'body' => [
                'message' => 'Success register'
            ]
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('name', $request->name)
            ->where('password', $request->password)
            ->first();
        if ($user) {
            $token = Str::uuid();
            $user->api_token = $token;
            $user->save();
            return response([
                'body' => [
                    'token' => $token,
                    'role' => $user->role
                ]
            ]);
        } else {
            return response([
                'body' => [
                    'message' => 'invalid login'
                ]
            ], 201);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user;
        $user->api_token = null;
        $user->save();
        return response([
            'body' => [
                'message' => 'logout success'
            ]
        ]);
    }
}
