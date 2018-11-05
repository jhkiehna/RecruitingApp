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
                'walterID'      => 'numeric|unique:candidates,walter_id|nullable',
                'firstName'     => 'required|alpha|max:255',
                'lastName'      => 'required|alpha|max:255',
                'email'         => 'required|max:255|unique:users,email',
                'phone'         => 'max:20|nullable',
                'city'          => 'alpha_num|max:255',
                'state'         => 'alpha|max:2',
                'industry'      => 'required|max:255|alpha_num',
                'summary'       => 'required|max:255',
            ],
            [
                'walterID.unique'       => 'There is already a candidate in the database with this Walter ID',
                'walterID.numeric'      => 'A Walter Id can only contain numbers',

                'firstName.required'    => 'First Name is required',
                'firstName.alpha'       => 'First Name can only contain letters',
                'firstName.max'         => 'The First Name you entered is too long',

                'lastName.required'     => 'Last Name is required',
                'lastName.alpha'        => 'Last Name can only contain letters',
                'lastName.max'          => 'The Last Name you entered is too long',

                'email.required'        => 'Email is required',
                'email.max'             => 'The Email you entered is too long',
                'email.uniue'           => 'The is already a Candidate in the database with this Email',

                'phone.max'             => 'A phone number cannot be longer than 20 digits',

                'city.alpha_num'        => 'The city can only contain letters and numbers',
                'city.max'              => 'The city cannot be longer than 255 characters',

                'state.alpha'           => 'The state can only contain letters',
                'state.max'             => 'Please use the 2 letter state abbreviation',

                'industry.required'     => 'An industry must be specified for this candidate',
                'industry.max'          => 'An industry cannot be longer than 255 characters',
                'industry.alpha_num'    => 'An industry can only contain letters and numbers',

                'summary.required'      => 'A summary of the candidate is required',
                'summary.max'           => 'A summary cannot be longer than 255 characters',
            ]
        );
        try {
            Candidate::create([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
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
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
