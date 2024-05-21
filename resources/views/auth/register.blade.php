@extends('layouts.app')
@section('title')
    Registration Page
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <h4 class="text-center">Registration</h4>
        <form action="{{ url('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">

                @if ($errors->has('name'))
                <p class="alert-danger">{{ $errors->first('name') }}</p>
                @endif

            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                @if ($errors->has('email'))
                <p class="alert-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @if ($errors->has('password'))
                <p class="alert-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </div>
</div>
@endsection
