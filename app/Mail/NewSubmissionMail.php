<?php

namespace App\Mail;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->subject('New Submission Received')
                    ->markdown('emails.new_submission');
    }
}
