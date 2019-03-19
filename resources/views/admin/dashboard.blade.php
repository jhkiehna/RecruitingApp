@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-info btn-block font-weight-bold" href="{{ route('create.employer') }}">Add an Employer</a>
                        </div>

                        <div class="col">
                            <a class="btn btn-info btn-block font-weight-bold" href="{{ route('create.candidate') }}">Add a Candidate</a>
                        </div>
                    </div>

                    @include('admin.partials.candidates')

                    @include('admin.partials.employers')
                    @include('email.modals.email-employer-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
