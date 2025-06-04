<div class="modal fade" id="bonusModal" aria-labelledby="bonusModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createBonusForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="bonusModalLabel">Add New Bonus</h5>
          <button type="button" class="btn-close" id="bonusCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="bonusNameDiv">
            <label for="name" class="form-label">Bonus Name</label>
            <input type="text" class="form-control" id="bonus_name" name="name">
            <div class="invalid-feedback" id="bonusNameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Bonus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="bonusCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
