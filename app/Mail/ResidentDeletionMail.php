<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResidentDeletionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userEmail;
    public $unitNumber;
    public $condominiumName;
    public $deletionReason;
    public $deletedBy;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $userName,
        string $userEmail,
        string $unitNumber,
        string $condominiumName,
        string $deletionReason,
        string $deletedBy
    ) {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->unitNumber = $unitNumber;
        $this->condominiumName = $condominiumName;
        $this->deletionReason = $deletionReason;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resident Profile Deletion Notice - ' . $this->condominiumName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resident-deletion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}