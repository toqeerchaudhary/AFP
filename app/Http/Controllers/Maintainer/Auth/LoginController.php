<?php

namespace App\Http\Controllers\Maintainer\Auth;

use App\Http\Requests\Maintainer\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:maintainer")->except('logout');;
    }

    public function showLoginForm() {
        return view('maintainer.auth.login');
    }

    public function maintainerLogin(LoginRequest $request) {
        if(Auth::guard('maintainer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('maintainer.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('maintainer')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('maintainer.login.index');
    }
}
