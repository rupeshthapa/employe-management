<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollsRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollsController extends Controller
{
    public function index(){
        return view('payrolls.index');
    }

    public function store(PayrollsRequest $request){
        $validated = $request->validated();

        Payroll::create([
            'salary_month' => $validated['salary_month'],
            'status' => $validated['status']
        ]);

        return response()->json([
            'message'=> 'Payroll created successfully!',

        ]);
    }
}
