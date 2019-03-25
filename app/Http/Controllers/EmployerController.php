<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\EmailHistory;
use App\Candidate;
use Illuminate\Support\Facades\DB;

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
            return $employer->transform();
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
        return view('admin/newEmployer');
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
                'walter_id' => 'numeric|nullable|unique:employers,walter_id|unique:candidates,walter_id',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'company' => 'required|max:255',
                'email' => 'required|max:255|unique:employers,email',
            ],
            [
                'walter_id.numeric' => 'A Walter Id can only contain numbers',
                'walter_id.unique' => 'This walter id already exists for another employer or candidate',

                'firstName.required' => 'First Name is required',
                'firstName.string' => 'First Name can only be a string',
                'firstName.max' => 'The First Name you entered is too long',

                'lastName.required' => 'Last Name is required',
                'lastName.string' => 'Last Name can only be a string',
                'lastName.max' => 'The Last Name you entered is too long',

                'company.required' => 'A company name is required for employers',
                'company.max' => 'The company name cannot be longer than 255 characters',

                'email.required' => 'Email is required',
                'email.max' => 'The Email you entered is too long',
                'email.uniue' => 'The is already a Candidate in the database with this Email',
            ]
        );
        try {
            Employer::create([
                'walter_id' => $request->walter_id,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'company' => $request->company,
                'email' => $request->email,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 500);
        }

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully added to Employers!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $employerId
     * @return \Illuminate\Http\Response
     */
    public function show($employerId)
    {
        $employer = Employer::find($employerId);

        return $employer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($employerId)
    {
        $employer = Employer::findOrFail($employerId);
        $emailHistories = EmailHistory::select(DB::raw('candidate_id, count(candidate_id) as times'))
            ->where('employer_id', $employer->id)
            ->groupBy('candidate_id')
            ->get();

        $emailHistories = $emailHistories->map(function ($emailHistory) {
            $candidate = Candidate::find($emailHistory->candidate_id);
            $emailHistory->candidate_name = $candidate->first_name. ' ' .$candidate->last_name;
            return $emailHistory;
        });
        
        return view('admin/editEmployer')
            ->with([
                'employer' => $employer,
                'emailHistories' => $emailHistories,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);
        $request->validate(
            [
                'walter_id' => 'numeric|nullable|unique:employers,walter_id,'. $employer->id .'|unique:candidates,walter_id',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'company' => 'required|max:255',
                'email' => 'required|max:255|unique:employers,email,'. $employer->id,
            ],
            [
                'walter_id.numeric' => 'A Walter Id can only contain numbers',
                'walter_id.unique' => 'This walter id already exists for another employer or candidate',

                'firstName.required' => 'First Name is required',
                'firstName.string' => 'First Name must be a string',
                'firstName.max' => 'The First Name you entered is too long',

                'lastName.required' => 'Last Name is required',
                'lastName.string' => 'Last Name must be a string',
                'lastName.max' => 'The Last Name you entered is too long',

                'company.required' => 'A company name is required for employers',
                'company.max' => 'The company name cannot be longer than 255 characters',

                'email.required' => 'Email is required',
                'email.max' => 'The Email you entered is too long',
                'email.uniue' => 'The is already a Candidate in the database with this Email',
            ]
        );

        try {
            $employer->update([
                'walter_id' => $request->walter_id,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'company' => $request->company,
                'email' => $request->email,
            ]);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 500);
        }

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId)->delete();

        return redirect()->route('dashboard')->withStatus($request->firstName. ' ' .$request->lastName. ' was successfully deleted!');
    }
}
