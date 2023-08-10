<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Sgcomptech\FilamentTicketing\Models\Ticket;

class LayananTIRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Sgcomptech\FilamentTicketing\Models\Ticket;
     */

    public $ticket;

    /**
     * Create a new message instance.
     * 
     * @param  Sgcomptech\FilamentTicketing\Models\Ticket  $ticket
     * @return void
     */

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Layanan TI Soputan',
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
            view: 'emails.layanan_ti_register',
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
