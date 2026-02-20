<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResidentCredentials extends Mailable implements MailableContract
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    /**
     * The plain text password.
     *
     * @var string
     */
    public $password;

    /**
     * The condominium instance.
     *
     * @var \App\Models\Condominium
     */
    public $condominium;

    /**
     * The unit number.
     *
     * @var string
     */
    public $unitNumber;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param string $password
     * @param \App\Models\Condominium $condominium
     * @param string $unitNumber
     */
    public function __construct(User $user, string $password, $condominium, string $unitNumber)
    {
        $this->user = $user;
        $this->password = $password;
        $this->condominium = $condominium;
        $this->unitNumber = $unitNumber;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to IdeoBravo - Your Resident Account',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resident-credentials',
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