<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllowancesRequest;
use App\Models\Allowance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AllowancesController extends Controller
{
    public function index(){
        return view('allowances.index');
    }

    public function store(AllowancesRequest $request){
        $validated = $request->validated();

       $allowance = Allowance::Create([
            'name' => $validated['name'],
            
        ]);

        return response()->json([
            'message' => 'Allowance created successfully!',
            'allowance' => $allowance
        ]);
    }


    public function indexData(Request $request){
        if($request->ajax()){
            $allowances = Allowance::all();
            return DataTables::of($allowances)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                $id = $row->id;
                return "
                    <button class='btn btn-primary border-0 edit-allowance' data-bs-toggle='modal' data-bs-target='#allowanceEditModal' data-id='{$id}'>
                        <i class='fa-regular fa-pen-to-square'></i>
                    </button>

                ";
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
    }
}
