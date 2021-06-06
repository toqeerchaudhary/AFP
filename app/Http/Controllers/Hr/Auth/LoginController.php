<?php

namespace App\Http\Controllers\Hr\Auth;

use App\Http\Requests\Hr\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:hr")->except('logout');;
    }

    public function showLoginForm() {
        return view('hr.auth.login');
    }

    public function hrLogin(LoginRequest $request) {
        if(Auth::guard('hr')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('hr.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('hr')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('hr.login.index');
    }
}
