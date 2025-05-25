@extends("layouts.app")
@section('title', 'Employe')
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
input:checked + .slider {
  background-color: #28a745;
}
input:checked + .slider:before {
  transform: translateX(24px);
}

    </style>
@endpush
@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" 
        data-bs-toggle="modal" 
        data-bs-target="#employeModal">
        <i class="fa-solid fa-circle-plus me-2"></i>New Employee
        </button> 


        <table id="employeeDepartmentTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Profile</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
@endsection
    
@push("modals")
    @include('modals.employee.create');
    @include('modals.employee.edit');
    {{-- @include('modals.department.create'); --}}
@endpush
@push('scripts')
<script>
    
    $(document).ready(function(){

        let table = $('#employeeDepartmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nav.employee.index.data') }}",
            columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'employee_name',
                name: 'employee_name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'department.name',
                name: 'department.name'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
        })
    });


    $(document).on("click", ".departmentModal", function (e) {
        e.preventDefault();

        // Use `.one()` to avoid stacking multiple event listeners
        $('#employeModal').one('hidden.bs.modal', function () {
            
            $('#departmentModal').modal('show');
        });

        $('#employeModal').modal('hide');
    });

    // From Department Modal → Back to Employee Modal when Cancel or Close is clicked
    $(document).on("click", "#cancelBtn, #closeBtn", function () {
        $('#departmentModal').modal('hide');

        // When Department modal fully hides, reopen Employee modal
        $('#departmentModal').one('hidden.bs.modal', function () {
            $('#employeModal').modal('show');
        });
    });

    // Just close Employee Modal (Cancel or Close buttons)
    $(document).on("click", "#employCancelBtn, #employeCloseBtn", function () {
        $('#employeModal').modal('hide');
    });

   


    $(document).ready(function() {
    $('#createDepartmentForm').on('submit', function(e) {
        e.preventDefault();

        $('#nameError').text('').hide();
        $('#department_name').removeClass('is-invalid');

        let name = $('#department_name').val();

        $.ajax({
            url: "{{ route('nav.department.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                name: name
            },
            success: function(response){
                toastr.success(response.message);

                // Hide department modal
                $('#departmentModal').modal('hide');

                // Show employee modal again
                $('#employeModal').modal('show');

                // // Fetch updated departments into dropdown
                // fetchDepartments();
            },
            error: function(xhr){
                let errors = xhr.responseJSON?.errors;
                if(errors?.name){
                    $('#departmentNameDiv').find('#nameError').text(errors.name[0]).show();
                    $('#department_name').addClass('is-invalid');
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
});

function fetchDepartments() {
        console.log("Fetching departments..."); // Debugging line

        $.ajax({
            url: "{{ route('nav.department.fetch') }}", // Blade syntax, works only inside .blade.php
            method: 'GET',
            success: function (data) {
                let options = '<option value="">Select Department</option>';
                data.forEach(function (dept) {
                    options += `<option value="${dept.id}">${dept.name}</option>`;
                });
                $('#departmentDropdown').html(options);
            },
            error: function () {
                toastr.error("Failed to load departments.");
            }
        });
    }

    $(document).ready(function () {
        fetchDepartments();
    });
       

    $(document).ready(function(){
        $('#employeForm').on('submit', function(e){
            e.preventDefault();

            $('#employeNameError, #emailError, #departmentError, #statusError').text('').hide();
            $('#employeForm .form-control, #employeForm .form-check-input').removeClass('is-invalid');

           let formData = new FormData(this);

    $.ajax({
        url: "{{ route('nav.employe.store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
    toastr.success(response.message);
    $('#employeForm')[0].reset();

    // Hide modal using Bootstrap 5 API
    let employeModalEl = document.getElementById('employeModal');
    let modal = bootstrap.Modal.getInstance(employeModalEl);

    if (modal) {
        modal.hide();
    }

    // Ensure DataTable reloads
    
    // Fallback cleanup in case Bootstrap fails to remove the backdrop
    setTimeout(() => {
        $('body').removeClass('modal-open'); // Re-enable scroll
        $('.modal-backdrop').remove(); // Remove black overlay
        $('body').css('padding-right', ''); // Clear padding if any
        $('#employeeDepartmentTable').DataTable().ajax.reload(); 
    }, 300); // Matches Bootstrap’s fade duration
},

            error: function(xhr) {
                        console.log(xhr.responseText); // ← View the real error

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.employee_name) {
                $('#employeNameError').text(errors.employee_name[0]).show();
                $('#employe_name').addClass('is-invalid');
            }
            if (errors.email) {
                $('#emailError').text(errors.email[0]).show();
                $('#employe_email').addClass('is-invalid');
            }
            if (errors.department) {
                $('#departmentError').text(errors.department[0]).show();
                $('#departmentDropdown').addClass('is-invalid');
            }
            if (errors.status) {
                $('#statusError').text(errors.status[0]).show();
                $('input[name="status"]').addClass('is-invalid');
            }
            if (errors.profile) {
                $('#profileError').text(errors.profile[0]).show();
                $('#profile').addClass('is-invalid');
            }
                        } else {
                            toastr.error('Something went wrong. Check console.');
                        }
                    }


            });
        });
    });
    

     $(document).on("click",".update-employee-status",function(){
                const checkbox = $(this);
const id = checkbox.data("id");
const checked = checkbox.is(":checked");
const status = checked ? 'active' : 'inactive';

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Status will the updated',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                           url: "{{ route('nav.employee.status.update', ['id' => ':id']) }}".replace(":id",id), 
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                status: status
                            },
                            success: function (response) {
                                Swal.fire('Success!', 'Action completed successfully.', 'success');
                                DataTable.ajax.reload();
                            },
                            error: function (xhr, status, error) {
                                checkbox.prop("checked", checked);
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    } else {
                        checkbox.prop("checked", checked);
                        Swal.fire('Cancelled', 'Your action was cancelled.', 'info');
                    }
                });
            });



    //  $(document).on('click', '[data-bs-target="#editEmployeeModal"]', function() {
    //         let id = $(this).data('id');

    //         // Option 1: Make AJAX call to fetch department data
    //         $.ajax({
    //            
    //                 id), // You need to define this route
    //             type: 'GET',
    //             success: function(data) {
    //                 $('#department_edit_name').val(data.name);
    //                 $('#editDepartmentForm').data('data-id', id); // Store ID for later
    //             }
    //         });
    //     });

</script>
@endpush


 {{-- url: '{{ route('nav.employee.edit', ':id') }}'.replace(":id", --}}
  



