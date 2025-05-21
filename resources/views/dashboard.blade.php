@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="bg-red">
        {{ Auth::user()->name }}
        <h1>This is a dashboard</h1>
       
    </div>

@endsection
