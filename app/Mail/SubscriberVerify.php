<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriberVerify extends Mailable
{
    use Queueable, SerializesModels;
    public $subject, $body, $verification_link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body, $verification_link)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->verification_link = $verification_link;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.subscriber_mail',
            with: [
                'subject' => $this->subject,
                'body' => $this->body,
                'verification_link' => $this->verification_link,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
