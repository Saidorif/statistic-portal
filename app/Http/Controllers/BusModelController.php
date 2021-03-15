<?php

namespace App\Http\Controllers;

use App\BusModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class BusModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = BusModel::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result = BusModel::get();
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result = BusModel::create($inputs);

        return response()->json(['success' => true, 'message' => 'BusModel успешно создан']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusModel  $busModel
     * @return \Illuminate\Http\Response
     */
    public function show(BusModel $busModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusModel  $busModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = BusModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'BusModel не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusModel  $busModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $result = BusModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'BusModel не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'BusModel успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusModel  $busModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $result = BusModel::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'BusModel не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'BusModel удален']);
    }
}
