@extends('layouts.app')

@section('title', 'Payrolls')

@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#payrollModal">
            <i class="fa-solid fa-circle-plus me-2"></i>
            Add Payroll
        </button>
    </div>


@endsection

@push('modals')
    @include('modals.payrolls.create')
@endpush

@push('scripts')
    <script>

        $(document).ready(function(){

            $('#createPayrollForm').on('submit', function(e){
                e.preventDefault();

                $('#payrollDateError').text('').hide();
                $('#payrollStatusError').text('').hide();

                
            });

        });


    </script>
@endpush