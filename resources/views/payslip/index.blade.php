@extends('layouts.app')
@section('title', 'Payslip')
@section('content')
    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#payslipModal">
            <i class="fa-solid fa-circle-plus me-2"></i>New Payslip
        </button>

        <table id="payslipTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Payroll Month</th>
                    <th>Overtime</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Gross Salary</th>
                    <th>Net Salary</th>
                    <th>Tax</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection
@push('modals')
    @include('modals.payslips.create', ['employees' => $employees, 'payrolls' => $payrolls, 'bonuses' => $bonuses])

    @include('modals.payslips.edit')
@endpush


@push('scripts')
    <script>
        $(document).ready(function(){

            $('#payslipTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nav.payslip.index.data') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'employee_name', name: 'employee_name' },
                    { data: 'payroll_month', name: 'payroll_month' },
                    { data: 'overtime', name: 'overtime' },
                    { data: 'bonus', name: 'bonus' },
                    { data: 'deduction', name: 'deduction' },
                    { data: 'gross_salary', name: 'gross_salary' },
                    { data: 'net_salary', name: 'net_salary' },
                    { data: 'tax', name: 'tax' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        


    // Recalculate on any relevant field change/input
    $('#basic_salary, #overtime, #bonus, #deduction').on('input', calculateSalaries);

    // Also call this after salary or bonus are filled via AJAX
    function calculateSalaries() {
      const basicSalary = parseFloat($('#basic_salary').val()) || 0;
      const overtime = parseFloat($('#overtime').val()) || 0;
      const bonus = parseFloat($('#bonus').val()) || 0;
      const deduction = parseFloat($('#deduction').val()) || 0;

      const gross = basicSalary + overtime + bonus;
      const net = gross - deduction;

      $('#gross_salary').val(gross.toFixed(2));
      $('#net_salary').val(net.toFixed(2));
    }

    // Trigger after AJAX salary fill
    $(document).on('change', '#employee_id', function () {
      const employee_id = $(this).val();
      if (employee_id) {
        $.ajax({
          url: "{{ route('nav.payslip.getEmployeeSalary', ':id') }}".replace(':id', employee_id),
          type: 'GET',
          success: function (data) {
            $('#basic_salary').val(data.basic_salary);
            calculateSalaries(); // recalculate when salary is loaded
          }
        });
      }
    });

    // Trigger after AJAX bonus fill
    $(document).on('change', '#bonus_name', function () {
      const bonus_id = $(this).val();
      if (bonus_id) {
        $.ajax({
          url: "{{ route('nav.payslip.getBonusAmount', ':id') }}".replace(':id', bonus_id),
          type: 'GET',
          success: function (data) {
            $('#bonus').val(data.bonus_amount);
            calculateSalaries(); // recalculate when bonus is loaded
          }
        });
      } else {
        $('#bonus').val(0);
        calculateSalaries();
      }
    });






            $('#createPayslipForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('#employee_idError, #basic_salaryError, #payroll_idError, #overtimeError, #bonus_nameError, #bonusError, #deductionError, #gross_salaryError, #net_salaryError')
                    .text('').hide();

                $('#employee_id, #basic_salary, #payroll_id, #overtime, #bonus_name, #bonus, #deduction, #gross_salary, #net_salary')
                    .removeClass('is-invalid');

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('nav.payslip.store') }}", 
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log(response.data);
                        toastr.success(response.message);
                        $('#createPayslipForm')[0].reset();

                        const modalEl = document.getElementById('payslipModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if(modal){
                            modal.hide();
                        }

                        setTimeout(() => {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('body').css('padding-right', '');
                        }, 300);
                        
                        $('#payslipTable').DataTable().ajax.reload();
                  },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            if (errors.employee_id) {
                                $('#employee_idError').text(errors.employee_id[0]).show();
                                $('#employee_id').addClass('is-invalid');
                            }
                            if (errors.basic_salary) {
                                $('#basic_salaryError').text(errors.basic_salary[0]).show();
                                $('#basic_salary').addClass('is-invalid');
                            }
                            if (errors.payroll_id) {
                                $('#payroll_idError').text(errors.payroll_id[0]).show();
                                $('#payroll_id').addClass('is-invalid');
                            }
                            if (errors.overtime) {
                                $('#overtimeError').text(errors.overtime[0]).show();
                                $('#overtime').addClass('is-invalid');
                            }
                            if (errors.bonus_id) {
                                $('#bonus_nameError').text(errors.bonus_id[0]).show();
                                $('#bonus_name').addClass('is-invalid');
                            }
                            if (errors.bonus_amount) {
                                $('#bonusError').text(errors.bonus_amount[0]).show();
                                $('#bonus').addClass('is-invalid');
                            }
                            if (errors.deduction) {
                                $('#deductionError').text(errors.deduction[0]).show();
                                $('#deduction').addClass('is-invalid');
                            }
                            if (errors.gross_salary) {
                                $('#gross_salaryError').text(errors.gross_salary[0]).show();
                                $('#gross_salary').addClass('is-invalid');
                            }
                            if (errors.net_salary) {
                                $('#net_salaryError').text(errors.net_salary[0]).show();
                                $('#net_salary').addClass('is-invalid');
                            }

                        } else {
                            toastr.error('Something went wrong');
                        }
                    }
                });
            });


            $(document).on('click', '.edit-btn', function () {
    let id = $(this).data('id');

    $.ajax({
        url: "{{ route('nav.payslip.edit', ':id') }}".replace(':id', id),
        type: "GET",
        success: function (response) {
            if (response.success) {
                const payslip = response.data;
                const employees = response.employee;
                const bonuses = response.bonus;

                // ✅ Populate employee dropdown
                let empOptions = '<option value="">Select Employee</option>';
                employees.forEach(emp => {
                    const selected = emp.id == payslip.employee_id ? 'selected' : '';
                    empOptions += `<option value="${emp.id}" ${selected}>${emp.employee_name}</option>`;
                });
                $('#edit_employee_id').html(empOptions);

                // ✅ Set basic salary of selected employee
                const selectedEmp = employees.find(emp => emp.id == payslip.employee_id);
                $('#edit_basic_salary').val(selectedEmp ? selectedEmp.basic_salary : 0);

                

                let payroll = '<option value="">Select Payroll</option>';
                response.payroll.forEach(pay => {
                    const selected = pay.id == payslip.payroll_id ? 'selected' : '';
                    payroll += `<option value="${pay.id}" ${selected}>${pay.salary_month}</option>`;
                });
                $('#edit_payroll_id').html(payroll);

                // ✅ Populate bonus dropdown



               // Populate bonus select options in the correct select box
let bonusOptions = '<option value="">Select Bonus</option>';
bonuses.forEach(b => {
    const selected = b.id == payslip.bonus_id ? 'selected' : '';
    bonusOptions += `<option value="${b.id}" ${selected}>${b.name}</option>`;
});
$('#edit_bonus_name').html(bonusOptions);

// Set bonus amount in the bonus amount input field
const selectedBonus = bonuses.find(b => b.id == payslip.bonus_id);
$('#edit_bonus').val(selectedBonus ? selectedBonus.amount : 0);


                // ✅ Set other form fields
                $('#edit_overtime').val(payslip.overtime);
                $('#edit_deduction').val(payslip.deduction);
                $('#edit_gross_salary').val(payslip.gross_salary);
                $('#edit_net_salary').val(payslip.net_salary);
                $('#edit_tax').val(payslip.tax);

                // ✅ Show the modal
                $('#editPayslipModal').modal('show');
            } else {
                toastr.error('Failed to load payslip');
            }
        },
        error: function () {
            toastr.error('Something went wrong while loading the payslip.');
        }
    });
});



        });
    </script>
@endpush
