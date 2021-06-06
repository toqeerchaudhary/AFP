<?php

namespace App\Http\Controllers\Purchaser\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Only guests for "purchaser" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:purchaser');
    }

    /**
     * Show the reset email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(){
        return view('purchaser.auth.passwords.email');
    }

    /**
     * password broker for purchaser guard.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker(){
        return Password::broker('purchasers');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard(){
        return Auth::guard('purchaser');
    }
}
