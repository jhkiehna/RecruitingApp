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

        $candidates = $this->collectCandidatesFromRequest($request);

        Mail::to($employer->email)
        ->bcc(config('mail.from.address'))
        ->send(new NotifyClient($candidates, $employer));

        return redirect()->route('dashboard')->withStatus('Email sent to ' . $employer->email . ' - Blind Carbon Copy sent to ' . config('mail.from.address'));
    }

    public function preview(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = $this->collectCandidatesFromRequest($request);

        return (new NotifyClient($candidates, $employer))->preview();
    }

    private function collectCandidatesFromRequest($request)
    {
        return collect($request)
        ->reject(function ($value, $key) {
            return $key == '_token' || $key == 'path';
        })->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();
    }
}
