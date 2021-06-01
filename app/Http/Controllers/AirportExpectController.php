<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirportExpect;
use App\PlaneType;
use App\AviaCity;
use App\AirportCode;
use App\AirportWay;
use App\AirportRecon;
use App\AirportName;
use Validator;

class AirportExpectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $result = AirportExpect::with(['airportinfo'])->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function list(Request $request)
    {
        $result = AirportExpect::all();
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = AirportExpect::find($id);
        
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'airport_id'  => 'required|integer',
            'expect_date'  => 'required|date',
            'type'  => 'required|string',
            'reys_qty'  => 'required|string',
            'seats_qty'  => 'required|string',
            'passengers_qty'  => 'required|string',
            'load_capacity'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only([
            'airport_id',
            'expect_date',
            'type',
            'reys_qty',
            'seats_qty',
            'passengers_qty',
            'load_capacity',
        ]);
        $result = AirportExpect::create($inputs);
        
        return response()->json(['success' => true, 'message' => 'Аэропорт успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = AirportExpect::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'airport_id'  => 'required|integer',
            'expect_date'  => 'required|date',
            'type'  => 'required|string',
            'reys_qty'  => 'required|string',
            'seats_qty'  => 'required|string',
            'passengers_qty'  => 'required|string',
            'load_capacity'  => 'required|string',
            'reys_qty_fakt'  => 'nullable|string',
            'seats_qty_fakt'  => 'nullable|string',
            'passengers_qty_fakt'  => 'nullable|string',
            'load_capacity_fakt'  => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only(['airport_id','expect_date','type','reys_qty','seats_qty','passengers_qty','load_capacity','reys_qty_fakt','seats_qty_fakt','passengers_qty_fakt','load_capacity_fakt']);
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Аэропорт успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = AirportExpect::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Аэропорт удален']);
    }

}