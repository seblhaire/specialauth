<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use \Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class CreatePasswordNotification extends Seblhaire\Specialauth\CreatePasswordNotification
{
  /**
   * Get the reset password notification mail message for the given URL.
   *
   * @param  string  $url
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  protected function buildMailMessage($url, $user)
  {
      return (new MailMessage)
          ->view('specialauth::public.emails.email')
          ->subject(Lang::get('Create Your Password'))
          ->line(Lang::get("You are receiving this email because :user created an account for you.", ['user' => $user]))
          ->action(Lang::get('Create Your Password'), $url)
          ->line(Lang::get('This password creation link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
  }
}
