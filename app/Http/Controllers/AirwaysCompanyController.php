<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirwaysCompany;
use Validator;

class AirwaysCompanyController extends Controller
{
    public function index(Request $request)
    {
        $result = AirwaysCompany::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function list(Request $request)
    {
        $result = AirwaysCompany::all();
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = AirwaysCompany::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название Airways не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name' => 'required|string|unique:airways_companies',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result = AirwaysCompany::create($inputs);

        return response()->json(['success' => true, 'message' => 'Название Airways успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = AirwaysCompany::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название Airways не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string|unique:airways_companies,name,'.$result->id,
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Название Airways успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = AirwaysCompany::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название Airways не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Название Airways удален']);
    }
}

