<?php

namespace App\Http\Controllers\Coordinator\Auth;

use App\Http\Requests\Coordinator\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:coordinator")->except('logout');;
    }

    public function showLoginForm() {
        return view('coordinator.auth.login');
    }

    public function coordinatorLogin(LoginRequest $request) {
        if(Auth::guard('coordinator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('coordinator.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('coordinator')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('coordinator.login.index');
    }
}
