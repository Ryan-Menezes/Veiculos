<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $email, string $subject, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = str_ireplace("\n", '<br>', $message);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from($this->email, $this->name)
                ->subject(config('app.name') . ' - Contato pelo formulário: ' . $this->subject)
                ->view('mail.contact', [
                    'name'      => $this->name,
                    'subject'   => $this->subject,
                    'body'      => $this->message
                ]);
    }
}
