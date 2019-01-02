<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Candidate;
use App\Mail\NotifyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Input;

class EmployerEmailController extends Controller
{
    public function send(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = collect($request->except('_token'))
        ->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();

        Mail::to($employer->email)->send(new NotifyClient($candidates, $employer, $this->setIndustry($candidates)));
    }

    public function preview(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = collect($request->except('_token'))
        ->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();

        return view('email.html.clientHotsheet')->with([
            'candidates' => $candidates,
            'employer' => $employer,
            'contactLink' => 'testlink@test.com',
            'emailLink' => 'testlink@test.com',
            'industry' => $this->setIndustry($candidates)
        ]);
    }

    //This shouldn't be here. Create Transformer later
    private function setIndustry($candidates)
    {
        $industries = $candidates->map(function($candidate){
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
