<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\User;
Use App\UserToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        UserToken $userToken
    )
    {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tokenParam = ['reset_token' => $this->userToken->token];
        $now = Carbon::now();
        return $this->from(config('mail.from.address'), config('mail.from.name'))
        ->to($this->user->email)
        ->subject('パスワードをリセットする')
        ->view('mail.password_reset_mail')
        ->with([
            'user' => $this->user,
            'url' => $url,
        ]);
    }
}
