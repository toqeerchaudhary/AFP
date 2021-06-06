<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Requests\Seller\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:seller")->except('logout');;
    }

    public function showLoginForm() {
        return view('seller.auth.login');
    }

    public function sellerLogin(LoginRequest $request) {
        if(Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('seller.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('seller.login.index');
    }
}
