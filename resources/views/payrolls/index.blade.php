@extends('layouts.app')

@section('title', 'Payrolls')
@push('styles')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 25px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#payrollModal">
            <i class="fa-solid fa-circle-plus me-2"></i>
            Add Payroll
        </button>


        <table id="payrollTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Salary Month</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>


@endsection

@push('modals')
@include('modals.payrolls.create')
@include('modals.payrolls.edit')
@endpush

@push('scripts')
    <script>

        $(document).ready(function(){

            $('#payrollTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nav.payrolls.index.data') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'salary_month',
                        name: 'salary_month',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            $('#createPayrollForm').on('submit', function(e){
                e.preventDefault();

                $('#payrollDateError').text('').hide();
                $('#payrollStatusError').text('').hide();

                $('#payroll_date').removeClass('is-invalid');
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('nav.payrolls.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success:function(response){
                        console.log(response.data);
                        toastr.success(response.message);
                        $('#createPayrollForm')[0].reset();

                        const modalEl = document.getElementById('payrollModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if(modal){
                            modal.hide();
                        }

                        setTimeout(() => {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('body').css('padding-right', '');
                        }, 300);
                        
                        $('#payrollTable').DataTable().ajax.reload();
                  },
                  error:function(xhr){
                    if(xhr.status === 422){
                        let errors = xhr.responseJSON.errors;
                        if(errors.salary_month){
                            $('#payrollDateError').text(errors.salary_month[0]).show();
                            $('#salary_month').addClass('is-invalid');

                        }
                    }else{
                        toastr.error('Error creating payroll');
                    }
                  }
                });
            });



           $(document).on('click', '.update-payroll-status', function () {
                const checkbox = $(this);
                const id = checkbox.data('id');
                const checked = checkbox.is(':checked');
                const status = checked ? 'processed' : 'draft';

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Status will be updated',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('nav.payrolls.updateStatus', ['id' => ':id']) }}".replace(":id", id), 
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                status: status
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message || 'Something went wrong!');
                                }
                            },
                            error: function (xhr) {
                                toastr.error('An error occurred while updating status.');
                                // Optionally uncheck the checkbox if error
                                checkbox.prop('checked', !checked);
                            }
                        });
                    } else {
                        // Revert checkbox state if cancelled
                        checkbox.prop('checked', !checked);
                    }
                });
            });


            $(document).on('click', '.edit-payroll', function(){
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('nav.payrolls.edit', ['id' => ':id']) }}".replace(':id', id),
                    type: "GET",

                    success:function(response){
                        $('#editPayrollForm').data('id', id);

                        $('#edit_payroll_date').val(response.salary_month);
                        
                        if(response.status == 'draft'){
                            $('#edit_statusDraft').prop('checked', true);
                        }
                        else if(response.status == 'processed'){
                            $('#edit_statusProcessed').prop('checked', true);
                        }
                    },
                    error: function(){
                        toastr.error('Error editing payroll');
                    }
                });
            });


            $('#editPayrollForm').on('submit', function(e){
                e.preventDefault();

                $('#edit_payrollDateError, #edit_payrollStatusError').text('').hide();
                $('#edit_payroll_date').removeClass('is-invalid');

                let id = $('#editPayrollForm').data('id');
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('nav.payrolls.update', ['id' => ':id']) }}".replace(':id', id),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                    toastr.success(response.message);

                    const modalEl = document.getElementById('editPayrollModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);

                    if(modal){
                        modal.hide();
                    }
                    setTimeout(() => {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        $('body').css('padding-right', '')
                    }, 300);

                    $('#payrollTable').DataTable().ajax.reload();
                },

                        error: function(xhr){
                            if(xhr.status === 422){
                                let errors = xhr.responseJSON.errors;
                                if(errors.salary_month){
                                    $('#edit_payrollDateError').text(errors.salary_month[0]).show();
                                    $('#edit_payroll_date').addClass('is-invalid');
                                }
                                if(errors.status){
                                    $('#edit_payrollStatusError').text(errors.status[0]).show();
                                }
                            } else {
                                toastr.error('Error updating payroll');
                            }
                        }
                    });
                });


                $(document).on('click', '.delete-payroll', function(){

                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure you want to delete this payroll?',
                        text: 'You will not be able to recover this payroll.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: 'nav/payrolls/' + id,
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Payroll has been deleted.',
                                        'success'
                                    );
                                    $('#payrollTable').DataTable().ajax.reload();
                                    },
                                    error: function (xhr) {
                                        Swal.fire(
                                            'Error deleting payroll',
                                            'Please try again',
                                            'error'
                                        );
                                        }
                                });
                            }
                        


                        
                    });

                });
        });


    </script>
@endpush