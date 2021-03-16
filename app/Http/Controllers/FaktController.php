<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fakt;
use App\Expectation;
use Validator;
class FaktController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Fakt::where('expect_id',$request->expect_id)->with(['expectation','bus'])->paginate(12);
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
            'expect_id' => 'required|integer',
            'bus_id' => 'required|integer',
            'capacity'  => 'required|integer',
            'bank_credit'  => 'required|string',
            'auto_price_sum'  => 'required',
            'auto_price_dollar'  => 'required',
            'auto_price_euro'  => 'required',
            'bank_contract'  => 'required',
            'zavod_contract'  => 'required',
            'purchase_date'  => 'required|date',
            'registr_cerf'  => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $inputs = $request->all();
        $inputs['status'] = 'waiting';

        $fakt = Fakt::create($inputs);

        return response()->json(['success' => true, 'message' => 'Fakt успешно создан']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Fakt::findOrFail($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Fakt не найден']);
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
        $result = Fakt::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Fakt не найден']);
        }
        $validator = Validator::make($request->all(),[            
            'expect_id' => 'required|integer',
            'bus_id' => 'required|integer',
            'capacity'  => 'required|integer',
            'bank_credit'  => 'required|string',
            'auto_price'  => 'required',
            'purchase_date'  => 'required|date',
            'registr_cerf'  => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        if($result->status == 'accepted'){
            return response()->json(['error' => true, 'message' => 'Вы не можете изменить подтвержденный статус']);
        }else{
            $inputs = $request->all();
            $result->update($inputs);
        }
        return response()->json(['success' => true, 'message' => 'Fakt успешно создан']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Fakt::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Fakt не найден']);
        }
        $result->delete();
        return response()->json(['success' => true, 'message' => 'Fakt удален']);
    }

    public function reject(Request $request)
    {
        $id = $request->id;
        $inputs = $request->only('id','comment');
        $result = Fakt::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Fakt не найден']);
        }
        if($result->status == 'accepted'){
            return response()->json(['error' => true, 'message' => 'Вы не можете изменить подтвержденный статус']);
        }else{
            $result->comment = $request->comment;
            $result->status = 'rejected';
            $result->save();
        }
        return response()->json(['success' => true, 'message' => 'Статус изменен']);
    }

    public function accept(Request $request)
    {   
        $id = $request->id;
        $result = Fakt::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Fakt не найден']);
        }
        $result->status = 'accepted';
        $result->save();
        return response()->json(['success' => true, 'message' => 'Статус изменен']);
    }
}
