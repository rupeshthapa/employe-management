<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollsRequest;
use App\Models\Payroll;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PayrollsController extends Controller
{
    public function index(){
        return view('payrolls.index');
    }

    public function store(PayrollsRequest $request){
        $validated = $request->validated();

        Payroll::create([
            'salary_month' => $validated['salary_month'],
            'status' => $validated['status'] ?? 'draft',
        ]);

        return response()->json([
            'message'=> 'Payroll created successfully!',
            'data' => $validated
        ]);
    }

    public function indexData(Request $request){
        if($request->ajax()){
            $payrolls = Payroll::all();
            return DataTables::of($payrolls)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                    // Adjust permission name as needed
                    $checked = $row->status === 'processed' ? 'checked' : '';
                    return "<label class='switch'>
                    <input type='checkbox' class='toggle-status update-payroll-status' data-id='{$row->id}' {$checked}>
                    <span class='slider round'></span>
                </label>";
                })
            ->addColumn('actions', function($row){
                $id = $row->id;
                return "
                    <button class='btn btn-primary border-0 edit-payroll' data-bs-toggle='modal' data-bs-target='#editPayrollModal' data-id='{$id}'>
                        <i class='fa-regular fa-pen-to-square'></i>
                    </button>
                    <button class='btn btn-danger border-0 delete-payroll'>
                        <i class='fa fa-trash'></i>
                    </button>
                ";
            })
            ->rawColumns(['status','actions'])
            ->make(true);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $payroll = Payroll::findOrFail($request->id);
            $payroll->status = $request->status;
            $payroll->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Payroll status updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update payroll status.'
            ], 500);
        }
    }

    public function edit(string $id){
        $payroll = Payroll::findOrFail($id);
        return response()->json($payroll);
    }

    public function update(Request $request, string $id){
        $validated = $request->validate([
            'salary_month' => 'required|string',
            'status' => 'required|in:draft,processed',
        ]);
        
        $payroll = Payroll::findOrFail($id);

        $payroll->salary_month = $validated['salary_month'];
        $payroll->status = $validated['status'];

        $payroll->save();
        
        
        return response()->json([
            'message' => 'Payroll updated successfully!'
        ]);

    }

    public function destroy(string $id){
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        return response()->json([
            'message' => 'Payroll deleted successfully!'
        ]);
    }
}
