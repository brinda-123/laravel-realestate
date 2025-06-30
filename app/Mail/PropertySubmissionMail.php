<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertySubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $propertyData,
        public string $sellerName
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Property Submission - ' . $this->propertyData['property_name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.property_submission',
            with: [
                'propertyData' => $this->propertyData,
                'sellerName' => $this->sellerName,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
