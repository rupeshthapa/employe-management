@extends('layouts.app')

@section('title', 'Bonus')

@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#bonusModal">
            <i class="fa-solid fa-circle-plus me-2"></i>New Bonus
        </button>

        <table id="bonusTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bonus Name</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>


    </div>

@endsection

@push('modals')
    @include('modals.bonuses.create')
    @include('modals.bonuses.edit')
@endpush


@push('scripts')
    <script>
        $(document).ready(function(){
            $('#bonusTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nav.bonuses.index.data') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
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


            $('#createBonusForm').on('submit', function(e){
                e.preventDefault();

                let  name = $('#bonus_name').val();
                let amount = $('#amount').val();

                $('#bonusNameError, #amountError').text('').hide();
                $('#bonus_name, #amount').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('nav.bonuses.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        amount: amount,
                    },
                    success:function(response){
                        toastr.success(response.message);
                        $('#createBonusForm')[0].reset();

                        const modalEl = document.getElementById('bonusModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if(modal){
                            modal.hide();
                        }

                        setTimeout(() => {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '');
                        }, 300);
                        $('#bonusTable').DataTable().ajax.reload();
                    },
                    error:function(xhr){
                        if(xhr.status === 422){
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('#bonusNameError').text(errors.name[0]).show();
                                $('#bonus_name').addClass('is-invalid');
                            }
                            if(errors.amount){
                                $('#amountError').text(errors.amount[0]).show();
                                $('#amount').addClass('is-invalid');
                            }
                        }
                    }
                });
            });


            $(document).on('click', '.edit-bonus', function(){
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('nav.bonuses.edit', ':id') }}".replace(':id', id),
                    type: "GET",
                    success:function(data){
                        $('#editBonus_name').val(data.name);
                        $('#editAmount').val(data.amount);
                        $('#editBonusForm').data('data-id', id);
                    }
                })
            });

            
            $('#editBonusForm').on('submit', function(e){
                e.preventDefault();
                
                let id = $('#editBonusForm').data('data-id');
                let name = $('#editBonus_name').val();
                let amount = $('#editAmount').val();
                
                $('#editBonusNameError, #editAmountError').text('').hide();
                $('#editBonus_name, #editAmount').removeClass('is-invalid');
                
                $.ajax({
                    url: `/bonuses-update/${id}`,
                    type: "PUT",
                    data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    amount: amount
                },
                success:function(response){
                    toastr.success(response.message);
                    $('#editBonusForm')[0].reset();
                    
                    const modeEl = document.getElementById('editBonusModal');
                    const modal = bootstrap.Modal.getInstance(modeEl);
                    
                    if(modal){
                        modal.hide();
                    }
                    setTimeout(() => {
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                    }, 300);
                    $('#bonusTable').DataTable().ajax.reload();
                },
                error:function(xhr){
                    if(xhr.status === 422){
                        let errors = xhr.responseJSON.errors;
                        if(errors.name){
                            $('#editBonusNameError').text(errors.name[0]).show();
                            $('#editBonus_name').addClass('is-invalid');
                        }
                        if(errors.amount){
                            $('#editAmountError').text(errors.name[0]).show();
                            $('#editAmount').addClass('is-invalid');
                        }
                    }else{
                        toastr.error('An error occurred while updating bonus.');
                    }
                }
            });
            
            
            
            $(document).on('click', '.delete-bonus', function(){
                let id = $(this).data('id');
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "You will not be able to recover this bonus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if(result.isConfirmed){
                        $.ajax({
                            url: "{{ route('nav.bonuses.destroy', ':id') }}".replace(':id', id),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success:function(response){
                                Swal.fire("Deleted!", response.message, "success");
                                $('#bonusTable').DataTable().ajax.reload();
                            },
                            error:function(xhr){
                                Swal.fire("Error!", "An error occurred while deleting bonus.", "error");
                            }
                        })
                    }
                });
                
            });
        });

    });
    </script>
@endpush