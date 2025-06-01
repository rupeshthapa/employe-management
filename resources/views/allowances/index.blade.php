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
                    <th>Allowance Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
        </table>



    </div>
    
@endsection

@push('modals')
    @include('modals.allowance.create')
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
                $('#allowanceNameError').text('').hide();
                $('#allowance_name').removeClass('is-invalid');

                let name = $('#allowance_name').val();

                $.ajax({
                    url: "{{ route('nav.allowances.store') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        toastr.success(response.message);

                        // Reset the form
                        $('#createAllowanceForm')[0].reset();

                        // Properly close the modal
                        // const modalEl = document.getElementById('allowanceModal');
                        // const modal = bootstrap.Modal.getInstance(modalEl);

                        // if (modal) {
                        //     modal.hide();
                        // }

                        // // Fallback cleanup to ensure backdrop & body state are cleared
                        // setTimeout(() => {
                        //     $('.modal-backdrop').remove(); // Remove leftover overlay
                        //     $('body').removeClass('modal-open'); // Restore body scroll
                        //     $('body').css('padding-right',
                        //         ''); // Reset Bootstrap padding
                        //         $('#departmentTable').DataTable().ajax.reload();
                        // }, 300); // Wait for fade-out to finish
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // ← View the real error

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#allowanceNameError').text(errors.name[0]).show();
                                $('#allowance_name').addClass('is-invalid');
                            }
                        } else {
                            toastr.error('Something went wrong. Check console.');
                        }
                    }

                });
            });

        
        });
    </script>
@endpush