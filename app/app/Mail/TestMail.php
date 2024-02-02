<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $userToken)
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
        $tokenParam = ['reset_token' => $this->userToken->rest_password_access_key];
        $now = Carbon::now();
        $url = URL::temporarySignedRoute('reset.password', $now->addHours(48), $tokenParam);
        return $this
        ->from('example@example.com')
        ->subject('テスト送信完了')
        ->view('mail.password_reset_mail')
        ->with(['url' => $url,]);
    }
}
