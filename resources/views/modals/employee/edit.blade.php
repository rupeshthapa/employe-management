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

    <!-- Department -->
    <div class="mb-3">
        <select class="form-select" id="edit_departmentDropdown" name="department">
            <option value="">Select Department</option>
        </select>
        <div class="invalid-feedback" id="editDepartmentError"></div>
    </div>

    <!-- Designation -->
    <div class="mb-3">
        <select class="form-select" id="edit_designationDropdown" name="designation">
            <option value="">Select Designation</option>
        </select>
        <div class="invalid-feedback" id="editDesignationError"></div>
    </div>

    <!-- Phone -->
    <div class="mb-3">
        <label for="edit_employee_phone" class="form-label">Phone</label>
        <input type="number" class="form-control" id="edit_employee_phone" name="phone">
        <div class="invalid-feedback" id="editPhoneError"></div>
    </div>

    <!-- Address -->
    <div class="mb-3">
        <label for="edit_employee_address" class="form-label">Address</label>
        <input type="text" class="form-control" id="edit_employee_address" name="address">
        <div class="invalid-feedback" id="editAddressError"></div>
    </div>

    <!-- Gender -->
    <div class="mb-3">
        <label class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input border-black" type="radio" name="gender" id="edit_male" value="male">
            <label class="form-check-label" for="edit_male">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input border-black" type="radio" name="gender" id="edit_female" value="female">
            <label class="form-check-label" for="edit_female">Female</label>
        </div>
        <div class="invalid-feedback d-block" id="editGenderError"></div>
    </div>

    <!-- Status -->
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

    <!-- Joined Date -->
    <div class="mb-3">
        <label for="edit_date" class="form-label">Joined Date</label>
        <input type="date" class="form-control" id="edit_date" name="joined_date">
        <div class="invalid-feedback" id="editDateError"></div>
    </div>

    <!-- Joined Address -->
    <div class="mb-3">
        <label for="edit_salary" class="form-label">Basic Salary</label>
        <input type="number" class="form-control" id="edit_employee_salary" name="basic_salary">
        <div class="invalid-feedback" id="editSalaryError"></div>
    </div>

    <!-- Current Profile Image -->
    <div class="mb-3">
        <label class="form-label">Current Profile</label><br>
        <img id="editImagePreview" src="" class="img-thumbnail mb-2" style="max-height: 120px; display: none;">
    </div>

    <!-- Upload Profile -->
    <div class="mb-3">
        <label for="edit_profile" class="form-label">Upload Profile</label>
        <input type="file" class="form-control" id="edit_profile" name="image">
        <div class="invalid-feedback" id="editProfileError"></div>
    </div>

</div> <!-- End of .modal-body -->
 <!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Employee</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
