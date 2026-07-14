<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserUnblockedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;

    public function __construct($user, $admin)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Account Has Been Unblocked',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.userMail.user-unblocked',
        );
    }
}
