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
                'walterID'      => 'required|numeric|unique:candidates,walter_id|unique:employers,walter_id',
                'firstName'     => 'required|string|max:255',
                'lastName'      => 'required|string|max:255',
                'email'         => 'max:255|nullable|unique:candidates,email',
                'city'          => 'max:255|nullable',
                'state'         => 'alpha|max:2|nullable',
                'jobTitle'      => 'max:255|nullable',
                'industry'      => 'required|max:255',
                'summary'       => 'required|max:65000',
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
                'email.unique'           => 'The is already a Candidate in the database with this email address',

                'city.max'              => 'The city cannot be longer than 255 characters',

                'state.alpha'           => 'The state can only contain letters',
                'state.max'             => 'Please use the 2 letter state abbreviation',

                'jobTitle.max'             => 'The job title you entered is too long',

                'industry.required'     => 'An industry must be specified for this candidate',
                'industry.max'          => 'An industry cannot be longer than 255 characters',

                'summary.required'      => 'A summary of the candidate is required',
                'summary.max'           => 'A summary cannot be longer than 65,000 characters'
            ]
        );

        try {
            Candidate::create([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'job_title' => $request->jobTitle,
                'city' => $request->city,
                'state' => $request->state,
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
                'walterID'      => 'required|numeric|unique:candidates,walter_id,'. $candidate->id .'|unique:employers,walter_id',
                'firstName'     => 'required|string|max:255',
                'lastName'      => 'required|string|max:255',
                'email'         => 'nullable|max:255|unique:candidates,email,'. $candidate->id,
                'city'          => 'max:255|nullable',
                'state'         => 'alpha|max:2|nullable',
                'jobTitle'      => 'max:255|nullable',
                'industry'      => 'required|max:255',
                'summary'       => 'required|max:65000',
            ],
            [
                'walterId.required'     => 'A walter Id is required',
                'walterID.numeric'      => 'A Walter Id can only contain numbers',
                'walterID.unique'       => 'This walter Id is already assigned to a candidate or employer',

                'firstName.required'    => 'First Name is required',
                'firstName.string'       => 'First Name must be a string',
                'firstName.max'         => 'The First Name you entered is too long',

                'lastName.required'     => 'Last Name is required',
                'lastName.string'        => 'Last Name must be a string',
                'lastName.max'          => 'The Last Name you entered is too long',

                'email.max'             => 'The Email you entered is too long',
                'email.unique'          => 'The is already a Candidate in the database with this email address',

                'city.max'              => 'The city cannot be longer than 255 characters',

                'state.alpha'           => 'The state can only contain letters',
                'state.max'             => 'Please use the 2 letter state abbreviation',

                'jobTitle.max'             => 'The job title you entered is too long',

                'industry.required'     => 'An industry must be specified for this candidate',
                'industry.max'          => 'An industry cannot be longer than 255 characters',

                'summary.required'      => 'A summary of the candidate is required',
                'summary.max'           => 'A summary cannot be longer than 65,000 characters. You entered '. strlen($request->summary),
            ]
        );
        try {
            $candidate->update([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'job_title' => $request->jobTitle,
                'city' => $request->city,
                'state' => $request->state,
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
