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
            'code_from'  => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('name','code_from');

        if ($request->code_to) {
            $start = $request->code_from;
            $end = (int)$request->code_to;
            $length = strlen($start);
            $result = [];
            for ($i = (int)$start; $i <= $end; $i++) { 
                $result = CodeGroup::create([
                    'name' => $inputs['name'],
                    'code' => str_pad($i,$length,"0",STR_PAD_LEFT),
                ]);
            }
        }else{
            $result = CodeGroup::create([
                'name' => $inputs['name'],
                'code' => $request->code_from,
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
