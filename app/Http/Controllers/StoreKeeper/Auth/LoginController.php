<?php

namespace App\Http\Controllers\StoreKeeper\Auth;

use App\Http\Requests\StoreKeeper\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:store_keeper")->except('logout');;
    }

    public function showLoginForm() {
        return view('store_keeper.auth.login');
    }

    public function store_keeperLogin(LoginRequest $request) {
        if(Auth::guard('store_keeper')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('store_keeper.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('fail','Invalid Details!');
    }

    public function logout(Request $request)
    {
        Auth::guard('store_keeper')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('store_keeper.login.index');
    }
}
