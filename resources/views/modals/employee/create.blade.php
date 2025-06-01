<div class="modal fade" id="employeModal" role="dialog" aria-labelledby="employeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="employeForm" enctype="multipart/form-data" method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="employeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" id="employeeCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label for="employe_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employe_name" name="employee_name">
                        <div class="invalid-feedback" id="employeNameError"></div>
                    </div>

                    <!-- Employee Email -->
                    <div class="mb-3">
                        <label for="employe_email" class="form-label">Employee Email</label>
                        <input type="email" class="form-control" id="employe_email" name="email">
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>

                    <!-- Department with modal button -->
                    <div class="mb-3">
                        <label for="departmentDropdown" class="form-label d-flex align-items-center justify-content-between">
                            <span>Department</span>
                            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center departmentModal">
                                <i class="fa-solid fa-circle-plus me-2"></i>Add
                            </button>
                        </label>

                        <!-- Department Dropdown -->
                        <select class="form-select" id="departmentDropdown" name="department">
                            <option value="">Select Department</option>
                            
                        </select>
                        <div class="invalid-feedback" id="departmentError"></div>
                    </div>

                        {{-- Designation with modal button --}}
                        <div class="mb-3">
                            <label for="designationDropdown" class="form-label d-flex align-items-center justify-content-between">
                                <span>Designation</span>
                                <button type="button" class="btn btn-sm btn-primary d-flex align-items-center designationModal">
                                    <i class="fa-solid fa-circle-plus me-2"></i>Add
                                </button>
                            </label>

                            <!-- Designation Dropdown -->
                            <select class="form-select" id="designationDropdown" name="designation">
                                <option value="">Select Designation</option>
                                
                            </select>
                            <div class="invalid-feedback" id="designationError"></div>
                        </div>

                        <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone">
                        <div class="invalid-feedback" id="phoneError"></div>
                    </div>
                        <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                        <div class="invalid-feedback" id="addressError"></div>
                    </div>

                   

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>

                        <div class="invalid-feedback d-block" id="genderError"></div>
                    </div>
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




                    <div class="mb-3">
                        <label for="joined_date" class="form-label">Joined Date</label>
                        <input type="date" class="form-control" id="date" name="joined_date">
                        <div class="invalid-feedback" id="dateError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">Basic Salary</label>
                        <input type="number" class="form-control" id="salary" name="basic_salary">
                        <div class="invalid-feedback" id="salaryError"></div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="employeeCancelBtn">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

@push("modals")
@include('modals.department.create');
@include('modals.designation.create');
@endpush