<div class="modal fade" id="editBonusModal" aria-labelledby="editBonusModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editBonusForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editBonusModalLabel">Edit Bonus</h5>
          <button type="button" class="btn-close" id="editBonusCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="editBonusNameDiv">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="editBonus_name" name="name">
            <div class="invalid-feedback" id="editBonusNameError">
            </div>
          </div>
         
          <div class="mb-3" id="editBonusAmountDiv">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="editAmount" name="amount">
            <div class="invalid-feedback" id="editAmountError">
            </div>
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Update Bonus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="editBonusCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
