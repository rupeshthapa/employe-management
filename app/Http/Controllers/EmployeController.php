<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employe.index');
    }

   public function departments(){
      $departments = Department::select('id', 'name')->get();
    return response()->json($departments);
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modals.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(employeRequest $request)
    {
        $validated = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time(). '_' . $image->getClientOriginalName();
            $path = $image->store('employees', 'public');
            $data['image'] = $path;
        }else{
             $data['image'] = null;
        }

        Employee::create([
        'employee_name' => $validated['employee_name'],
        'email'         => $validated['email'],
        'department_id' => $validated['department'], 
        'status'        => $validated['status'],
        'image'         => $data['image']
        ]);

        return response()->json([
            'message' => 'Employee created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
