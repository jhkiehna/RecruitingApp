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
        $employer = $this->employerModel::findOrFail('id', $employerId)::first();

        Mail::to($employer->email)->send(new NotifyClient($request->candidateIds, $employer));
    }

    public function preview(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = collect($request->except('_token'))
        ->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();

        return view('email.html.clientHotsheet')->with(['candidates' => $candidates, 'employer' => $employer, 'contactLink' => 'testlink@test.com', 'emailLink' => 'testlink@test.com']);
    }
}
