<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirportName;
use Validator;

class AirportNameController extends Controller
{
    public function index(Request $request)
    {
        $result = AirportName::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = AirportName::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название аэропорта не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function list(Request $request)
    {
        $countries = AirportName::all();
        return response()->json(['success' => true, 'result' => $countries]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result = AirportName::create($inputs);

        return response()->json(['success' => true, 'message' => 'Название аэропорта успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = AirportName::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название аэропорта не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Название аэропорта успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = AirportName::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Название аэропорта не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Название аэропорта удален']);
    }
}
