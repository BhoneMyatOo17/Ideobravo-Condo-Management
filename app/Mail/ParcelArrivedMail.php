<?php

namespace App\Mail;

use App\Models\Parcel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ParcelArrivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Parcel $parcel,
        public string $recipientEmail
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Parcel Arrived - ' . $this->parcel->tracking_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.parcel-arrived',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}