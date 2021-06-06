<?php

namespace App\Http\Controllers\Purchaser\Auth;

use App\Http\Requests\Purchaser\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:purchaser")->except('logout');;
    }

    public function showLoginForm() {
        return view('purchaser.auth.login');
    }

    public function purchaserLogin(LoginRequest $request) {
        if(Auth::guard('purchaser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('purchaser.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('purchaser')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('purchaser.login.index');
    }
}
