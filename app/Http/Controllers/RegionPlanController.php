<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RegionPlanModel;
use Validator;
use Carbon\Carbon;
class RegionPlanController extends Controller
{
    public function index()
    {
        $result = RegionPlanModel::with('region')->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }
    public function list()
    {
        $result = RegionPlanModel::with('region')->all();
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'date' => 'required',
            'number' => 'required|integer',
            'region_id'  => 'required|integer|unique:region_plan_models',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('date','number','region_id');
        $inputs['date'] = $inputs['date'].'-01-01';
        $result = RegionPlanModel::create($inputs);

        return response()->json(['success' => true, 'message' => 'План региона успешно создан']);
    }

    public function edit($id)
    {
        $result = RegionPlanModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'План региона не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function update(Request $request, $id)
    {
        $result = RegionPlanModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'План региона не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'date' => 'required',
            'number' => 'required|integer',
            'region_id'       => 'required|integer|unique:region_plan_models,region_id,'.$result->id,
            'region_id'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('date','number','region_id');
        $inputs['date'] = $inputs['date'].'-01-01';
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'План региона успешно обновлен']);
    }

    public function destroy($id)
    {
        $result = RegionPlanModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'План региона не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'План региона удален']);
    }
}
