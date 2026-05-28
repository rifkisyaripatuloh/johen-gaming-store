<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\AccountDelivery;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AccountDeliveryMail extends Mailable
{
    public $order;
    public $account;

    public function __construct(
        Order $order,
        AccountDelivery $account
    )
    {
        $this->order = $order;
        $this->account = $account;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Game Berhasil Dikirim'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.account-delivery'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}