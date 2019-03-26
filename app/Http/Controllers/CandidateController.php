<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();

        $transformedCandidates = $candidates->map(function ($candidate) {
            return $candidate->transform();
        });
        
        return DataTables::of($transformedCandidates)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/newCandidate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'walterID'              => 'required|numeric|unique:candidates,walter_id|unique:employers,walter_id',
                'firstName'             => 'required|string|max:255',
                'lastName'              => 'required|string|max:255',
                'email'                 => 'max:255|email|nullable|unique:candidates,email|unique:employers,email',
                'locationPreference'    => 'max:255|string|nullable',
                'jobTitle'              => 'max:255|string|nullable',
                'industry'              => 'required|max:255|string',
                'summary'               => 'required|max:65000|string',
            ],
            [
                'walterID.numeric'      => 'A Walter Id can only contain numbers',
                'walterID.unique'       => 'This walter Id is already assigned to a candidate or employer',

                'firstName.required'    => 'First Name is required',
                'firstName.string'       => 'First Name must be a string',
                'firstName.max'         => 'The First Name you entered is too long',

                'lastName.required'     => 'Last Name is required',
                'lastName.string'        => 'Last Name must be a string',
                'lastName.max'          => 'The Last Name you entered is too long',

                'email.max'             => 'The Email you entered is too long',
                'email.email'           => 'The email must be a valid email address',
                'email.unique'           => 'The is already a Candidate or Employer in the database with this email address',

                'locationPreference.max' => 'The location preference cannot be longer than 255 characters',
                'locationPreference.string' => 'The location preference must be a string',

                'jobTitle.max'             => 'The job title you entered is too long',
                'jobTitle.string'       => 'The job title must be a string',

                'industry.required'     => 'An industry must be specified for this candidate',
                'industry.max'          => 'The industry cannot be longer than 255 characters',
                'industry.string'       => 'The industry must be a string',

                'summary.required'      => 'A summary of the candidate is required',
                'summary.max'           => 'A summary cannot be longer than 65,000 characters.',
                'summary.string'        => 'The summary must be a string',
            ]
        );

        try {
            Candidate::create([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'job_title' => $request->jobTitle,
                'location_preference' => $request->locationPreference,
                'industry' => $request->industry,
                'summary' => $request->summary,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 500);
        }

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully added to Candidates!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        
        return view('admin/editCandidate')->with(['candidate' => $candidate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        $request->validate(
            [
                'walterID'          => 'required|numeric|unique:candidates,walter_id,'. $candidate->id .'|unique:employers,walter_id',
                'firstName'         => 'required|string|max:255',
                'lastName'          => 'required|string|max:255',
                'email'             => 'nullable|max:255|email|unique:candidates,email,'. $candidate->id.'|unique:employers,email',
                'locationPreference' => 'max:255|nullable|string',
                'jobTitle'          => 'max:255|nullable|string',
                'industry'          => 'required|max:255|string',
                'summary'           => 'required|max:65000|string',
            ],
            [
                'walterID.numeric'      => 'A Walter Id can only contain numbers',
                'walterID.unique'       => 'This walter Id is already assigned to a candidate or employer',

                'firstName.required'    => 'First Name is required',
                'firstName.string'       => 'First Name must be a string',
                'firstName.max'         => 'The First Name you entered is too long',

                'lastName.required'     => 'Last Name is required',
                'lastName.string'        => 'Last Name must be a string',
                'lastName.max'          => 'The Last Name you entered is too long',

                'email.max'             => 'The Email you entered is too long',
                'email.email'           => 'The email must be a valid email address',
                'email.unique'           => 'The is already a Candidate or Employer in the database with this email address',

                'locationPreference.max' => 'The location preference cannot be longer than 255 characters',
                'locationPreference.string' => 'The location preference must be a string',

                'jobTitle.max'             => 'The job title you entered is too long',
                'jobTitle.string'       => 'The job title must be a string',

                'industry.required'     => 'An industry must be specified for this candidate',
                'industry.max'          => 'The industry cannot be longer than 255 characters',
                'industry.string'       => 'The industry must be a string',

                'summary.required'      => 'A summary of the candidate is required',
                'summary.max'           => 'A summary cannot be longer than 65,000 characters.',
                'summary.string'        => 'The summary must be a string',
            ]
        );
        try {
            $candidate->update([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'job_title' => $request->jobTitle,
                'location_preference' => $request->locationPreference,
                'industry' => $request->industry,
                'summary' => $request->summary,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 500);
        }

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId)->delete();

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully deleted!');
    }
}
