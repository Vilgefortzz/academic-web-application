<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $header;
    public $content;

    public $subject;
    public $teacher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($header, $content, $subject, $teacher)
    {

        $this->header = $header;
        $this->content = $content;
        $this->subject = $subject;
        $this->teacher = $teacher;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message')
                    ->from($this->teacher->email, $this->teacher->degree. ' '. $this->teacher->first_name. ' '.
                        $this->teacher->second_name. ' ('. $this->teacher->email. ')')
                    ->subject($this->subject->name);
    }
}
