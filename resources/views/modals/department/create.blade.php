<div class="modal fade" id="departmentModal" aria-labelledby="departmentModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createDepartmentForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="departmentModalLabel">Add New Department</h5>
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
@push("scripts")
  <script>
    // Step 1: Open Department Modal from inside Employee Modal
    $(document).on("click", "#cancelBtn", function (e) {
        e.preventDefault();

        // Wait until employeModal is hidden, then show departmentModal
        $("#employeModal").one("hidden.bs.modal", function () {
            $("#employeModal").modal("show");
        });

        $("#departmentModal").modal("hide");
    });

</script>
@endpush