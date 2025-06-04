@extends('layouts.app')
@section('title', 'Payslip')
@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#payslipModal">
            <i class="fa-solid fa-circle-plus me-2"></i>New Payslip
        </button>

        <table id="payslipTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
        </table>
    </div>


@push('modals')
    @include('modals.payslips.create')
@endpush


@push('scripts')
    
@endpush
@endsection