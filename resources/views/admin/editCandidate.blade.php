@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$candidate->full_name}}</div>

                <div class="card-body">
                    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('update.candidate', ['id' => $candidate->id]) }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="walterID">Walter ID</label>
                            <input class="form-control {{$errors->has('walterID') ? 'alert alert-danger' : ''}}" type="text" name="walterID" id="walterID" placeholder="..." value="{{ old('walterID') ?? $candidate->walter_id}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="firstName">First Name</label>
                                <input class="form-control {{$errors->has('firstName') ? 'alert alert-danger' : ''}}" type="text" name="firstName" id="firstName" placeholder="..." value="{{old('firstName') ?? $candidate->first_name}}">
                            </div>

                            <div class="form-group col">
                                <label for="lastName">Last Name</label>
                                <input class="form-control {{$errors->has('lastName') ? 'alert alert-danger' : ''}}" type="text" name="lastName" id="lastName" placeholder="..." value="{{old('lastName') ?? $candidate->last_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Optional)</label>
                            <input class="form-control {{$errors->has('email') ? 'alert alert-danger' : ''}}" type="email" name="email" id="email" placeholder="..." value="{{old('email') ?? $candidate->email}}">
                        </div>

                        <div class="form-group">
                            <label for="locationPreference">Location Preference (Optional)</label>
                            <input class="form-control {{$errors->has('locationPreference') ? 'alert alert-danger' : ''}}" type="text" name="locationPreference" id="locationPreference" placeholder="..." value="{{old('locationPreference') ?? $candidate->location_preference}}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Job Title</label>
                            <input class="form-control {{$errors->has('jobTitle') ? 'alert alert-danger' : ''}}" type="text" name="jobTitle" id="jobTitle" placeholder="current or desired position..." value="{{old('jobTitle') ?? $candidate->job_title}}">
                        </div>

                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <input class="form-control {{$errors->has('industry') ? 'alert alert-danger' : ''}}" type="text" name="industry" id="industry" placeholder="working in..." value="{{old('industry') ?? $candidate->industry }}">
                        </div>

                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea class="form-control {{$errors->has('summary') ? 'alert alert-danger' : ''}}" rows="3" name="summary" id="summary" placeholder="candidate position description...">{{ old('summary') ?? $candidate->summary }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Update {{ $candidate->full_name }}</button>
                    </form>
                    <br>
                    <form id="deleteCandidateForm" action="{{ route('delete.candidate', ['id' => $candidate->id]) }}" method="POST">
                        @csrf

                        <p class="alert alert-danger" id="deleteWarning" hidden></p>
                        <button type="submit" id="deleteCandidateButton" class="btn btn-primary btn-sm float-right">Delete {{ $candidate->full_name }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('candidateScripts')
<script defer>
    $(document).ready(function () {
        $("#deleteCandidateButton").click(function(e) {
            e.preventDefault();

            $("#deleteWarning").removeAttr("hidden").text("Are you sure you want to delete {{ $candidate->full_name }}? Press the button again to confirm.");
            $("#deleteCandidateButton").text("Really Delete {{ $candidate->full_name }}?");
            
            $("#deleteCandidateButton").unbind();

            $("#deleteCandidateButton").click(function() {
                $("#deleteCandidateForm").submit();
            });
        })
    });
</script>
@endsection