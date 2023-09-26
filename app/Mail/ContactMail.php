<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

	public $details;
    
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $details, $subject, $email_type )
    {
        $this->details      = $details;
        $this->subject      = $subject;
        $this->email_type   = $email_type; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if( $this->email_type == 'contact' )
        {
            return $this->subject( $this->subject )->view( 'emails.contactEmail' );    
        }
        elseif( $this->email_type == 'reviewer_email' )
        {
            return $this->subject( $this->subject )->view( 'emails.reviewerEmail' );
        }
        else
        {
            return $this->subject( "Contact Email Example" )->view( 'emails.sendEmail' );
        }
        
    }
}
