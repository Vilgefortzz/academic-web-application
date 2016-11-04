<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $secureString;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $secureString)
    {
        $this->email = $email;
        $this->secureString = $secureString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_reset_link')
                    ->from('greghause123@gmail.com', 'Password reset link')
                    ->subject('PasswordReset');
    }
}
