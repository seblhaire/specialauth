<?php

namespace Seblhaire\Specialauth\Notifications;

//based on  Illuminate\Auth\Notifications;

use \Illuminate\Notifications\Messages\MailMessage;
use \Illuminate\Support\Facades\Lang;
use \Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordNotification extends ResetPassword {

    protected function buildMailMessage($url) {
        return (new MailMessage)
                        //->from('webmaster@mysite.com', "Webmaster mysite")
                        //->replyTo('no-reply@mysite.com')
                        ->theme('specialauth::public.emails.themes.default')
                        ->markdown('specialauth::public.emails.email')
                        ->subject(Lang::get('specialauth::messages.resetpassnotif'))
                        ->line(Lang::get('specialauth::messages.passwordreset'))
                        ->action(Lang::get('specialauth::messages.resetpass'), $url)
                        ->line(Lang::get('specialauth::messages.expirereset', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                        ->line(Lang::get('specialauth::messages.nofurtheraction'));
    }
}
