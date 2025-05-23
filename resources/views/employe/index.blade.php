@extends("layouts.app")
@section('title', 'Employe')

@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" 
        data-bs-toggle="modal" 
        data-bs-target="#employeModal">
        <i class="fa-solid fa-circle-plus me-2"></i>New Employee
        </button> 
    </div>
@endsection
    
@push("modals")
    @include('modals.employee.create');
    {{-- @include('modals.department.create'); --}}
@endpush
@push('scripts')
<script>
     // From Employee Modal → Open Department Modal
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

                // Fetch updated departments into dropdown
                fetchDepartments();
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
       


</script>
@endpush



  



