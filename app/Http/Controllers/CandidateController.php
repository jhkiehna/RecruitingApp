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
        return DataTables::of(Candidate::class)->toJson();
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
                'walterID' => 'required|alpha_num|unique:candidates,walter_id|max:10|min:10',
                'firstName' => 'required|alpha|max:255',
                'lastName' => 'required|alpha|max:255',
                'email' => 'required|max:255|unique:users,email',
                'phone' => 'max:255|numeric|nullable',
                'addr1' => 'max:255|nullable',
                'addr2' => 'max:255|nullable',
                'city' => 'alpha|max:255|nullable',
                'state' => 'alpha|max:2|nullable',
            ],
            [
                'walterID.required' => 'Please provide this candidate\'s Walter ID',
                'walterID.alpha_num' => 'A Walter ID can only contain letters and numbers',
                'walterID.unique' => 'There is already a candidate in the database with this Walter ID',
                'walterID.max' => 'A Walter Id must be exactly 10 characters',
                'walterID.min' => 'A Walter Id must be exactly 10 characters',

                'firstName.required' => 'First Name is required',
                'firstName.alpha' => 'First Name can only contain letters',
                'firstName.max' => 'The First Name you entered is too long',

                'lastName.required' => 'Last Name is required',
                'firstName.alpha' => 'Last Name can only contain letters',
                'firstName.max' => 'The Last Name you entered is too long',

                'email.required' => 'Email is required',
                'email.max' => 'The Email you entered is too long',
                'email.uniue' => 'The is already a Candidate in the database with this Email',

                'phone.max' => 'A phone number cannot be longer than 20 digits',
                'phone.numeric' => 'A phone number can only contain numbers. Do not use symbols such as (, ), or #',

                'addr1.max' => 'The Address you entered is too long',
                'addr2.max' => 'The Suite or Apt. # you entered is too long',

                'city.alpha' => 'City can only contain letters',
                'city.max' => 'The City you entered is too long',

                'state.alpha' => 'State can only contain letters',
                'state.max' => 'Please use the 2 letter abbreviation for State',
            ]
        );
        try {
            Candidate::create([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'street_address_1' => $request->addr1,
                'street_address_2' => $request->addr2,
                'city' => $request->city,
                'state' => $request->state,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 400);
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
