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
    const id = $(this).data('id');

    // Option 1: Make AJAX call to fetch department data
    $.ajax({
        url: `/departments/${id}/edit`, // You need to define this route
        type: 'GET',
        success: function (data) {
            $('#department_edit_name').val(data.name);
            $('#editDepartmentForm').data('id', id); // Store ID for later
        }
    });
});

</script>