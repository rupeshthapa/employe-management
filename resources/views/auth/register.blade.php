@extends('layouts.auth.layout')
@section('title', 'Register')

@section('content')


    <h1 class="card-title text-center"><i class="fas fa-users"></i> Register</h1>
    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="mb-3 position-relative">
            <label class="form-label">Username</label>
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input class="form-control" type="text" name="name" placeholder="Enter your fullname">
        </div>
         @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3 position-relative">
        <label class="form-label">E-mail</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input class="form-control" type="email" name="email" placeholder="Enter your email">
        </div>
         @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3 position-relative">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input class="form-control" type="password" name="password" placeholder="Enter your password">
        </div>
         @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3 position-relative">
        <label class="form-label">Confirm Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Enter same password">
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-dark w-75">Register</button>
    </div>
</form>
    <div class="d-flex justify-content-center">
        <a href="{{ route('user.login-index') }}">Login</a>
    </div>
    
@endsection