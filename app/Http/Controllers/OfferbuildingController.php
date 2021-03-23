<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offerbuilding;
use Validator;
use Image;

class OfferbuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Offerbuilding::with(['area','station'])->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            // 'type_of_construction'      => 'required|string',
            'name'      => 'required|string',
            'longitude'      => 'required',
            'latitude'      => 'required',
            'company_name'      => 'required|string',
            'station_id'      => 'required|integer',
            'area_id'      => 'required|integer',
            'address'      => 'required|string',
            'asos'      => 'required|string',
            'price'      => 'required',
            'bank_credit'      => 'required|string',
            'land_area'      => 'required|string',
            'time_of_construction_start'      => 'required|date',
            'time_of_construction_end'      => 'required|date',
            'telephon'      => 'required',
            'capacity_passenger'      => 'required',
            'work_schedule'      => 'required',
            'ustav_fond'      => 'required|string',
            'inn'      => 'required|integer|unique:offerbuildings,inn',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        //Upload file and image
        if($request->project_photo){
            $strposproject = strpos($request->project_photo,';');
            $subproject = substr($request->project_photo, 0,$strposproject);
            $exproject = explode('/',$subproject)[1];
            $img_nameproject = time()."offer.".$exproject;

            $imgproject = Image::make($request->project_photo);
            $img_pathproject = public_path()."/offer/";
            $imgproject->save($img_pathproject.$img_nameproject);
            $inputs['project_photo'] = $img_nameproject;
        }
        if($request->offer_hakim){
            $strpos = strpos($request->offer_hakim,';');
            $sub = substr($request->offer_hakim, 0,$strpos);
            $ex = explode('/',$sub)[1];
            $img_name = time()."offer_hakim.".$ex;

            $img = Image::make($request->offer_hakim);
            $img_path = public_path()."/offer/";
            $img->save($img_path.$img_name);
            $inputs['offer_hakim'] = $img_name;
        }
        $inputs['status'] = 'waiting';
        $inputs['created_by'] = $request->user()->id;
        $result = Offerbuilding::create($inputs);

        return response()->json(['success' => true, 'message' => 'Offerbuilding успешно создан']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Offerbuilding::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Offerbuilding не найден']);
        }
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Offerbuilding::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Offerbuilding не найден']);
        }
        $validator = Validator::make($request->all(),[    
            // 'type_of_construction'      => 'required|string',
            'name'      => 'required|string',
            'longitude'      => 'required',
            'latitude'      => 'required',
            'company_name'      => 'required|string',
            'station_id'      => 'required|integer',
            'area_id'      => 'required|integer',
            'address'      => 'required|string',
            'asos'      => 'required|string',
            'price'      => 'required',
            'offer_hakim'      => 'required|string',
            'bank_credit'      => 'required|string',
            'land_area'      => 'required|string',
            'time_of_construction_start'      => 'required|date',
            'time_of_construction_end'      => 'required|date',
            'telephon'      => 'required',
            'capacity_passenger'      => 'required',
            'work_schedule'      => 'required',
            'ustav_fond'      => 'required|string',
            'inn'  => 'required|integer|unique:offerbuildings,inn,'.$result->id
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        // Upload project_photo
        if ($request->project_photo != $result->project_photo){
            $strposoffer = strpos($request->project_photo,';');
            $suboffer = substr($request->project_photo, 0,$strposoffer);
            $exoffer = explode('/',$suboffer)[1];
            $project_photo = time()."offer.".$exoffer;
            $imgoffer = Image::make($request->project_photo);
            $offer_path = public_path()."/offer/";
            $imgoffer->save($offer_path.$project_photo);
            $imageoffer = $offer_path.$result->project_photo;
            if (file_exists($imageoffer)){
                @unlink($imageoffer);
            }
        }
        else{
            $project_photo = $result->project_photo;
        }        
        // Upload offer_hakim
        if ($request->offer_hakim != $result->offer_hakim){
            $strpos = strpos($request->offer_hakim,';');
            $sub = substr($request->offer_hakim, 0,$strpos);
            $ex = explode('/',$sub)[1];
            $offer_hakim = time()."offer_hakim.".$ex;
            $imghakim = Image::make($request->offer_hakim);
            $imghakim_path = public_path()."/offer/";
            $imghakim->save($imghakim_path.$offer_hakim);
            $imagehakim = $imghakim_path.$result->offer_hakim;
            if (file_exists($imagehakim)){
                @unlink($imagehakim);
            }
        }
        else{
            $offer_hakim = $result->offer_hakim;
        }
        $inputs = $request->all();
        $inputs['project_photo'] = $project_photo;
        $inputs['offer_hakim'] = $offer_hakim;
        $inputs['updated_by'] = $request->user()->id;
        $inputs['status'] = 'waiting';
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Offerbuilding успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Offerbuilding::find($id);
        $img_path = public_path()."/offer/";
        $project_photo = $img_path.$result->project_photo;
        if (file_exists($project_photo)){
            @unlink($project_photo);
        }
        $offer_hakim = $img_path.$result->offer_hakim;
        if (file_exists($offer_hakim)){
            @unlink($offer_hakim);
        }
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Offerbuilding не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Offerbuilding удален']);
    }
}
