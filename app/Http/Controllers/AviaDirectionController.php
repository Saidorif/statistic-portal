<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AviaDirection;
use Validator;

class AviaDirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = AviaDirection::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result = AviaDirection::get();
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
        $validator = Validator::make($request->all(), [            
            'name' => 'required|string|max:255|unique:avia_directions',
            'direction_type'  => 'required|string',
            'avia_type'  => 'required|string',
            'flight_qty'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only(['name','direction_type','avia_type','flight_qty']);
        $result = AviaDirection::create($inputs);

        return response()->json(['success' => true, 'message' => 'AviaDirection успешно создан']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AviaDirection  $aviadirection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = AviaDirection::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'AviaDirection не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AviaDirection  $aviadirection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $result = AviaDirection::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'AviaDirection не найден']);
        }
        $validator = Validator::make($request->all(), [     
            'name' => 'required|string|unique:avia_directions,name,'.$result->id,       
            'direction_type'  => 'required|string',
            'avia_type'  => 'required|string',
            'flight_qty'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only(['name','direction_type','avia_type','flight_qty']);
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'AviaDirection успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AviaDirection  $aviadirection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $result = AviaDirection::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'AviaDirection не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'AviaDirection удален']);
    }
}

