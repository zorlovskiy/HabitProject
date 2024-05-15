<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyAlerts extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $habit;

    public function __construct($user, $habit)
    {
        $this->user = $user;
        $this->habit = $habit;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Alerts',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.dailyAlerts',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
