<div class="modal fade" id="editPayslipModal" aria-labelledby="payslipModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editPayslipForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="payslipModalLabel">Edit Payslip</h5>
          <button type="button" class="btn-close" id="payslipCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <!-- Employee -->
          <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="edit_employee_id" class="form-select" name="employee_id">
              <option value="">Select Employee</option>
            </select>
            <div class="invalid-feedback" id="edit_employee_idError"></div>
          </div>



          <!-- Basic Salary -->
          <div class="mb-3">
            <label for="basic_salary" class="form-label">Basic Salary</label>
            <input type="number" class="form-control" id="edit_basic_salary" name="basic_salary" step="0.01" min="0" >
            <div class="invalid-feedback" id="edit_basic_salaryError"></div>
          </div>

          <!-- Payroll -->
          <div class="mb-3">
            <label for="payroll_id" class="form-label">Payroll (optional)</label>
            <select name="payroll_id" id="edit_payroll_id" class="form-select" name="payroll_id">
              <option value="">Select Payroll</option>
            </select>
            <div class="invalid-feedback" id="edit_payroll_idError"></div>
          </div>

          

          <!-- Overtime -->
          <div class="mb-3">
            <label for="overtime" class="form-label">Overtime</label>
            <input type="number" class="form-control" id="edit_overtime" name="overtime" step="0.01" min="0" >
            <div class="invalid-feedback" id="edit_overtimeError"></div>
          </div>

          <!-- Bonus Name -->
          <div class="mb-3">
            <label for="bonus_name" class="form-label">Bonus Name</label>
            <select  id="edit_bonus_name" name="bonus_id" class="form-select">
              <option value="">Select Bonus</option>
            </select>
            <div class="invalid-feedback" id="edit_bonus_nameError"></div>
          </div>

          <!-- Bonus Amount -->
          <div class="mb-3">
            <label for="bonus" class="form-label">Bonus Amount</label>
            <input type="number" class="form-control" id="edit_bonus" name="bonus_amount" step="0.01" min="0">
            <div class="invalid-feedback" id="edit_bonusError"></div>
          </div>

          <!-- Deduction -->
          <div class="mb-3">
            <label for="deduction" class="form-label">Deduction</label>
            <input type="number" class="form-control" id="edit_deduction" name="deduction" step="0.01" min="0">
            <div class="invalid-feedback" id="edit_deductionError"></div>
          </div>

          <!-- Gross Salary -->
          <div class="mb-3">
            <label for="gross_salary" class="form-label">Gross Salary</label>
            <input type="number" class="form-control" id="edit_gross_salary" name="gross_salary" step="0.01" min="0" readonly>
            <div class="invalid-feedback" id="edit_gross_salaryError"></div>
          </div>

          <!-- Net Salary -->
          <div class="mb-3">
            <label for="net_salary" class="form-label">Net Salary</label>
            <input type="number" class="form-control" id="edit_net_salary" name="net_salary" step="0.01" min="0" readonly>
            <div class="invalid-feedback" id="edit_net_salaryError"></div>
          </div>

          <input type="hidden" name="tax" />

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="saveBtn">Save Payslip</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="payslipCancelBtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

