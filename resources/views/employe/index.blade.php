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
    @include('modals.employee.create', $departments);
    @include('modals.department.create');
@endpush
@push('scripts')
<script>
    // From Employee Modal → Open Department Modal
    $(document).on("click", ".departmentModal", function (e) {
        e.preventDefault();

        // When employee modal fully hides, open department modal
        $('#employeModal').one('hidden.bs.modal', function () {
            $('#departmentModal').modal('show');
        });

        $('#employeModal').modal('hide');
    });

    // From Department Modal → Back to Employee Modal
    $(document).on("click", "#cancelBtn, #closeBtn", function () {
        $('#departmentModal').modal('hide');

        // When department modal is fully hidden, reopen employee modal
        $('#departmentModal').one('hidden.bs.modal', function () {
            $('#employeModal').modal('show');
        });
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
                $('#departmentModal').modal('hide');
                $('#employeModal').modal('show');
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

</script>
@endpush



  



