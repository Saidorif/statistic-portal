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

    public function firstReport(Request $request)
    {
        $start = microtime(true);
        // $result = DB::select("select c.name,ex_imp.summ from countries as c left join ( select country_id, SUM(weight) as summ from imp_exp_tamojs GROUP BY country_id ) as ex_imp ON c.id = ex_imp.country_id");
        $countries = Country::all();
        $result = [];
        foreach ($countries as $key => $country) {
            $weight = ImpExpTamoj::where(['country_id' => $country->id])->sum('weight');
            $result[][$country->name] = $weight;
        }
        $time_elapsed_secs = microtime(true) - $start;
        return response()->json(['success' => true, 'result' => $result,'time_elapsed_secs' => $time_elapsed_secs]);
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

        if($request->file){
            $strposfile = strpos($request->file,';');
            $subfile = substr($request->file, 0,$strposfile);
            $exfile = explode('/',$subfile)[1];
            $file_name = time()."file.".$exfile;

            $file = Image::make($request->file);
            $file_path = public_path()."/excels/";
            $file->save($file_path.$file_name);
            $inputs['file'] = $file_name;
            
            $rows = [];

            $reader = ReaderEntityFactory::createXLSXReader($file_path.$file_name);

            $reader->open($file_path.$file_name);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $k => $row) {
                    $cellData = [];
                    $cells = $row->getCells();
                    foreach ($cells as $key => $c) {
                        $cellData[] = $c->getValue();
                    }
                    $rows[] = $cellData;
                }
            }

            $reader->close();

            //Remove keys array
            array_shift($rows);

            return response()->json(['success' => true,'filepath' => $file_path.$file_name , 'rows' => count($rows)]);
            

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
                ]);
            }
        }


        return response()->json(['success' => true, 'rows' => count($rows)]);
    }
}
