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
    protected $industry;
    protected $fromAddress;
    protected $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidates, Employer $employer, $industry)
    {
        $this->candidates = $candidates;
        $this->employer = $employer;
        $this->industry = $industry;

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
            ->view('email.html.clientHotsheet')
            ->text('email.text.clientHotsheet')
            ->with([
                'candidates' => $this->candidates,
                'employer' => $this->employer,
                'contactLink' => $this->fromAddress,
                'emailLink' => $this->fromAddress,
                'industry' => $this->industry
            ]);
    }
}
