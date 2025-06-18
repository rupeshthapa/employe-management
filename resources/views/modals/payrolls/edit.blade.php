<div class="modal fade" id="editPayrollModal" aria-labelledby="editPayrollModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editPayrollForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editPayrollModalLabel">Edit Payroll</h5>
          <button type="button" class="btn-close" id="edit_payrollCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Salary Month -->
          <div class="mb-3">
            <label for="edit_payroll_date" class="form-label">Salary Month</label>
            <input type="date" class="form-control" id="edit_payroll_date" name="salary_month">
            <div class="invalid-feedback" id="edit_payrollDateError"></div>
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label class="form-label">Status</label>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="edit_statusDraft" value="draft">
              <label class="form-check-label" for="edit_statusDraft">Draft</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="edit_statusProcessed" value="processed">
              <label class="form-check-label" for="edit_statusProcessed">Processed</label>
            </div>

            <div class="invalid-feedback d-block" id="edit_payrollStatusError"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Update Payroll</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="edit_payrollCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
