@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a New Candidate</div>

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

                    <form action="{{ route('store.candidate') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="walterID">Walter ID</label>
                            <input class="form-control {{$errors->has('walterID') ? 'alert alert-danger' : ''}}" type="text" name="walterID" id="walterID" placeholder="..." value="{{old('walterID')}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="firstName">First Name</label>
                                <input class="form-control {{$errors->has('firstName') ? 'alert alert-danger' : ''}}" type="text" name="firstName" id="firstName" placeholder="..." value="{{old('firstName')}}">
                            </div>

                            <div class="form-group col">
                                <label for="lastName">Last Name</label>
                                <input class="form-control {{$errors->has('lastName') ? 'alert alert-danger' : ''}}" type="text" name="lastName" id="lastName" placeholder="..." value="{{old('lastName')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control {{$errors->has('email') ? 'alert alert-danger' : ''}}" type="email" name="email" id="email" placeholder="..." value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input class="form-control {{$errors->has('phone') ? 'alert alert-danger' : ''}}" type="text" name="phone" id="phone" placeholder="..." value="{{old('phone')}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-9">
                                <label for="firstName">Street Address</label>
                                <input class="form-control {{$errors->has('addr1') ? 'alert alert-danger' : ''}}" type="text" name="addr1" id="addr1" placeholder="..." value="{{old('addr1')}}">
                            </div>

                            <div class="form-group col-3">
                                <label for="firstName">Suite or Apt. #</label>
                                <input class="form-control {{$errors->has('addr2') ? 'alert alert-danger' : ''}}" type="text" name="addr2" id="addr2" placeholder="..." value="{{old('addr2')}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-9">
                                <label for="City">City</label>
                                <input class="form-control {{$errors->has('city') ? 'alert alert-danger' : ''}}" type="text" name="city" id="city" placeholder="..." value="{{old('city')}}">
                            </div>

                            <div class="form-group col-3">
                                <label for="firstName">State</label>
                                <input class="form-control {{$errors->has('state') ? 'alert alert-danger' : ''}}" type="text" name="state" id="state" placeholder="..." value="{{old('state')}}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add This Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection