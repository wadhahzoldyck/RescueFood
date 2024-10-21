<?php

namespace App\Mail;

use App\Models\Livraison;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LivraisonAffectee extends Mailable
{
    use Queueable, SerializesModels;
    public $livraison;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Livraison $livraison)
    {
        $this->livraison = $livraison;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Livraison Affectee',
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
            view: 'emails.livraison_affectee',
            with: [
                'livraison' => $this->livraison,
                'adresse' => $this->livraison->adresse,
                'etat' => $this->livraison->etat,
                'date_livraison' => $this->livraison->date_livraison,
                'livreur' => $this->livraison->livreur,
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
