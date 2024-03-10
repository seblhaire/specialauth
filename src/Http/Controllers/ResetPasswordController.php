<?php

namespace Seblhaire\Specialauth\Http\Controllers;

use \Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Seblhaire\Specialauth\Traits\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        ResetsPasswords;

    public function __construct() {
        $this->redirectTo = route(config('specialauth.logindest'));
    }

    public function showResetForm(Request $request) {
        $token = $request->route()->parameter('token');

        return view('specialauth::public.reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }
}
