<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name = 'Unknow user';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Добро пожаловать!',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.hello'
        );
    }
}
