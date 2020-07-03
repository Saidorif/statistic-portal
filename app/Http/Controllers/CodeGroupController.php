<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CodeGroup;
use Validator;

class CodeGroupController extends Controller
{
    public function index(Request $request)
    {
        $result = CodeGroup::paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = CodeGroup::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'ВЭД не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
            'codes'  => 'required|array',
            'codes.*.code'  => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name','codes');

        foreach ($inputs['codes'] as $key => $code) {
            $result = CodeGroup::create([
                'name' => $inputs['name'],
                'code' => $code['code'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'ВЭД успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = CodeGroup::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'ВЭД не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
            'code'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name','code');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'ВЭД успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = CodeGroup::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'ВЭД не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'ВЭД удален']);
    }
}
