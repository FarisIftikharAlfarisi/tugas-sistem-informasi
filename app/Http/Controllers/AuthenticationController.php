<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function signin()
    {
        return view('authentication.login',['title'=>'Sign In']);
    }
    public function create_account()
    {
        return view('authentication.createaccount',['title'=>'Create Account']);
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('Error','Username atau password salah');
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(auth()->attempt($data)){
            //if user is role level 1
            $request->session()->regenerate();
            if(auth()->user()->role === 'Admin'){
                return redirect()->route('dashboard_manager')->with('success','Sign up attempt success, welcome');
            }
            //if user is role level 2
            if(auth()->user()->role === 'Movie Officer'){
                return redirect()->route('movie-index')->with('success','Sign up attempt success, welcome');
            }
            //if user is role level 3
            if(auth()->user()->role === 'Cashier'){
                return redirect()->route('cashier-index')->with('success','Sign up attempt success, welcome');
            }
            // return redirect()-with('success','Sign up attempt success, welcome');
        }
        return  back()->with('loginError', 'login Gagal!');
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('message','you logging out');
    }
}
