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
            'amount' => $validated['amount'],
            
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
                    <button class='btn btn-danger border-0 delete-allowance' data-id='{$id}'>
                        <i class='fas fa-trash'></i>
                    </button>

                ";
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
    }


    public function edit(string $id){
        $allowance = Allowance::findOrFail($id);
        return response()->json($allowance);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        $allowance = Allowance::findOrFail($id);
        $allowance->name = $request->name;
        $allowance->amount = $request->amount;

        $allowance->save();

        return response()->json([
            'message' => 'Allowance updated successfully!',
        ]);

    } 

    public function destroy(Allowance $allowance){
       
        $allowance->delete();
        return response()->json([
        'message' => 'Allowance deleted successfully!'
        ]);
    }
}
