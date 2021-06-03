<?php

namespace App\Notifications;

use App\Events\ResetPasswordSendMail;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class ResetPasswordNotification extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        #Rol del user
        $rolUser = $notifiable->rol;

        $route = 'password.reset';
        if ($rolUser->id == User::ROL_ADMIN) {
            $route = 'password.reset_backend';
        }

        if ($rolUser->id == User::ROL_EMPLOYER || $rolUser->id == User::ROL_CANDIDATE) {
            $route = 'password.reset';
            $notifiable->remember_token=$this->token;
            $notifiable->save();
        }

        $url= url(config('app.url') . route($route, $this->token, false));

        if(substr(config('app.url'),-1)=='/'){
            $urlLimpia=substr(config('app.url'), 0, -1);
            $url= url($urlLimpia.route($route, $this->token, false));
        }

        $bodyEmail = '<p style="font-size: 20px">Hola ' . $notifiable->firstname . ' ' . $notifiable->lastname . '<br><br>';
        $bodyEmail.= 'Recibes este email porque se solicitó un restablecimiento de contraseña para tu cuenta. <br><br>';
        $bodyEmail.= '<a href="'.$url.'" style="background: #2f55d4;cursor: pointer;color: white;border: 0;font-size: 17px;font-weight: 900;border-radius: 7px;display: inline-block;padding: 10px 15px;text-decoration: none;margin-left: 160px;">Reetablecer Contraseña</a> <br><br>';
        $bodyEmail.= 'Si no realizaste esta petición, puedes ignorar este correo y nada habrá cambiado. Saludos <br><br>';
        $bodyEmail.= 'Saludos <br><br></p>';
        $bodyEmail.= '<hr> Si tiene problemas abriendo este link "Reestablecer Contraseña" copia y pega esto en tu navegador: '.$url;


        $subject='Notificación de restablecimiento de contraseña';

        #Aca enviamos el email al cliente
        Event(new ResetPasswordSendMail($notifiable->firstname, $notifiable->email, $bodyEmail, $subject));

        return (new MailMessage)
            ->view('emails.email-password', ['body'=>$bodyEmail]);
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}