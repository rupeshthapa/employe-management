@extends('layouts.app')
@section('title', 'Department')
@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#departmentModal"><i class="fa-solid fa-circle-plus me-2"></i>New Department</button>
    </div>

        <!-- Modal -->
@include('department.create');

@endsection