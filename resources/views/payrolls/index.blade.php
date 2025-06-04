@extends('layouts.app')

@section('title', 'Payrolls')

@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#payrollModal">
            <i class="fa-solid fa-circle-plus me-2"></i>
            Add Payroll
        </button>


        <table id="payrollTable" class="table table-striped table-hover">
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

        });


    </script>
@endpush