<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPostMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private string $title, private string $content)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email',
            with: [
                'message' => $this->content,
            ]
        );
    }
    
    public function attachments(): array
    {
        return [];
    }
}
