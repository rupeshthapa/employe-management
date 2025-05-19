@extends('layouts.app')
@section('title', 'Employe')
@section('content')
    <div class="container my-5">
        <form method="GET" action="{{ route('nav.employe.create') }}">
        @csrf
            <button class="btn btn-primary d-flex align-items-center">
                <i class="fa-solid fa-plus-circle me-2"></i> New Product
            </button>
        </form>
        </div>
@endsection