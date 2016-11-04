<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordWithNew extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $newPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $newPassword)
    {
        $this->email = $email;
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_reset_new')
            ->from('greghause123@gmail.com', 'New Password')
            ->subject('New Password Set');
    }
}
