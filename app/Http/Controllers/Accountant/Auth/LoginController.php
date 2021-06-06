<?php

namespace App\Http\Controllers\Accountant\Auth;

use App\Http\Requests\Accountant\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:accountant")->except('logout');;
    }

    public function showLoginForm() {
        return view('accountant.auth.login');
    }

    public function accountantLogin(LoginRequest $request) {
        if(Auth::guard('accountant')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('accountant.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('accountant')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('accountant.login.index');
    }
}
