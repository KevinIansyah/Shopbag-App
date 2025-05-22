<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $message_mail;
    public $subject;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->order = $data['order'];
        $this->user = $data['user'];
        $this->message_mail = $data['message'];
        $this->subject = $data['subject'];
        $this->pdf = $data['pdf'] ?? null;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('sierbooker@gmail.com', 'Shopbag'),
            replyTo: [
                new Address('sierbooker@gmail.com', 'Shopbag'),
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
            view: 'mail.order-mail',
            with: [
                'order' => $this->order,
                'user' => $this->user,
                'message_mail' => $this->message_mail,
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
        return $this->pdf ? [
            Attachment::fromPath($this->pdf)->as('Invoice_' . $this->order->midtrans_order_id . '.pdf')->withMime('application/pdf'),
        ] : [];
    }
}
