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
    
    
@endpush


@push("scripts")
  <script>
    // Step 1: Open Department Modal from inside Employee Modal
    $(document).on("click", ".departmentModal", function (e) {
        e.preventDefault();

        // Wait until employeModal is hidden, then show departmentModal
        $("#employeModal").one("hidden.bs.modal", function () {
            $("#departmentModal").modal("show");
        });

        $("#employeModal").modal("hide");
    });

</script>
  



@endpush