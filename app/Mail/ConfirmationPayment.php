<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ConfirmationPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $paymentDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $paymentDetails)
    {
        $this->user = $user;
        $this->paymentDetails = $paymentDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('sierbooker@gmail.com', 'Zalfeet'),
            replyTo: [
                new Address('sierbooker@gmail.com', 'Zalfeet'),
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.confirmationPayment',
            with: [
                'user' => $this->user,
                'paymentDetails' => $this->paymentDetails,
            ],
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
