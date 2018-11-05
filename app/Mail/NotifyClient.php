<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Candidate;
use App\Employer;

class NotifyClient extends Mailable
{
    use Queueable, SerializesModels;

    protected $candidates;
    protected $employer;
    protected $fromAddress;
    protected $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidateIds, $employerId)
    {
        $candidates = $candidateIds->map(function ($candidateId) {
            return Candidate::findOrFail('id', $candidateId)->first()->mailTransform();
        });
        $employer = Employer::findOrFail('id', $employerId)->first()->mailTransform();

        $this->fromAddress = config('mail.from.address');
        $this->fromName = config('mail.from.name');
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromAddress)
            ->view('email.html.notifyClient')
            ->text('email.text.notifyClient')
            ->with([
                'candidates' => $this->candidates,
                'employer' => $this->employer
            ]);
    }
}
