<?php

namespace Seblhaire\Specialauth\Http\Controllers;

use \Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Seblhaire\Specialauth\Traits\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        SendsPasswordResetEmails;
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset emails and
      | includes a trait which assists in sending these notifications from
      | your application to your users. Feel free to explore this trait.
      |
     */

    public function showLinkRequestForm() {
        return view('specialauth::public.email');
    }
}
