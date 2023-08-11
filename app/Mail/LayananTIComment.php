<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Sgcomptech\FilamentTicketing\Models\Comment;

class LayananTIComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Sgcomptech\FilamentTicketing\Models\Comment;
     */

    public $comment;

    /**
     * Create a new message instance.
     * 
     * @param  Sgcomptech\FilamentTicketing\Models\Comment  $comment
     * @return void
     */

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            view: 'emails.layanan_ti_comment',
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
