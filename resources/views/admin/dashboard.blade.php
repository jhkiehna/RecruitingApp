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

                    You are logged in!

                    @include('admin.partials.candidates')

                    @include('admin.partials.employers')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection