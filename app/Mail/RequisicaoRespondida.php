<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequisicaoRespondida extends Mailable
{
    use Queueable, SerializesModels;
    public $resposta;

    /**
     * Create a new message instance.
     */
    public function __construct($resposta)
    {
        $this->resposta = $resposta;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('requisicao@pfuxela.co.mz', 'Requisicoes'),
            replyTo: [
                new Address('requisicao@pfuxela.co.mz', 'Requisicoes'),
            ],
            subject: 'Requisicao Respondida',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'requisicao.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->resposta->anexos),
        ];
    }
}
