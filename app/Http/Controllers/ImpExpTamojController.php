<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImpExpTamoj;
use App\Country;
use Validator;

class ImpExpTamojController extends Controller
{
    public function index(Request $request)
    {
        $result = ImpExpTamoj::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = ImpExpTamoj::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Содержимое не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.mode'  => 'required|string',
            '*.date' => 'required',
            '*.vedcode' => 'required|string',
            '*.product' => 'required|string',
            '*.country_code' => 'required|integer',
            '*.country_name' => 'required|string',
            '*.transport_type' => 'required|integer',
            '*.transport_country_code' => 'required|integer',
            '*.weight' => 'required',
            '*.cost' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        foreach ($request->all()as $key => $inputs) {
            $country_id = 999;
            $inputs['country_code'] = (int)$inputs['country_code'];
            $country = Country::where(['code' => $inputs['country_code']])->first();
            if($country){
                $country_id = $country->id;
            }
            $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($inputs['date'])->format('Y-m-d');

            $result = ImpExpTamoj::create([
                'mode'  => $inputs['mode'],
                'date' => $time,
                'vedcode' => $inputs['vedcode'],
                'product' => $inputs['product'],
                'country_code' => $inputs['country_code'],
                'code_group_id' => substr($inputs['vedcode'], 0,2),
                'country_id' => $country_id,
                'country_name' => $inputs['country_name'],
                'transport_type' => $inputs['transport_type'],
                'transport_country_code' => $inputs['transport_country_code'],
                'weight' => floatval($inputs['weight']) * 1000,
                'cost' => floatval($inputs['cost']) * 1000,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Содержимое успешно создан']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mode'  => 'required|string',
            'date' => 'required|date',
            'vedcode' => 'required|string',
            'product' => 'required|string',
            'country_code' => 'required|integer',
            'country_name' => 'required|string',
            'transport_type' => 'required|integer',
            'transport_country_code' => 'required|integer',
            'weight' => 'required|string',
            'cost' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        $country_id = 999;
        $inputs['country_code'] = (int)$inputs['country_code'];
        $country = Country::where(['code' => $inputs['country_code']])->first();
        if($country){
            $country_id = $country->id;
        }

        $result = ImpExpTamoj::create([
            'mode'  => $inputs['mode'],
            'date' => $inputs['date'],
            'vedcode' => $inputs['vedcode'],
            'product' => $inputs['product'],
            'country_code' => $inputs['country_code'],
            'code_group_id' => substr($inputs['vedcode'], 0,2),
            'country_id' => $country_id,
            'country_name' => $inputs['country_name'],
            'transport_type' => $inputs['transport_type'],
            'transport_country_code' => $inputs['transport_country_code'],
            'weight' => floatval($inputs['weight']) * 1000,
            'cost' => floatval($inputs['cost']) * 1000,
        ]);

        return response()->json(['success' => true, 'message' => 'Содержимое успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = ImpExpTamoj::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Содержимое не найден']);
        }
        $validator = Validator::make($request->all(), [
            'mode'  => 'required|string',
            'date' => 'required|date',
            'vedcode' => 'required|string',
            'product' => 'required|string',
            'country_code' => 'required|integer',
            'country_name' => 'required|string',
            'transport_type' => 'required|integer',
            'transport_country_code' => 'required|integer',
            'weight' => 'required|string',
            'cost' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        $country_id = 999;
        $inputs['country_code'] = (int)$inputs['country_code'];
        $country = Country::where(['code' => $inputs['country_code']])->first();
        if($country){
            $country_id = $country->id;
        }
        $result->update([
            'mode'  => $inputs['mode'],
            'date' => $inputs['date'],
            'vedcode' => $inputs['vedcode'],
            'product' => $inputs['product'],
            'country_code' => $inputs['country_code'],
            'code_group_id' => substr($inputs['vedcode'], 0,2),
            'country_id' => $country_id,
            'country_name' => $inputs['country_name'],
            'transport_type' => $inputs['transport_type'],
            'transport_country_code' => $inputs['transport_country_code'],
            'weight' => floatval($inputs['weight']) * 1000,
            'cost' => floatval($inputs['cost']) * 1000,
        ]);

        return response()->json(['success' => true, 'message' => 'Содержимое успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = ImpExpTamoj::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Содержимое не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Содержимое удален']);
    }
}
