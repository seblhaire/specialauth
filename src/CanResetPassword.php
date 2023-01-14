<?php

namespace Seblhaire\Specialauth;

use ResetPasswordNotification;
use CreatePasswordNotification;
/*based on Illuminate\Auth\Passwords\CanResetPassword*/
trait CanResetPassword
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordCreateNotification($token, $email)
    {
        $this->notify(new CreatePasswordNotification($token, $email));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
