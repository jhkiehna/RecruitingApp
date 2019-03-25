@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password for {{$user->email}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
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

                    <form action="{{ route('update.password') }}" method="POST" autocomplete="off">
                        @method('patch')
                        @csrf

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input class="form-control {{$errors->has('current_password') ? 'alert alert-danger' : ''}}" type="password" name="current_password" id="current_password" placeholder="current password">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input class="form-control {{$errors->has('password') ? 'alert alert-danger' : ''}}" type="password" name="password" id="password" placeholder="new password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">New Password Again</label>
                            <input class="form-control {{$errors->has('password') ? 'alert alert-danger' : ''}}" type="password" name="password_confirmation" id="password_confirmation" placeholder="new password again">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
