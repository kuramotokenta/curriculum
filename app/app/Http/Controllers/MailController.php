<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\ResetPasswordRequest;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Exception;

class Mailcontroller extends Controller
{
    private $userRepository;
    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function mailForm(){
        return view('mail.pass');
    }

    public function sendMail(SendEmailRequest $request){
        $user = $this->userRepository->findFromMail($request->email);
        $userToken = $this->userRepository->updateOrCreateUser($user->id);
        Mail::to('test@example.com')
        ->send(new TestMail($user,$userToken));

        return view('password.send_comp');
    }

    public function resetPassword(Request $request){
        $resetToken = $request->reset_token;

        $userToken = $this->userRepository->getUserTokenFromUser($resetToken);


        return view('mail.pass_conf',compact('userToken','userMail'));
    }

    public function updatePassword(ResetPasswordRequest $request) {
        $userToken = $this->userRepository->getUserTokenFromUser($request->reset_token);
        // パスワード暗号化
        $password = encrypt($request->password);
        $this->userRepository->updateUserPassword($password, $userToken->id);

        return view('mail.pass_comp');
    }
}
