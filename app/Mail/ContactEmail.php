<?php

namespace App\Mail;

use App\ProfileAttribute;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Contact Details
     *
     * @var ContactDetails
     */

    public $contactDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->contactDetails['email'])
            ->replyTo($this->contactDetails['email'])
            ->subject($this->contactDetails['subject'])
            ->view('email')
            ->with(['contact' => $this->contactDetails]);
    }
}
