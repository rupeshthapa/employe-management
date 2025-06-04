<?php

namespace App\Http\Controllers;

use App\Http\Requests\BonusesRequest;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BonusesController extends Controller
{
    public function index(){
        return view('bonuses.index');
    }

    public function store(BonusesRequest $request){
        $validated = $request->validated();

        Bonus::create([
            'name' => $validated['name']
        ]);

        return response()->json([
            'message' => 'Bonus created successfully!'
        ]);
    }

    public function indexData(Request $request){
        if($request->ajax()){
            $bonuses = Bonus::all();
            return DataTables::of($bonuses)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                $id = $row->id;
                return "<button class='btn btn-primary border-0 edit-bonus' data-bs-toggle='modal' data-bs-target='#editBonusModal' data-id='{$id}'>
                        <i class='fa-regular fa-pen-to-square'></i>
                    </button>";
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
    }


    public function edit(string $id){
        $bonus = Bonus::findOrFail($id);
        return response()->json($bonus);
    }
}
