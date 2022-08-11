<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }

        // public function create(){
        //     $user = User::create([
        //         'username'=> $request->username,
        //         'name' => $request->name,
        //         'email'=>$request->email,
        //         'phone_no'=>$request->phone_no,
        //         'age' =>$request->age,
        //         'gender'=>$request->gender,
        //         'password' => Hash::make($request->password),
        //         // 'confirm_password'=
        //     ]);
        // }
    public function store(){

        $request->validate([
            'username' =>'required|string|max:255',
            'name' => 'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'phone_no'=>'required|min:11|numeric',
            'age'=>'required|numeric',
            'gender'=> 'required|in:male,female',
            'password'=> 'required|string|min:8|confirmed',
            'confirm_password'=> 'required|string|min:8|confirmed|matches',
            
            'profile_image'=>'image|mimes:jpeg,png,pdf,jpg,gif,svg|max:2048',

        ]);
        $user = User::create([
            'username'=> $request->username,
            'name' => $request->name,
            'email'=>$request->email,
            'phone_no'=>$request->phone_no,
            'age' =>$request->age,
            'gender'=>$request->gender,
            'password' => Hash::make($request->password),
            'profile_image' =>$request->profile
            // 'confirm_password'=
        ]);
      
    }
}
