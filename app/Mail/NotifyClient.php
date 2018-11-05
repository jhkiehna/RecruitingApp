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

    protected $candidateModel;
    protected $employerModel;
    protected $fromAddress;
    protected $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidateModel, Employer $employerModel)
    {
        $this->candidateModel = $candidateModel;
        $this->employerModel = $employerModel;
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
        //get employer Id somehow
        //get list of candidates somehow
        //placeholders for now until I firgure out how this info is passed in
        $candidateIds = collect(1,2,3);
        $employerId = 1;

        $candidates = $candidateIds->map(function ($candidateId) {
            return $this->candidateModel::findOrFail('id', $candidateId)->first()->mailTransform();
        });

        $employer = $this->employerModel::findOrFail('id', $employerId)->first();

        return $this->from($this->fromAddress)
            ->view('email.html.notifyClient')
            ->text('email.text.notifyClient')
            ->with([
                'candidates' => $this->candidates,
                'employer' => $this->employer
            ]);
    }
}
