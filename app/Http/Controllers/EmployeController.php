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
                    $checked = $row->status === 'active' ? 'checked' : '';
                    return "<label class='switch'>
        <input type='checkbox' class='toggle-status update-employee-status' data-id='{$row->id}' {$checked}>
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
                    $id = $row->id;
                    return "<button class='btn btn-primary border-0 edit-btn' data-id='{$id}'>
                            <i class='fa-regular fa-pen-to-square'></i>
                        </button>";
                    // return "<button class='btn btn-primary border-0 edit-btn' data-bs-toggle='modal' data-bs-target='#editEmployeeModal{$id}' data-id='{$id}'>
                    //         <i class='fa-regular fa-pen-to-square'></i>
                    //     </button>";

                })

                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }
    }

    public function departments()
    {
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
        if ($request->hasFile('image')) {
            $image         = $request->file('image');
            $imageName     = time() . '_' . $image->getClientOriginalName();
            $path          = $image->store('employees', 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = null;
        }

        Employee::create([
            'employee_name' => $validated['employee_name'],
            'email'         => $validated['email'],
            'department_id' => $validated['department'],
            'status'        => $validated['status'],
            'image'         => $data['image'],
        ]);

        return response()->json([
            'message' => 'Employee created successfully',
        ]);
    }
    public function updateStatus(Request $request)
    {
        $employee         = Employee::findOrFail($request->id);
        $employee->status = $request->status;
        $employee->save();
        return response()->json([
            'message' => 'Status updated to ' . $request->status]);
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
public function edit($id)
{
    $employee = Employee::find($id);
    $departments = Department::all(); // Or your own filter logic

    if (!$employee) {
        return response()->json(['success' => false]);
    }

    return response()->json([
        'success' => true,
        'data' => $employee,
        'departments' => $departments,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'employee_name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,'.$id,
        'department' => 'required',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $employee = Employee::findOrFail($id);
    $employee->employee_name = $request->employee_name;
    $employee->email = $request->email;
    $employee->department_id = $request->department;
    $employee->status = $request->status;

    if ($request->hasFile('image')) {
        $filename = time().'_'.$request->image->getClientOriginalName();
        $path = $request->image->storeAs('profiles', $filename, 'public');
        $employee->image = $path;
    }

    $employee->save();

    return response()->json(['success' => true]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
