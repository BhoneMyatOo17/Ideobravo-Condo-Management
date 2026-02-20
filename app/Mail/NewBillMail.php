<?php

namespace App\Mail;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBillMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Bill $bill,
        public string $recipientEmail,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Bill - ' . $this->bill->bill_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-bill',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}