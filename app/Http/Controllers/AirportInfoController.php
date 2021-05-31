<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirportInfo;
use App\PlaneType;
use App\AviaCity;
use App\AirportCode;
use App\AirportWay;
use App\AirportRecon;
use Validator;

class AirportInfoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $result = AirportInfo::with(['airport_name'])->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function list(Request $request)
    {
        $result = AirportInfo::all();
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function edit($id)
    {
        $result = AirportInfo::with([
            'plane_type',
            'avia_city',
            'airport_code',
            'airport_way',
            'airport_recon',
        ])->find($id);
        
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'airport_name_id'  => 'required|integer',
            'year'  => 'required|string',
            'address'  => 'required|string',
            'flight_mode'  => 'required|string',
            'freedom_air'  => 'nullable|string',
            'plane_types'  => 'nullable|array',
            'plane_types.*.name' => 'required|string',
            'cities'  => 'nullable|array',
            'cities.*.name' => 'required|string',
            'codes'  => 'nullable|array',
            'codes.*.tas_id' => 'required|string',
            'codes.*.code' => 'required|string',
            'ways'  => 'nullable|array',
            'ways.*.number' => 'required|string',
            'ways.*.width' => 'required|string',
            'ways.*.height' => 'required|string',
            'ways.*.coating' => 'required|string',
            'ways.*.category' => 'required|string',
            'recons'  => 'nullable|array',
            'recons.*.job_type' => 'required|string',
            'recons.*.year' => 'required|string',
            'recons.*.description' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only([
            'airport_name_id',
            'year',
            'address',
            'flight_mode',
            'freedom_air',
            'plane_types',
            'cities',
            'codes',
            'ways',
            'recons',
        ]);
        $result = AirportInfo::create($inputs);
        
        if($request->plane_types){
            foreach ($inputs['plane_types'] as $key => $value) {
                $planeType = new PlaneType();
                $planeType->airport_id = $result->id;
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }        

        if($request->cities){
            foreach ($inputs['cities'] as $key => $value) {
                $planeType = new AviaCity();
                $planeType->airport_id = $result->id;
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }

        if($request->codes){
            foreach ($inputs['codes'] as $key => $value) {
                $planeType = new AirportCode();
                $planeType->airport_id = $result->id;
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }

        if($request->ways){
            foreach ($inputs['ways'] as $key => $value) {
                $planeType = new AirportWay();
                $planeType->airport_id = $result->id;
                $planeType->number = $value['number'];
                $planeType->width = $value['width'];
                $planeType->height = $value['height'];
                $planeType->coating = $value['coating'];
                $planeType->category = $value['category'];
                $planeType->save();
            }
        }

        if($request->recons){
            foreach ($inputs['recons'] as $key => $value) {
                $planeType = new AirportRecon();
                $planeType->airport_id = $result->id;
                $planeType->job_type = $value['job_type']; 
                $planeType->year = $value['year'];
                $planeType->description = $value['description'];
                $planeType->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Аэропорт успешно создан']);
    }

    public function update(Request $request, $id)
    {
        $result = AirportInfo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'airport_name_id'  => 'required|integer',
            'year'  => 'required|string',
            'address'  => 'required|string',
            'flight_mode'  => 'required|string',
            'freedom_air'  => 'nullable|string',
            'plane_types'  => 'nullable|array',
            'new_plane_types'  => 'nullable|array',
            'plane_types.*.name' => 'required|string',
            'new_plane_types.*.name' => 'required|string',
            'codes'  => 'nullable|array',
            'codes.*.tas_id' => 'required|string',
            'codes.*.code' => 'required|string',
            'new_codes'  => 'nullable|array',
            'new_codes.*.tas_id' => 'required|string',
            'new_codes.*.code' => 'required|string',
            'ways'  => 'nullable|array',
            'ways.*.number' => 'required|string',
            'ways.*.width' => 'required|string',
            'ways.*.height' => 'required|string',
            'ways.*.coating' => 'required|string',
            'ways.*.category' => 'required|string',
            'new_ways'  => 'nullable|array',
            'new_ways.*.number' => 'required|string',
            'new_ways.*.width' => 'required|string',
            'new_ways.*.height' => 'required|string',
            'new_ways.*.coating' => 'required|string',
            'new_ways.*.category' => 'required|string', 
            'recons'  => 'nullable|array',
            'recons.*.job_type' => 'required|string',
            'recons.*.year' => 'required|string',
            'recons.*.description' => 'required|string',
            'new_recons'  => 'nullable|array',
            'new_recons.*.job_type' => 'required|string',
            'new_recons.*.year' => 'required|string',
            'new_recons.*.description' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only(['airport_name_id','year','address','flight_mode','freedom_air','plane_types','new_plane_types','cities','new_cities','codes','new_codes','ways','new_ways','recons','new_recons']);
        $result->update($inputs);

        // эски қабул қиладиган самолёт турлари 
        if($request->plane_types){
            foreach ($inputs['plane_types'] as $key => $value) {
                $planeType = PlaneType::where(['airport_id'=>$id,'id'=>$value['id']])->first();
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }
        // янги қабул қиладиган самолёт турлари 
        if($request->new_plane_types){
            foreach ($inputs['new_plane_types'] as $key => $value) {
                $planeType = new PlaneType();
                $planeType->airport_id = $id;
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }

        // эски шахарлар
        if($request->cities){
            foreach ($inputs['cities'] as $key => $value) {
                $planeType = AviaCity::where(['airport_id'=>$id,'id'=>$value['id']])->first();
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }
        // янги шахарлар
        if($request->new_cities){
            foreach ($inputs['new_cities'] as $key => $value){
                $planeType = new AviaCity();
                $planeType->airport_id = $id;
                $planeType->name = $value['name'];
                $planeType->save();
            }
        }

        // эски аэропорт кодлари
        if($request->codes){
            foreach ($inputs['codes'] as $key => $value) {
                $planeType = AirportCode::where(['airport_id'=>$id,'id'=>$value['id']])->first();
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }
        // янги аэропорт кодлари
        if($request->new_codes){
            foreach ($inputs['new_codes'] as $key => $value){
                $planeType = new AirportCode();
                $planeType->airport_id = $id;
                $planeType->tas_id = $value['tas_id'];
                $planeType->code = $value['code'];
                $planeType->save();
            }
        }
        // эски аэропорт кодлари
        if($request->ways){
            foreach ($inputs['ways'] as $key => $value) {
                $planeType = AirportWay::where(['airport_id'=>$id,'id'=>$value['id']])->first();
                $planeType->number = $value['number'];
                $planeType->width = $value['width'];
                $planeType->height = $value['height'];
                $planeType->coating = $value['coating'];
                $planeType->category = $value['category'];
                $planeType->save();
            }
        }
        // янги аэропорт кодлари
        if($request->new_ways){
            foreach ($inputs['new_ways'] as $key => $value){
                $planeType = new AirportWay();
                $planeType->airport_id = $id;
                $planeType->number = $value['number'];
                $planeType->width = $value['width'];
                $planeType->height = $value['height'];
                $planeType->coating = $value['coating'];
                $planeType->category = $value['category'];
                $planeType->save();
            }
        }
        // эски реконструкция ва таъмирлаш ишлари
        if($request->recons){
            foreach ($inputs['recons'] as $key => $value) {
                $planeType = AirportRecon::where(['airport_id'=>$id,'id'=>$value['id']])->first();
                $planeType->job_type = $value['job_type'];
                $planeType->year = $value['year'];
                $planeType->description = $value['description'];
                $planeType->save();
            }
        }
        // янги реконструкция ва таъмирлаш ишлари
        if($request->new_recons){
            foreach ($inputs['new_recons'] as $key => $value){
                $planeType = new AirportRecon();
                $planeType->airport_id = $id;
                $planeType->job_type = $value['job_type'];
                $planeType->year = $value['year'];
                $planeType->description = $value['description'];
                $planeType->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Аэропорт успешно обновлен']);
    }

    public function destroy(Request $request, $id)
    {
        $result = AirportInfo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Аэропорт не найден']);
        }
        $plane_types = PlaneType::where('airport_id',$id)->get();
        foreach ($plane_types as $key => $value){
            $value->delete();
        }
        $avia_cities = AviaCity::where('airport_id',$id)->get();
        foreach ($avia_cities as $key => $value){
            $value->delete();
        }
        $airport_codes = AirportCode::where('airport_id',$id)->get();
        foreach ($airport_codes as $key => $value){
            $value->delete();
        }
        $airport_ways = AirportWay::where('airport_id',$id)->get();
        foreach ($airport_ways as $key => $value){
            $value->delete();
        }
        $airport_recons = AirportRecon::where('airport_id',$id)->get();
        foreach ($airport_recons as $key => $value){
            $value->delete();
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Аэропорт удален']);
    }

    public function destroyPlaneType(Request $request, $id)
    {
        $result = PlaneType::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Тип самолета не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Тип самолета удален']);
    }

    public function destroyAviaCity(Request $request, $id)
    {
        $result = AviaCity::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Город не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Город удален']);
    }

    public function destroyAirportCode(Request $request, $id)
    {
        $result = AirportCode::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Код не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Код удален']);
    }

    public function destroyAirportWay(Request $request, $id)
    {
        $result = AirportWay::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Учиш-қўниш йўлаклари не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Учиш-қўниш йўлаклари удален']);
    }

    public function destroyAirportRecon(Request $request, $id)
    {
        $result = AirportRecon::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Реконструкция ва таъмирлаш ишлари не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Реконструкция ва таъмирлаш ишлари удален']);
    }
}
