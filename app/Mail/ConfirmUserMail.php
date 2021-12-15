<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    public function __construct($user)
    {
      $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      /*
      return (new MailMessage)
      ->subject("모두이사 패스워드 변경")
      ->line('패스워드를 변경하시려면 패스워드 변경 버튼을 눌러주세요')
      ->action('패스워드 변경', url(config('app.url').'community'.route('password.reset', $this->user->confirmation_token, false)) )
      ->line('If you did not request a password reset, no further action is required.');
*/
      return $this->from('mail@modoo24.net', 'modoo24')
            ->to($this->user->email)
            ->subject('모두이사 회원가입 이메일인증')
            ->view('emails.confirmation', [
            'token' => $this->user->confirmation_token,
            'id' => $this->user->email,
            'url'=>url(config('app.url').'/community/users/'.$this->user->email.'/'.$this->user->confirmation_token.'/confirm')
        ]);
    }
}
