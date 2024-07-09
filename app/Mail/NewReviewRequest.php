<?php

namespace App\Mail;

use App\Models\ReviewRequest;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReviewRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $review;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $review, Company $company)
    {
        $this->review = $review;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_review_request')
                    ->with([
                        'review' => $this->review,
                        'company' => $this->company,
                    ]);
    }
}
