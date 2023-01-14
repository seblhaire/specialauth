<?php
namespace Seblhaire\Specialauth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Messages\SolCanvasMail;
use \Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class CreatePasswordNotification extends Notification
{
    use Queueable;

     /**
     * The password reset token.
     *
     * @var string
     */
    public $token;
    public $email;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return call_user_func(config('specialauth.createpasswordfunc'), $notifiable, $this->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed e $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
