@extends('layouts.app')
@section('title', 'Designations')
@section('content')

<div class="container my-5">
    <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
        data-bs-target="#designationModal">
        <i class="fa-solid fa-circle-plus me-2"></i>New Designation
    </button>

    <table id="designationTable" class="table table-bordered table-striped my-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Designation Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@push('modals')
    @include('modals.designation.create')
    @include('modals.designation.edit')
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    let table = $('#designationTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('nav.designations.index.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });

    // CREATE Designation
    $('#createDesignationForm').on('submit', function (e) {
        e.preventDefault();

        $('#designationNameError').text('').hide();
        $('#designation_name').removeClass('is-invalid');

        let name = $('#designation_name').val();

        $.ajax({
            url: "{{ route('nav.designations.store') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                name: name
            },
            success: function (response) {
                toastr.success(response.message);
                $('#createDesignationForm')[0].reset();

                const modalEl = document.getElementById('designationModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                setTimeout(() => {
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                }, 300);

                table.ajax.reload();
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('#designationNameError').text(errors.name[0]).show();
                        $('#designation_name').addClass('is-invalid');
                    }
                } else {
                    toastr.error('Something went wrong');
                }
            }
        });
    });

    // EDIT Designation
    $(document).on('click', '.edit-designation', function () {
        let id = $(this).data('id');

        $.ajax({
            url: "{{ route('nav.designations.edit', ':id') }}".replace(':id', id),
            type: "GET",
            success: function (data) {
                $('#designation_edit_name').val(data.name);
                $('#editDesignationForm').data('id', id);
                $('#designationEditModal').modal('show');
            },
            error: function () {
                toastr.error('Something went wrong');
            }
        });
    });

    $('#editDesignationForm').on('submit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let name = $('#designation_edit_name').val();

        $('#edit_designationNameError').text('').hide();
        $('#designation_edit_name').removeClass('is-invalid');

        $.ajax({
            url: "{{ route('nav.designations.update', ':id') }}".replace(':id', id),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                name: name
            },
           success: function (response) {
    toastr.success(response.message);

    $('#editDesignationForm')[0].reset();

    const modalEl = document.getElementById('designationEditModal'); // ✅ fixed ID spelling
    const modal = bootstrap.Modal.getInstance(modalEl);

    if (modal) {
        modal.hide();
    } else {
        // fallback
        $('#designationEditModal').modal('hide');
    }

    setTimeout(() => {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    }, 300);

    $('#designationTable').DataTable().ajax.reload();
},

            error: function (xhr) {
                if (xhr.responseJSON?.errors?.name) {
                    $('#edit_designationNameError').text(xhr.responseJSON.errors.name[0]).show();
                    $('#designation_edit_name').addClass('is-invalid');
                } else {
                    toastr.error('Something went wrong.');
                }
            }
        });
    });

    // DELETE Designation
    $(document).on('click', '.delete-designation', function () {
        let id = $(this).data('id');

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
                    url: "{{ route('nav.designations.destroy', ':id') }}".replace(':id', id),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        table.ajax.reload();
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to delete designation.', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush
