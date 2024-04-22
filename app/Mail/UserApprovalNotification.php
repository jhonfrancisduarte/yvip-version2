<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $adminEmail;

    public function __construct($name, $admin){
        $this->name = $name;
        $this->adminEmail = $admin;
    }

    public function build(){
        return 
            $this->from($this->adminEmail)
                ->view('emails.user-approval')
                ->subject('Your account has been approved')
                ->with(['name' => $this->name]);
    }

    public function envelope(): Envelope{
        return new Envelope(
            subject: 'User Approval Notification',
        );
    }

    public function content(): Content{
        return new Content(
            view: 'emails.user-approval',
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
