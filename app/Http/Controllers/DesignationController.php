<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('designations.index');
    }



    public function indexData(Request $request){
        if($request->ajax()){
            $designations = Designation::all();
            
            return DataTables::of($designations)
            ->addIndexColumn()
            ->addColumn("actions", function($row){
                $id = $row->id;
                return "
                <button class='btn btn-primary border-0 edit-designation' data-bs-toggle='modal' data-bs-target='#desginationEditModal' data-id='{$id}'>
                            <i class='fa-regular fa-pen-to-square'></i>
                            </button>
                <button class='btn btn-danger border-0 delete-designation' data-id='{$id}'>
                            <i class='fa-solid fa-trash'></i>
                            </button>
                ";
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request)
    {
        $validated = $request->validated();

        $designation = Designation::create([
            'name' => $validated['name']
        ]);

        return response()->json([
            'message' => 'Designation created successfully',
            'data' => $designation
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
        $designation = Designation::findOrFail($id);
        return response()->json($designation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $designation = Designation::findorFail($id);
        $designation->name = $request->name;
        $designation->save();

        return response()->json(['message' => 'Designation updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();
        return response()->json(['message' => 'Designation deleted successfully.']);
    }
}
