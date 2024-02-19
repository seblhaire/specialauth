<?php

namespace Seblhaire\Specialauth;

use \Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Providers\RouteServiceProvider;
use Seblhaire\Specialauth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

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
