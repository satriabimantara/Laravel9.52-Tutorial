@extends('layouts.app')
@section('title')
    Login Page
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h4 class="text-center">Login</h4>
        <form action="{{ url('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <span class="text-muted">New user? <a href="{{ url('register') }}" class="card-link">Register here!</a></span>

        </form>
    </div>
</div>
@endsection
