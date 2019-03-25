<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Employer;
use App\EmailHistory;

class NotifyClient extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $candidates;
    protected $employer;
    protected $fromAddress;
    protected $fromName;
    private $phone;
    
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
        $this->phone = config('mail.phone_number');
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->candidates->each(function ($candidate) {
            EmailHistory::create([
                'employer_id' => $this->employer->id,
                'candidate_id' => $candidate->id,
            ]);
        });

        return $this->from($this->fromAddress)
            ->subject('Top Candidates on the Market')
            ->view('email.html.clientHotsheet')
            ->text('email.text.clientHotsheet')
            ->with([
                'candidates' => $this->candidates,
                'employer' => $this->employer,
                'contactLink' => 'mailto:' . $this->fromAddress,
                'phone' => $this->phone,
            ]);
    }

    public function preview()
    {
        return view('email.html.clientHotsheet')->with([
            'candidates' => $this->candidates,
            'employer' => $this->employer,
            'contactLink' => 'mailto:testlink@test.com',
            'phone' => $this->phone,
        ]);
    }
}
