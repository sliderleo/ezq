<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use Brian2694\Toastr\Facades\Toastr;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields= $request->validate([
            'username'=>'required|max:255|min:4|unique:users,username',
            'name'=>'required|max:255|min:4',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed',
            'nric'=>'required|min:12|max:12|unique:users,nric',
            'contact'=>'required|unique:users,contact',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'nric' => $fields['nric'],
            'contact' => $fields['contact'],
        ]);

        $token = $user->createToken('ezq')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }

    public function login(Request $request){
        $fields= $request->validate([
            'username'=>'required|max:255|min:4',
            'password'=>'required|string|min:8',
        ]);
        $user = User::where('username',$fields['username'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>'Invalid Credentials!',
            ],401);
        }

        $token = $user->createToken('ezq')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Logged Out'
        ];
    }
}
