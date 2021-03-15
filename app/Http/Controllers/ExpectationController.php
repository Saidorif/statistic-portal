<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Expectation;
use App\RegionPlanModel;
use App\BusExpect;
class ExpectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Expectation::where('plan_id',$request->plan_id)->with(['plan','busexpect','acceptedFakt','waiting_fakt','rejected_fakt'])->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[            
            'company_name' => 'required|string',
            'inn' => 'required|integer|unique:expectations',
            'date' => 'required|date',
            'plan_id'  => 'required',

            'buses' => 'required|array',
            'buses.*.bus_id' => 'required',
            'buses.*.bus_qty' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $expectation = new Expectation();
        $expectation->company_name = $request->company_name;
        $expectation->inn = $request->inn;
        $expectation->date = $request->date;
        $expectation->plan_id = $request->plan_id;
        $expectation->save();

        $buses = $request->buses;

        if(count($buses) > 0){
            foreach ($buses as $key => $value){
                $bus = new BusExpect();
                $bus->expect_id = $expectation->id;
                $bus->bus_id = $value['bus_id'];
                $bus->bus_qty = $value['bus_qty'];
                $bus->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'Expectation успешно создан']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Expectation::findOrFail($id);
        $busexpect = BusExpect::where('expect_id',$id)->get();
        $result['busexpect'] = $busexpect;
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Expectation не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Expectation::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Expectation не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'company_name' => 'required|string',
            'inn'  => 'required|integer|unique:expectations,inn,'.$result->id,
            'date' => 'required|date',
            'plan_id'  => 'required',

            'buses' => 'nullable|array',
            'buses.*.bus_id' => 'required',
            'buses.*.bus_qty' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $result->company_name = $request->company_name;
        $result->inn = $request->inn;
        $result->date = $request->date;
        $result->plan_id = $request->plan_id;
        $result->save();

        $oldbuses = $request->oldbuses;
        $buses = $request->buses;

        // old Buses
        if(count($oldbuses) > 0){
            foreach ($oldbuses as $key => $value){
                $bus = BusExpect::where(['id'=>$value['id'],'expect_id'=>$result->id])->first();
                $bus->bus_id = $value['bus_id'];
                $bus->bus_qty = $value['bus_qty'];
                $bus->save();
            }
        }
        // New buses
        if(count($buses) > 0){
            foreach ($buses as $key => $value){
                $newbus = new BusExpect();
                $newbus->expect_id = $result->id;
                $newbus->bus_id = $value['bus_id'];
                $newbus->bus_qty = $value['bus_qty'];
                $newbus->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'Expectation успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll($id)
    {
        $result = Expectation::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Expectation не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Expectation удален']);
    }

    public function destroy($id)
    {
        $result = BusExpect::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'BusExpect не найден']);
        }
        $result->delete();
        return response()->json(['success' => true, 'message' => 'BusExpect удален']);
    }
}
