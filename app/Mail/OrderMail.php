<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order, $orderItem, $discount_amount, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderItem, $discount_amount, $subject)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->discount_amount = $discount_amount;
        $this->subject = $subject;
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
        $order = $this->order;
        $orderItem = $this->orderItem;
        $discount_amount = $this->discount_amount;
        return new Content(
            view: 'mail.order_mail',
            with: compact('order', 'orderItem', 'discount_amount'),
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
