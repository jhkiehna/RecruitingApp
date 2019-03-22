@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$employer->full_name}}</div>

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

                    <form action="{{ route('update.employer', ['id' => $employer->id]) }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="walter_id">Walter ID (Optional)</label>
                            <input class="form-control {{$errors->has('walter_id') ? 'alert alert-danger' : ''}}" type="text" name="walter_id" id="walter_id" placeholder="..." value="{{old('walter_id') ?? $employer->walter_id}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="firstName">First Name</label>
                                <input class="form-control {{$errors->has('firstName') ? 'alert alert-danger' : ''}}" type="text" name="firstName" id="firstName" placeholder="..." value="{{old('firstName') ?? $employer->first_name}}">
                            </div>

                            <div class="form-group col">
                                <label for="lastName">Last Name</label>
                                <input class="form-control {{$errors->has('lastName') ? 'alert alert-danger' : ''}}" type="text" name="lastName" id="lastName" placeholder="..." value="{{old('lastName') ?? $employer->last_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company">Company</label>
                            <input class="form-control {{$errors->has('company') ? 'alert alert-danger' : ''}}" type="text" name="company" id="company" placeholder="..." value="{{old('company') ?? $employer->company}}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control {{$errors->has('email') ? 'alert alert-danger' : ''}}" type="email" name="email" id="email" placeholder="..." value="{{old('email') ?? $employer->email}}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Update {{ $employer->full_name }}</button>
                    </form>
                    <br>
                    <form id="deleteEmployerForm" action="{{ route('delete.employer', ['id' => $employer->id]) }}" method="POST">
                        @csrf

                        <p class="alert alert-danger" id="deleteWarning" hidden></p>
                        <button type="button" id="deleteEmployerButton" class="btn btn-primary btn-sm float-right">Delete {{ $employer->full_name }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('employerScripts')
<script defer>
    $(document).ready(function () {
        $("#deleteEmployerButton").click(function(e) {
            e.preventDefault();

            $("#deleteWarning").removeAttr("hidden").text("Are you sure you want to delete {{ $employer->full_name }}? Press the button again to confirm.");
            $("#deleteEmployerButton").text("Really Delete {{ $employer->full_name }}?");
            
            $("#deleteEmployerButton").unbind();

            $("#deleteEmployerButton").click(function() {
                $("#deleteEmployerForm").submit();
            });
        })
    });
</script>
@endsection