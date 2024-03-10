<?php

namespace Seblhaire\Specialauth;

use \Illuminate\Routing\Controller;
use \Seblhaire\Specialauth\Traits\AuthenticatesUsers;
use \Illuminate\Foundation\Bus\DispatchesJobs;
use \Illuminate\Foundation\Validation\ValidatesRequests;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->redirectTo = route(config('specialauth.logindest'));
        $this->redirectLogout = route(config('specialauth.logoutdest'));
        $this->middleware('guest')->except('logout');
    }
}
