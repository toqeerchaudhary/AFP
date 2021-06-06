<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
//        $this->middleware("guest:admin");
    }

    public function showRegisterForm() {
        return view('admin.auth.register');
    }

    public function adminRegistration(RegisterRequest $request) {
        $request["password"] = Hash::make($request->password);
        $driver = new Admin($request->all());
        $driver->save();
        Auth::guard('admin')->login($driver);
        return redirect()->route("admin.dashboard.index");

    }
}
