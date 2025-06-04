<div class="modal fade" id="payslipModal" aria-labelledby="payslipModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createPayslipForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="payslipModalLabel">Add New Payslip</h5>
          <button type="button" class="btn-close" id="payslipCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="payslipNameDiv">
            <label for="name" class="form-label">Payslip Name</label>
            <input type="text" class="form-control" id="payslip_name" name="name">
            <div class="invalid-feedback" id="nameError">
            </div>
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Payslip</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="payslipCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
