<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletterData;
    public $subscriberName;

    public function __construct($newsletterData, $subscriberName)
    {
        $this->newsletterData = $newsletterData;
        $this->subscriberName = $subscriberName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->newsletterData['title'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}