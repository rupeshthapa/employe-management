<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employe.index');
    }



public function indexData(Request $request)
{
    if ($request->ajax()) {
        $employees = Employee::with('department')->select('employees.*');
        
        return DataTables::of($employees)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                // Adjust permission name as needed
                $canUpdate = auth()->user()->can('update_employee_status');
                $updateClass = $canUpdate ? 'update-employee-status' : '';
                $disabled = $canUpdate ? '' : 'disabled';
                $checked = ($row->status == 'active') ? 'checked' : '';
                $id = $row->id;

                return "<label class='switch'>
                            <input type='checkbox' data-id='{$id}' class='form-input-check {$updateClass}' {$checked} {$disabled}/>
                            <span class='slider round'></span>
                        </label>";
            })
            ->addColumn('image', function ($row) {
                if ($row->image) {
                    $url = asset('storage/' . $row->image);
                    return '<img src="' . $url . '" width="50" height="50" class="rounded-circle">';
                }
                return 'No Image';
            })

            // Department Name
            ->editColumn('department.name', function ($row) {
                return $row->department ? $row->department->name : 'N/A';
            })

            // Actions (Edit + Delete buttons)
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-primary border-0 edit-btn" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#departmentEditModal">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button class="btn bg-danger border-0 delete-btn" data-id="' . $row->id . '">
                        <i class="fa-solid fa-trash"></i>
                    </button>';
            })

            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }
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
