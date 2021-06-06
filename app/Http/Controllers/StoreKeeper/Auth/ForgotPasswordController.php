<?php

namespace App\Http\Controllers\StoreKeeper\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Only guests for "store_keeper" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:store_keeper');
    }

    /**
     * Show the reset email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(){
        return view('store_keeper.auth.passwords.email');
    }

    /**
     * password broker for store_keeper guard.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker(){
        return Password::broker('store_keepers');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard(){
        return Auth::guard('store_keeper');
    }
}
