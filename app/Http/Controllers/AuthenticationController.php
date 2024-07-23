<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('Error', 'Email atau password salah');
    }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('Error', 'Email tidak ditemukan');
    }

    if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        switch (auth()->user()->role) {
            case 'Admin':
                return redirect()->route('dashboard_manager')->with('success', 'Selamat Datang '.auth()->user()->name.'.');
            case 'Movie Officer':
                return redirect()->route('movie-index')->with('success', 'Selamat Datang '.auth()->user()->name.'.');
            case 'Cashier':
                return redirect()->route('cashier-index')->with('success', 'Selamat Datang '.auth()->user()->name.'.');
        }
    }

    return back()->with('Error', 'Password salah');
}


    public function logout(){
        auth()->logout();
        return redirect('/')->with('message','you logging out');
    }
}
