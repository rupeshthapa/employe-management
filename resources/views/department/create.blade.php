@include('layouts.cdn.headerLink')
<div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createDepartmentForm">
        @csrf
        <div class="modal-header" method="POST">
          <h5 class="modal-title" id="employeeModalLabel">Add New Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control" id="department_name" name="name">
            <div class="invalid-feedback" id="nameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Department</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include('layouts.cdn.footerScript')
<script>
$(document).ready(function () {
    $('#createDepartmentForm').on('submit', function (e) {
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
            success: function (response) {
                toastr.success(response.message);

                $('#createDepartmentForm')[0].reset();
                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('departmentModal'));
                    modal.hide();

            },
            error: function (xhr) {
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
</script>