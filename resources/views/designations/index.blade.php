@extends('layouts.app')
@section('title', 'Designations')
@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
        data-bs-target="#desginationModal">
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
    $(document).ready(function(){
        let table = $('#designationTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nav.designations.index.data') }}",
            columns: [{
                data: 'id',
                name: 'id'
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
                orderable: false,
                searchable: false
            }
            ]






        });
        $('#desginationModal').on('submit', function(e){
            e.preventDefault();

            $('#designationNameError').text('').hide();
            $('#designation_name').removeClass('is-invalid');

            let name = $('#designation_name').val();

            $.ajax({
                url: "{{ route('nav.designations.store') }}",
                method: 'POST',
                data:{
                    _token: "{{ csrf_token() }}",
                    name: name
                },
                success: function(response){
                    toastr.success(response.message);
                    $('#createDesignationForm')[0].reset();
                    const modalEl = document.getElementById('desginationModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    
                    if(modalInstance){
                        modalInstance.hide();
                    }
                    setTimeout(() => {
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                    
                    }, 300);
                },
                error: function(error){
                     if(error.status === 422){
                        let errors = error.responseJSON.errors;
                        if(errors.name){
                            $('#designationNameError').text(errors.name[0]).show();
                            $('#designation_name').addClass('is-invalid');
                        }
                    } else{
                        toastr.error('Something went wrong');
                    }
                }
            });
        });
    });


    $(document).on('click', '.edit-designation', function () {
    let id = $(this).data('id');

    $.ajax({
        url: "{{ route('nav.designations.edit', ':id') }}".replace(':id', id),
        type: "GET",
        success: function (data) {
            $('#designation_edit_name').val(data.name);

            // Set the ID on the form using jQuery's .data()
            $('#editDesignationForm').data('id', id); 
            
            $('#desginationEditModal').modal('show');
        },
        error: function () {
            toastr.error('Something went wrong');
        }
    });
});




    $('#editDesignationForm').on('submit', function (e) {
    e.preventDefault();

    // Corrected: use .data('id') instead of .data('data-id')
    let id = $(this).data('id'); 
    let name = $('#designation_edit_name').val();

    $('#edit_designationNameError').text('').hide();
    $('#designation_edit_name').removeClass('is-invalid');

    $.ajax({
        url: "{{ route('nav.designations.update', ':id') }}".replace(':id', id),
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "PUT", // Laravel expects PUT/PATCH for updates
            name: name
        },
        success: function (response) {
            toastr.success(response.message);
           
            $('#editDesignationForm')[0].reset();
             const modalEl = document.getElementById('desginationEditModal'); // ✅ corrected ID
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
            $('#designationTable').DataTable().ajax.reload();
        },
        error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $('#edit_designationNameError').text(xhr.responseJSON.errors.name[0]).show();
                $('#designation_edit_name').addClass('is-invalid');
            } else {
                toastr.error('Something went wrong.');
            }
        }
    });
});


    $(document).on('click', '.delete-designation', function(){
    let id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url: "{{ route('nav.designations.destroy', ':id') }}".replace(':id', id),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#designationTable').DataTable().ajax.reload();
                }, 
                error: function(){
                    Swal.fire('Error!', 'Failed to delete designation.', 'error');
                }
            });
        }
    });
});


    </script>
@endpush