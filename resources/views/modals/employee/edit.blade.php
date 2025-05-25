<div class="modal fade" id="editEmployeeModal" tabindex="-1 role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editEmployeEForm" enctype="multipart/form-data" method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label for="employe_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="edit_employee_nameId" name="edit_employee_name">
                        <div class="invalid-feedback" id="edit_employeNameError"></div>
                    </div>

                    <!-- Employee Email -->
                    <div class="mb-3">
                        <label for="employe_email" class="form-label">Employee Email</label>
                        <input type="email" class="form-control" id="edit_employee_emailId" name="edit_employee_email">
                        <div class="invalid-feedback" id="edit_emailError"></div>
                    </div>

                        {{-- <!-- Department Dropdown -->
                        <div class="mb-3">
                            <select class="form-select" id="editDepartmentDropdown" name="edit_department">
                                <option value="">Select Department</option>
                                
                            </select>
                            <div class="invalid-feedback" id="edit_departmentError"></div>
                        </div> --}}


                   

                    <!-- Status Radio -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusActive" value="active">
                            <label class="form-check-label" for="statusActive">Active</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusInactive" value="inactive">
                            <label class="form-check-label" for="statusInactive">Inactive</label>
                        </div>

                        <div class="invalid-feedback d-block" id="statusError"></div>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3">
                        <label for="profile" class="form-label">Upload Profile</label>
                        <input type="file" class="form-control" id="profile" name="image">
                        <div class="invalid-feedback" id="profileError"></div>
                    </div>

                </div> <!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Employee</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="employeCancelBtn">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- @push("modals")
    @include('modals.department.create');
@endpush --}}