<div class="modal fade" id="desginationEditModal" aria-labelledby="designationEditModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editDesignationForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editDesignationModalLabel">Edit Designation</h5>
          <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Designation Name</label>
            <input type="text" class="form-control" id="designation_edit_name" name="name">
            <div class="invalid-feedback" id="edit_designationNameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Update Designation</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
