<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class CustomMarkdownEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Custom Markdown Email',
        );
    }

    public function build()
    {
        return $this->view('emails.custom-markdown');
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.custom-markdown',
            with: [
                'password' => $this->password
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
