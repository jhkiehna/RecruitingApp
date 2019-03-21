<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Candidate;
use App\Mail\NotifyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployerEmailController extends Controller
{
    public function send(Request $request)
    {
        if (empty($request->employers)) {
            $employers = Employer::all();    
        } else {
            $employers = collect(explode(',', $request->employers))->map(function ($employerId) {
                return Employer::findOrFail((int) $employerId);
            });
        }

        if (empty($request->candidates)) {
            $candidates = Candidate::all();
        } else {
            $candidates = collect(explode(',', $request->candidates))->map(function ($candidateId) {
                return Candidate::findOrFail((int) $candidateId);
            });
        }

        $employers->each(function ($employer) use ($candidates){
            Mail::to($employer->email)
                ->queue(new NotifyClient($candidates, $employer));
        }); 

        Mail::to(config('mail.from.address'))
            ->queue(new NotifyClient($candidates, $employers->first()));

        return redirect()->route('dashboard')->withStatus('Email(s) sent to ' . $employers->count() . ' employer(s) - A Copy was sent to ' . config('mail.from.address'));
    }

    public function preview(Request $request)
    {
        if (empty($request->employers)) {
            $employers = Employer::all();
        } else {
            $employers = collect(explode(',', $request->employers))->map(function ($employerId) {
                return Employer::findOrFail((int) $employerId);
            });
        }

        $candidates = collect(explode(',', $request->candidates))->map(function ($candidateId) {
            return Candidate::findOrFail((int) $candidateId);
        });

        return (new NotifyClient($candidates, $employers->first()))->preview();
    }
}
