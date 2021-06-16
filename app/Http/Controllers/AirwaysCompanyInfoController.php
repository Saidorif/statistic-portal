<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirwaysCompanyInfo;
use App\AirwaysCode;
use Validator;
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
        $result = AirwaysCompanyInfo::with(['airways_code'])->find($id);
        
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
            'codes'  => 'nullable|array',
            'codes.*.tas_id' => 'required|string',
            'codes.*.code' => 'required|string',
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
            'codes',
        ]);
        $result = AirwaysCompanyInfo::create($inputs);
        if($request->codes){
            foreach ($inputs['codes'] as $key => $value) {
                $planeType = new AirwaysCode();
                $planeType->airways_id = $result->id;
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }

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
            'codes'  => 'nullable|array',
            'codes.*.tas_id' => 'required|string',
            'codes.*.code' => 'required|string',
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
            'codes',
            'new_codes',
        ]);
        $result->update($inputs);

        // эски авиакомпания кодлари
        if($request->codes){
            foreach ($inputs['codes'] as $key => $value) {
                $planeType = AirwaysCode::where(['airways_id'=>$id,'id'=>$value['id']])->first();
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }
        // янги авиакомпания кодлари
        if($request->new_codes){
            foreach ($inputs['new_codes'] as $key => $value){
                $planeType = new AirwaysCode();
                $planeType->airways_id = $id;
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }

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

    public function destroyAirwaysCode(Request $request, $id)
    {
        $result = AirwaysCode::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Код не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Код удален']);
    }

}