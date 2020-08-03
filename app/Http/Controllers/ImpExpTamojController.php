<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImpExpTamoj;
use App\Country;
use Validator;
use DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

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
                'created_at' => now(),
                'updated_at' => now(),
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
            'created_at' => now(),
            'updated_at' => now(),
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
            'updated_at' => now(),
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

    public function excelOld(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'  => 'required|file',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($request->file);
        $worksheet = $spreadsheet->getActiveSheet();

        $rows = [];
        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        
        //Remove keys array
        array_shift($rows);


        //Write to DB
        foreach ($rows as $key => $inputs) {
            $country_id = 999;
            $inputs[4] = (int)$inputs[4];
            $country = Country::where(['code' => $inputs[4]])->first();
            if($country){
                $country_id = $country->id;
            }
            $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($inputs[1])->format('Y-m-d');

            $result = ImpExpTamoj::create([
                'mode'  => $inputs[0],
                'date' => $time,
                'vedcode' => $inputs[2],
                'product' => $inputs[3],
                'country_code' => $inputs[4],
                'code_group_id' => substr($inputs[2], 0,2),
                'country_id' => $country_id,
                'country_name' => $inputs[5],
                'transport_type' => $inputs[6],
                'transport_country_code' => $inputs[7],
                'weight' => floatval($inputs[8]) * 1000,
                'cost' => floatval($inputs[9]) * 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => true, 'rows' => count($rows)]);
    }

    public function excel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'  => 'required|file',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $countries = Country::pluck('id','code');
        $country_id = 9999;

        // if(isset($countries["276"])){
        //     $country_id = 276;
        // }
        // return response()->json(['error' => true, 'country_id' => $country_id]);

        if($request->file){
            
            $rows = [];
            $reader = ReaderEntityFactory::createXLSXReader($request->file);

            $reader->open($request->file);
            

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $k => $row) {
                    $cellData = [];
                    $cells = $row->getCells();
                    foreach ($cells as $key => $c) {
                        $cellData[] = $c->getValue();
                    }
                    if($k != 1){
                        if(isset($countries[$cellData[4]])){
                            $country_id = $countries[$cellData[4]];
                        }
                        $result = [
                            'mode'  => $cellData[0],
                            'date' => $cellData[1],
                            'vedcode' => $cellData[2],
                            'product' => $cellData[3],
                            'country_code' => (int)$cellData[4],
                            'code_group_id' => substr($cellData[2], 0,2),
                            'country_id' => $country_id,
                            'country_name' => $cellData[5],
                            'transport_type' => (int)$cellData[6],
                            'transport_country_code' => (int)$cellData[7],
                            'weight' => floatval($cellData[8]) * 1000,
                            'cost' => floatval($cellData[9]) * 1000,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                        $rows[] = $result;
                    }
                }
            }

            $reader->close();

            //Remove keys array
            array_shift($rows);
            //Make a collection to use chunk method
            $rows = collect($rows);
            $chunks = $rows->chunk(500);
            $err_rows = [];

            // return response()->json(['error' => true, 'chunks' => $chunks]);

            //Write to DB
            foreach ($chunks as $key => $chunk) {
                try {
                    \DB::table('imp_exp_tamojs')->insert($chunk->toArray());                    
                } catch (Exception $e) {
                    $err_rows[] = $chunk;
                }
            }
        }


        return response()->json(['success' => true, 'rows' => count($rows),'err_rows' => $err_rows]);
    }
}
