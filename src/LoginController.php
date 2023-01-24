<?php

namespace Seblhaire\Specialauth;

use \Illuminate\Routing\Controller;
use RouteServiceProvider;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Foundation\Bus\DispatchesJobs;
use \Illuminate\Foundation\Validation\ValidatesRequests;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class LoginController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = config('specialauth.logindest');
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        return view('specialauth::login');
    }
}
