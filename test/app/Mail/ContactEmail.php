<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /*Ik declareer de variabelen name, email en message die ik later ga gebruiken.*/
    public $name;
    public $email;
    public $message;

    /*Ik moet boven de @return void blijkbaar de variabelen die ik eerst heb gemaakt meegeven als parameters.*/
    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     * @return void
     */
    /*Ik maak een constructor die de name, email en message bevat.*/
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Email',
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
            markdown: 'emails.contact',
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
       /**
     * Build the message.
     *
     * @return $this
     */
    /*De build function maakt de email op.
    Er wordt gebruik gemaakt van de markdown van emails.contact.
    emails.contact is de contact.blade.php die binnen de views in de emails folder staat.
    Ik geef deze mail een subject aangezien deze moet worden meegegeven om een mail te maken.
    Vervolgens geef ik de name, email en message ook mee in de mail.
    */ 
    public function build()
    {
        return $this->markdown('emails.contact')
                    ->subject('Nieuw bericht uit het contactformulier')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'message' => $this->message,
                    ]);
    }
}