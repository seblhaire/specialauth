<?php

namespace Seblhaire\Specialauth\Notifications;

// based on
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword;

class CreatePasswordNotification extends ResetPassword {

    /**
     * The password reset token.
     *
     * @var string
     */
    public $email;
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, $email) {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }
        return $this->buildMailMessage($this->resetUrl($notifiable));
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url) {
        $user = !is_null(\Auth::user()) ? \Auth::user()->name : Lang::get('the webmaster');
        return (new MailMessage)
                        //->from('webmaster@mysite.com', "Webmaster mysite")
                        //->replyTo('no-reply@mysite.com')
                        ->theme('specialauth::public.emails.themes.default')
                        ->markdown('specialauth::public.emails.email')
                        ->subject(Lang::get('specialauth::messages.createpass'))
                        ->line(Lang::get("specialauth::messages.passwordcreation", ['user' => $user]))
                        ->action(Lang::get('specialauth::messages.createpass'), $url)
                        ->line(Lang::get('specialauth::messages.expirecreation', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]));
    }

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable) {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
                        ], false));
    }

    /**
     * Set a callback that should be used when creating the reset password button URL.
     *
     * @param  \Closure(mixed, string): string  $callback
     * @return void
     */
    public static function createUrlUsing($callback) {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage  $callback
     * @return void
     */
    public static function toMailUsing($callback) {
        static::$toMailCallback = $callback;
    }
}
