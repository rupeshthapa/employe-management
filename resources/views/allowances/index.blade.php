@extends('layouts.app')
@section('title', 'Allowances')

@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#allowanceModal">
            <i class="fa-solid fa-circle-plus me-2"></i>   Add Allowances
        </button>

        <table id="allowanceTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
        </table>



    </div>
    
@endsection

@push('modals')
    @include('modals.allowance.create')
    @include('modals.allowance.edit')
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){

            let table = $('#allowanceTable').DataTable({
                proccesing: true,
                serverSide: true,
            ajax: "{{ route('nav.allowances.index.data') }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'actions',
                name: 'actions',
                searchable: false,
                orderable: false
            }
            ]

            });



               $('#createAllowanceForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('#allowanceNameError, #amountError').text('').hide();
                $('#allowance_name, #amount').removeClass('is-invalid');

                let name = $('#allowance_name').val();
                let amount = $('#amount').val();


                $.ajax({
                    url: "{{ route('nav.allowances.store') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        amount: amount
                    },
                    success: function(response) {
                        toastr.success(response.message);

                        // Reset the form
                        $('#createAllowanceForm')[0].reset();

                        // Properly close the modal
                        const modalEl = document.getElementById('allowanceModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if (modal) {
                            modal.hide();
                        }

                        // Fallback cleanup to ensure backdrop & body state are cleared
                        setTimeout(() => {
                            $('.modal-backdrop').remove(); // Remove leftover overlay
                            $('body').removeClass('modal-open'); // Restore body scroll
                            $('body').css('padding-right',
                                ''); // Reset Bootstrap padding
                                $('#allowanceTable').DataTable().ajax.reload();
                        }, 300); // Wait for fade-out to finish
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // ← View the real error

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#allowanceNameError').text(errors.name[0]).show();
                                $('#allowance_name').addClass('is-invalid');
                            }
                            if (errors.amount) {
                                $('#amountError').text(errors.amount[0]).show();
                                $('#amount').addClass('is-invalid');
                            }
                        } else {
                            toastr.error('Something went wrong. Check console.');
                        }
                    }

                });
            });


            $(document).on('click', '.edit-allowance', function(){
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('nav.allowances.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(data){
                        $('#allowance_edit_name').val(data.name);
                        $('#edit_amount').val(data.amount);
                        $('#editAllowanceForm').data('data-id', id);
                    }
                });
            });


            $('#editAllowanceForm').on('submit', function(e){
                e.preventDefault();

                let id = $('#editAllowanceForm').data('data-id');
                let name = $('#allowance_edit_name').val();
                let amount = $('#edit_amount').val();


                $('#allowanceEditNameError, #editAmountError').text('').hide();
                $('#allowance_edit_name, edit_amount').removeClass('is-invalid');

                $.ajax({
                    url: `/allowances-update/${id}`,
                    type: 'PUT',
                    
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        amount: amount

                    },
                    success: function(response){
                        toastr.success(response.message);
                        $('#editAllowanceForm')[0].reset();

                        const modalEl = document.getElementById('allowanceEditModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if(modal){
                            modal.hide();
                        }

                        setTimeout(() => {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '');
                        }, 300);
                        $('#allowanceTable').DataTable().ajax.reload();
                    },
                    error:function(xhr){
                        if(xhr.status === 422){
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('#allowanceEditNameError').text(errors.name[0]).show();
                                $('#allowance_edit_name').addClass('is-invalid');
                            }
                            if(errors.amount){
                                $('#editAmountError').text(errors.amount[0]).show();
                                $('#edit_amount').addClass('is-invalid');
                            }
                        }else{
                            toastr.error('An error occurred while updating allowance.');
                        }
                    }
                });
            });



            
            $(document).on('click', '.delete-allowance', function(){
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButton: 'Cancel'
                }).then((result) => {
                    if(result.isConfirmed){
                        $.ajax({
                            url: '{{ route('nav.allowances.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response){
                                Swal.fire('Deleted!', response.message, 'success');
                                $('#allowanceTable').DataTable().ajax.reload();
                            },
                            error: function(){
                                Swal.fire('Error!', 'Failed to delete');
                            }
                        })
                    }
                });
            });
        });
    </script>
@endpush