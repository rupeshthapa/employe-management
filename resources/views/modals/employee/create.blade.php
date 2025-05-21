<div class="modal fade" id="employeModal" role="dialog" aria-labelledby="employeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="employeForm" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="employeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label for="employe_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employe_name" name="name">
                        <div class="invalid-feedback" id="nameError"></div>
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
                            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#departmentModal">
                                <i class="fa-solid fa-circle-plus me-2"></i>Add
                            </button>
                        </label>

                        <!-- Department Dropdown -->
                        <select class="form-select" id="departmentDropdown" name="department">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="departmentError"></div>
                    </div>

                    <!-- Include department modal (Add New Department) -->
                    {{-- @include('modals.department.create') --}}

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
                        <input type="file" class="form-control" id="profile" name="profile">
                        <div class="invalid-feedback" id="profileError"></div>
                    </div>

                </div> <!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Employee</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
@push("modals")
    @include('modals.department.create');
@endpush
