<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();

        $transformedEmployers = $employers->map(function ($employer) {
            return $employer->transformer();
        });
        
        return DataTables::of($transformedEmployers)->make(true);
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
                'walterID' => 'numeric|unique:employers,walter_id|nullable',
                'firstName' => 'required|alpha|max:255',
                'lastName' => 'required|alpha|max:255',
                'email' => 'required|max:255|unique:users,email',
                'phone' => 'max:20|nullable',
            ],
            [
                'walterID.unique' => 'There is already a candidate in the database with this Walter ID',
                'walterID.numeric' => 'A Walter Id can only contain numbers',

                'firstName.required' => 'First Name is required',
                'firstName.alpha' => 'First Name can only contain letters',
                'firstName.max' => 'The First Name you entered is too long',

                'lastName.required' => 'Last Name is required',
                'lastName.alpha' => 'Last Name can only contain letters',
                'lastName.max' => 'The Last Name you entered is too long',

                'email.required' => 'Email is required',
                'email.max' => 'The Email you entered is too long',
                'email.uniue' => 'The is already a Candidate in the database with this Email',

                'phone.max' => 'A phone number cannot be longer than 20 digits',
            ]
        );
        try {
            Candidate::create([
                'walter_id' => $request->walterID,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 500);
        }

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully added to Candidates!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        //
    }
}
