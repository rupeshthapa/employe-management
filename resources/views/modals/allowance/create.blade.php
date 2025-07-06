<div class="modal fade" id="allowanceModal" aria-labelledby="allowanceModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createAllowanceForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="allowanceModalLabel">Add New Allowance</h5>
          <button type="button" class="btn-close" id="allowanceCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="allowanceNameDiv">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="allowance_name" name="name">
            <div class="invalid-feedback" id="allowanceNameError">
            </div>
          </div>
          
          <div class="mb-3" id="allowanceAmountDiv">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount">
            <div class="invalid-feedback" id="amountError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Allowance</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="allowanceCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
