<div class="modal fade" id="payrollModal" aria-labelledby="payrollModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="createPayrollForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="payrollModalLabel">Add New Payroll</h5>
          <button type="button" class="btn-close" id="payrollCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3" id="payrollNameDiv">
            <label for="date" class="form-label">Salary Month</label>
            <input type="date" class="form-control" id="payroll_date" name="salary_month">
            <div class="invalid-feedback" id="payrollDateError">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="statusDraft" value="draft">
                <label class="form-check-label" for="statusDraft">Draft</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="statusProcessed" value="processed">
                <label class="form-check-label" for="statusProcessed">Processed</label>
            </div>

            <div class="invalid-feedback d-block" id="payrollStatusError"></div>
        </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Payroll</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="payrollCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
