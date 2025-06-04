<div class="modal fade" id="allowanceEditModal" aria-labelledby="allowanceEditModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editAllowanceForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="allowanceEditModalLabel">Edit Allowance</h5>
          <button type="button" class="btn-close" id="allowanceEditCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="allowanceEditNameDiv">
            <label for="name" class="form-label">Allowance Name</label>
            <input type="text" class="form-control" id="allowance_edit_name" name="name">
            <div class="invalid-feedback" id="allowanceEditNameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="updateBtn">Update Allowance</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="allowanceEditCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
