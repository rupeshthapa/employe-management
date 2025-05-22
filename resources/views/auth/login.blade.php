@extends('layouts.auth.layout')

@section('title', 'Login')

@section('content')
    <h1 class="card-title text-center"><i class="fas fa-user"></i> Login</h1>
    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <div class="mb-3 position-relative">
            <label class="form-label">E-mail</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input type="email" name="email" class="form-control" placeholder="Enter your email">
            </div>
            @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-3 position-relative">
        <label for="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Enter your password">
        </div>
        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="d-flex justify-content-center">
        <button class="btn btn-dark w-75">Login</button>
    </div>
</form>
    <div class="d-flex justify-content-center">
        <a href="{{ route('user.register-index') }}">Register</a>
    </div>
@endsection