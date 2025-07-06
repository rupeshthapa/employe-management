<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaySlipRequest;
use App\Models\Bonus;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PaySlip;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PayslipController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $payrolls = Payroll::all();
        $bonuses = Bonus::all();
        return view('payslip.index', compact('employees', 'payrolls', 'bonuses'));
    }

   public function indexData(Request $request)
    {
        if ($request->ajax()) {
            $payslips = PaySlip::with(['employee', 'payroll', 'bonus'])->select('payslips.*');

            return DataTables::of($payslips)
                ->addIndexColumn()

                ->addColumn('employee_name', function ($row) {
                    return $row->employee?->employee_name ?? 'N/A';
                })

                ->addColumn('payroll_month', function ($row) {
                    return $row->payroll?->salary_month
                        ? \Carbon\Carbon::parse($row->payroll->salary_month)->format('F Y')
                        : 'N/A';
                })

                ->addColumn('bonus', function ($row) {
                    return $row->bonus?->name ?? 'N/A';
                })

                ->editColumn('gross_salary', function ($row) {
                    return 'Rs. ' . number_format($row->gross_salary, 2);
                })

                ->editColumn('net_salary', function ($row) {
                    return 'Rs. ' . number_format($row->net_salary, 2);
                })

                ->editColumn('tax', function ($row) {
                    return number_format($row->tax, 2) . '%';
                })

                ->addColumn('actions', function ($row) {
                    $id = $row->id;
                    return "
                        <button class='btn btn-primary border-0 edit-btn' data-id='{$id}' data-bs-toggle='modal' data-bs-target='#editPayslipModal'>
                            <i class='fa-regular fa-pen-to-square'></i>
                        </button>
                        <button class='btn btn-danger border-0 delete-btn' data-id='{$id}'>
                            <i class='fas fa-trash'></i>
                        </button>";
                })

                ->rawColumns(['actions'])
                ->make(true);
        }
    }



    public function getEmployeeSalary($id) {
        $employee = Employee::findOrFail($id);
        if($employee){
            return response()->json([
              'basic_salary' =>  $employee->basic_salary
            ]);
        }
    }

    public function getBonusAmount($id){
        $bonus = Bonus::findOrFail($id);
            if($bonus){
                return response()->json([
                   'bonus_amount' => $bonus->amount
                ]);
            }
    }

    public function store(PaySlipRequest $request){
        $validated = $request->validated();
        $gross = $validated['gross_salary'];

          $tax = 0;
    if ($gross <= 500000) {
        $tax = $gross * 0.01;
    } else {
        $tax = $gross * 0.10;
    }
$net = $gross - $tax - ($validated['deduction'] ?? 0);
        PaySlip::create([
            'employee_id' => $validated['employee_id'],
            'payroll_id' => $validated['payroll_id'],
            'overtime' => $validated['overtime'],
            'bonus_id' => $validated['bonus_id'],
            'deduction' => $validated['deduction'],
            'gross_salary' => $gross,
            'net_salary' => $net,
            'tax' => $tax,
            
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Payslip created successfully!'
        ]);
    }


    public function edit(string $id){
        $payslip = PaySlip::findOrFail($id);
        $employee = Employee::all();
        $payroll = Payroll::all();
        $bonus = Bonus::all();
        return response()->json([
        'success' => true,
        'data' => $payslip,
        'employee' => $employee,
        'payroll' => $payroll,
        'bonus' => $bonus
        ]);

    }

    
}
