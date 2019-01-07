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
    public function __construct($candidates, Employer $employer)
    {
        $this->candidates = $candidates;
        $this->employer = $employer;

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
            ->subject('Top ' . $this->setIndustry() . ' Candidates on the Market')
            ->view('email.html.clientHotsheet')
            ->text('email.text.clientHotsheet')
            ->with([
                'candidates' => $this->candidates,
                'employer' => $this->employer,
                'contactLink' => 'mailto:' . $this->fromAddress,
                'industry' => $this->setIndustry()
            ]);
    }

    public function preview()
    {
        return view('email.html.clientHotsheet')->with([
            'candidates' => $this->candidates,
            'employer' => $this->employer,
            'contactLink' => 'mailto:testlink@test.com',
            'industry' => $this->setIndustry()
        ]);
    }

    private function setIndustry()
    {
        $industries = $this->candidates->map(function($candidate){
            return $candidate->industry;
        })->unique();

        if ($industries->count() > 2) {
            return '';
        }

        if ($industries->count() > 1) {
            return $industries[0] . ' and ' . $industries[1];
        }
        
        return $industries->first();
    }
}
