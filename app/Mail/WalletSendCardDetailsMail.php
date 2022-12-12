<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WalletSendCardDetailsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $date;
    public $cardNumber;
    public $cardType;
    public $cardCvv;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date, $cardNumber, $cardType, $cardCvv)
    {
        $this->date = $date;
        $this->cardNumber = $cardNumber;
        $this->cardType = $cardType;
        $this->cardCvv = $cardCvv;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Виртуальная карта создана',
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
            view: 'Mail.WalletSendCardDetails',
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
