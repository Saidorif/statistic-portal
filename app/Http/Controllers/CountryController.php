<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Validator;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $result = Country::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = Country::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Страна не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
            'alfa2' => 'required|string',
            'alfa3' => 'required|string',
            'code'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name','alfa2','alfa3','code');
        $result = Country::create($inputs);

        return response()->json(['success' => true, 'message' => 'Страна успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = Country::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Страна не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
            'alfa2' => 'required|string',
            'alfa3' => 'required|string',
            'code'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name','alfa2','alfa3','code');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Страна успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = Country::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Страна не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Страна удален']);
    }
}
