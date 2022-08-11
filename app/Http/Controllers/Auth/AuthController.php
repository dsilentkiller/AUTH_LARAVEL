<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public  function register(Request $request){

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
        $data  = $request->all();
        $check = $this->create($data);
        return redirect('dashboard')->withSuccess('your Registration sucessfully completed!');
    }
// ?registration create data

    public function create(array $data){
        $user = User::create([
            'username'=> $data['username'],
            'name' => $data['name'],
            'email'=>$data['email'],
            'phone_no'=>$data['phone_no'],
            'age' =>$data['age'],
            'gender'=>$data['gender'],
            'password' => Hash::make($data['password']),
            'profile_image' =>$data['profile'],
            // 'confirm_password'=
        ]);
    }
            public function login(Request $request){
                $request->validate([
                    'email' => 'required',
                    'password'=> 'required',  
                ]);
            $credintials = $request->only('email', 'password');
            if(Auth::attemt($credintials)){
                return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
            }
            return redirect('login')->withSuccess('Login details are not Valid');
                
            }

            public function index(){
                return view('auth.login');
            }

            public function dashboard(){
                return view('dashboard');
            }
        
        }

