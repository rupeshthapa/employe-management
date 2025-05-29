<div class="modal fade" id="desginationModal" aria-labelledby="designationModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createDesignationForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="designationModalLabel">Add New Designation</h5>
          <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Designation Name</label>
            <input type="text" class="form-control" id="designation_name" name="name">
            <div class="invalid-feedback" id="designationNameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Designation</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
