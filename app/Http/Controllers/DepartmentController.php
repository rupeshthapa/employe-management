<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\Department;
use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;
use App\Http\Requests\DepartmentRequest;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(DepartmentRequest $request)
    public function index()
    {
        return view('department.index');
    }
    public function indexData(Request $request)
    {
        
        
                if($request->ajax()){
                    $departments = Department::all();
                    return DataTables::of($departments)
                    ->addIndexColumn()
                    ->addColumn("actions",function($department){
                        $id = $department->id;
                        return "<button class='btn btn-primary border-0' data-bs-toggle='modal' data-bs-target='#departmentEditModal' data-id='$id'><i class='fa-regular fa-pen-to-square'></i></button>";   
                        
                        // <form class='d-inline'>
                        
                        //         <button class='badge bg-danger border-0'>Delete</button>
                        //     </form>
                        // ";
                       
                        
                    })
                    ->rawColumns(["actions"])
                    ->make(true);
                }
        

        }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();

        $department = Department::create([
            'name' => $validated['name']
        ]);

       
        return response()->json([ 
        'message' => 'Department created successfully!', 
        'department' => $department ]);
    
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
