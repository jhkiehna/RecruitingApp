<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Mail\NotifyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotifyClientController extends Controller
{
    protected $employerModel;

    public function __construct(Employer $employerModel)
    {
        $this->employerModel = $employerModel;
    }

    public function send(Request $request, $employerId)
    {
        $employer = $this->employerModel::findOrFail('id', $employerId)::first();

        Mail::to($employer->email)->send(new NotifyClient($request->candidateIds, $employer));
    }
}
