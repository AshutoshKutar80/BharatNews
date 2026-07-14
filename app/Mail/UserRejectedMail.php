<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRejectedMail extends Mailable 
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;
    public $remark;

    public function __construct($user, $admin, $remark = null)
    {
        $this->user = $user;
        $this->admin = $admin;
        $this->remark = $remark;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Account Registration Has Been Rejected',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.userMail.user-rejected',
        );
    }
}
