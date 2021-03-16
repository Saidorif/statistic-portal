<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RegionPlanModel;
use App\Expectation;
use Validator;
use Carbon\Carbon;

class RegionPlanController extends Controller
{
    public function index(Request $request)
    {
        $result = RegionPlanModel::with(['region','exception','exceptionFakt'])->paginate(15);
        $result->getCollection()->transform(function($item){
            $fakts = $item->exceptionFakt;
            $exceptions = $item->exception;
            $newexceptions = [];
            $all_bus_qty = 0;
            // sum of bus_qty
            foreach ($exceptions as $key => $expect){
                $newexceptions[$key] = $this->busQty($expect->busexpect); 
            }
            foreach ($newexceptions as $key => $value) {
                // sum of all_bus_qty
                $all_bus_qty += $value;
            }
            $item['accepted_fakt_count'] = 0;
            $item['rejected_fakt_count'] = 0;
            $item['waiting_fakt_count'] = 0;
            $item['newexceptions'] = $newexceptions;
            $item['all_bus_qty'] = $all_bus_qty;
            foreach($fakts as $key => $value){
                $item['accepted_fakt_count'] += (int)$value['accepted_fakt_count'];
                $item['rejected_fakt_count'] += (int)$value['rejected_fakt_count'];
                $item['waiting_fakt_count'] += (int)$value['waiting_fakt_count'];
            }
            return (
                $item
            );
        });

        return response()->json(['success' => true, 'result' => $result]);
    }

    public function busQty($items){
        $count = 0;
        if(count($items) > 0){
            foreach ($items as $key => $item) {
                $count += (int)$item->bus_qty;
            }
        }
        return $count;
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
        $result = RegionPlanModel::with('region')->find($id);
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
        $expectations = Expectation::where('plan_id',$id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'План региона не найден']);
        }
        $result->delete();
        $expectations->delete();

        return response()->json(['success' => true, 'message' => 'План региона удален']);
    }
}
