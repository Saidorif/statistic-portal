<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirwaysCompanyInfo;

class AirwaysCompanyInfoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $result = AirwaysCompanyInfo::with(['airways_company'])->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function list(Request $request)
    {
        $result = AirwaysCompanyInfo::all();
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = AirwaysCompanyInfo::find($id);
        
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Информация не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'airways_company_id'  => 'required|integer',
            'year'  => 'required|string',
            'address'  => 'required|string',
            'fleet_size'  => 'required|integer',
            'call_name'  => 'required|string',
            'destination_qty'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only([
            'airways_company_id',
            'year',
            'address',
            'fleet_size',
            'call_name',
            'destination_qty',
        ]);
        $result = AirwaysCompanyInfo::create($inputs);
        
        return response()->json(['success' => true, 'message' => 'Информация успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = AirwaysCompanyInfo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Информация не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'airways_company_id'  => 'required|integer',
            'year'  => 'required|string',
            'address'  => 'required|string',
            'fleet_size'  => 'required|integer',
            'call_name'  => 'required|string',
            'destination_qty'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only([
            'airways_company_id',
            'year',
            'address',
            'fleet_size',
            'call_name',
            'destination_qty',
        ]);
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Информация успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = AirwaysCompanyInfo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Информация не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Информация удален']);
    }

}