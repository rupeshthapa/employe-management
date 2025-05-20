@include('layouts.cdn.headerLink')
<div class="modal fade" id="departmentEditModal" tabindex="-1" aria-labelledby="departmentEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editDepartmentForm">
        @csrf
        <div class="modal-header" method="POST">
          <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">New Department Name</label>
            <input type="text" class="form-control" id="department_edit_name" name="name">
            <div class="invalid-feedback" id="editNameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update Department</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include('layouts.cdn.footerScript')
<script>
    $(document).on('click', '[data-bs-target="#departmentEditModal"]', function () {
    let id = $(this).data('id');

    // Option 1: Make AJAX call to fetch department data
    $.ajax({
        url: '{{ route('nav.department.edit', ":id") }}'.replace(":id", id), // You need to define this route
        type: 'GET',
        success: function (data) {
            $('#department_edit_name').val(data.name);
            $('#editDepartmentForm').data('data-id', id); // Store ID for later
        }
    });
});

</script>

<script>

   $('#editDepartmentForm').on('submit', function (e) {
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
        success: function (response) {
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
        error: function (xhr) {
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


</script>