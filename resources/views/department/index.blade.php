@extends('layouts.app')

@section('title', 'Department')

@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#departmentModal">
            <i class="fa-solid fa-circle-plus me-2"></i>New Department
        </button>


        <table id="departmentTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push("modals")
    @include('modals.department.create');
    @include('modals.department.edit');
@endpush



@push('scripts')
    <script>
        $(document).ready(function() {



            let table = $('#departmentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nav.department.index.data') }}",
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
                    // {data: 'action', name: 'action', render: function(meta,data){
                    //     return "helkl9o";
                    // }, searchable: false, orderable: false}
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    }

                ]
            });

           
            

            $('#createDepartmentForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('#nameError').text('').hide();
                $('#department_name').removeClass('is-invalid');

                let name = $('#department_name').val();

                $.ajax({
                    url: "{{ route('nav.department.store') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        toastr.success(response.message);

                        // Reset the form
                        $('#createDepartmentForm')[0].reset();

                        // Properly close the modal
                        const modalEl = document.getElementById('departmentModal');
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
                                $('#departmentTable').DataTable().ajax.reload();
                        }, 300); // Wait for fade-out to finish
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // ← View the real error

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#nameError').text(errors.name[0]).show();
                                $('#department_name').addClass('is-invalid');
                            }
                        } else {
                            toastr.error('Something went wrong. Check console.');
                        }
                    }

                });
            });

        });

        $(document).on('click', '[data-bs-target="#departmentEditModal"]', function() {
            let id = $(this).data('id');

            // Option 1: Make AJAX call to fetch department data
            $.ajax({
                url: '{{ route('nav.department.edit', ':id') }}'.replace(":id",
                    id), // You need to define this route
                type: 'GET',
                success: function(data) {
                    $('#department_edit_name').val(data.name);
                    $('#editDepartmentForm').data('data-id', id); // Store ID for later
                }
            });
        });

        $('#editDepartmentForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#editDepartmentForm').data('data-id'); // OR use $('#edit_department_id').val();
            let name = $('#department_edit_name').val();

            // Clear previous errors
            $('#editNameError').text('').hide();
            $('#department_edit_name').removeClass('is-invalid');

            $.ajax({
                url: `/department/${id}`, // or use `{{ url('department') }}/${id}`
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name
                },
                success: function(response) {
                    toastr.success(response.message);

                    // Reset the form
                    $('#editDepartmentForm')[0].reset();

                    // Properly close the modal
                    const modalEl = document.getElementById('departmentEditModal'); // ✅ corrected ID
                    const modal = bootstrap.Modal.getInstance(modalEl);

                    if (modal) {
                        modal.hide();
                    }

                    // Fallback cleanup
                    setTimeout(() => {
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                    }, 300);
                    $('#departmentTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) {
                            $('#editNameError').text(errors.name[0]).show();
                            $('#department_edit_name').addClass('is-invalid');
                        }
                    } else {
                        toastr.error("Something went wrong.");
                        console.log(xhr.responseText);
                    }
                }
            });




        });


        $(document).on("click", ".delete-departments", function () {
    let dataId = $(this).data("id");

    Swal.fire({
        title: 'Are you sure?',
        text: 'This cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/department-destroy/' + dataId, // Direct URL
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#departmentTable').DataTable().ajax.reload();
                },
                error: function () {
                    Swal.fire('Error!', 'Failed to delete department.', 'error');
                }
            });
        }
    });
});

            

    </script>
@endpush