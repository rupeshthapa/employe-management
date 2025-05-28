<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editEmployeeForm" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="editCloseBtn"></button>
                </div>

                <div class="modal-body">

                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label for="edit_employee_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="edit_employee_name" name="employee_name">
                        <div class="invalid-feedback" id="editEmployeeNameError"></div>
                    </div>

                    <!-- Employee Email -->
                    <div class="mb-3">
                        <label for="edit_employee_email" class="form-label">Employee Email</label>
                        <input type="email" class="form-control" id="edit_employee_email" name="email">
                        <div class="invalid-feedback" id="editEmailError"></div>
                    </div>

                    <!-- Department with modal button -->
                    <div class="mb-3">
                        

                        <select class="form-select" id="edit_departmentDropdown" name="department">
                            <option value="">Select Department</option>
                            <!-- Departments will be populated dynamically -->
                        </select>
                        <div class="invalid-feedback" id="editDepartmentError"></div>
                    </div>

                    <!-- Status Radio -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input border-black" type="radio" name="status" id="edit_statusActive" value="active">
                            <label class="form-check-label" for="edit_statusActive">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border-black" type="radio" name="status" id="edit_statusInactive" value="inactive">
                            <label class="form-check-label" for="edit_statusInactive">Inactive</label>
                        </div>
                        <div class="invalid-feedback d-block" id="editStatusError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Profile</label><br>
                        <img id="editImagePreview" src="" class="img-thumbnail mb-2" style="max-height: 120px; display: none;">
                    </div>

                    <div class="mb-3">
                        <label for="edit_profile" class="form-label">Upload Profile</label>
                        <input type="file" class="form-control" id="edit_profile" name="image">
                        <div class="invalid-feedback" id="editProfileError"></div>
                    </div>
                </div> <!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Employee</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
