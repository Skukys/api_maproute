<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
        ]);

        if ($validation->fails())
            return $this->validationError($validation->errors());

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $this->MessageResponse('success register');
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
        ]);

        if ($validation->fails())
            return $this->validationError($validation->errors());

        $user = User::where('email', $request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            return response([
                'body' => [
                    'token' => $user->generateToken()
                ]
            ]);
        }

        $this->MessageResponse('incorrect password or login', 402);
    }

    public function logout(Request $request)
    {
        $request->user->logout();
        return $this->MessageResponse('success logout');
    }
}
