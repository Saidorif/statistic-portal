<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offerbuilding;
use App\Reconstruction;
use App\ReconstructionGallery;
use Validator;
use Image;
use Illuminate\Support\Str;

class ReconstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Reconstruction::with('offerbuilding')->paginate(12);
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name'  => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $user = $request->user();
        $builder = Offerbuilding::query();
        $builder->where('company_name','LIKE', '%'.$request->input('name').'%');
        // $builder->orWhere('name','LIKE', '%'.$request->input('name').'%');
        $result = $builder->get();
        return response()->json(['success' => true, 'result' => $result]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
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
            'offerbuilding_id'      => 'required|integer',
            'start_date'      => 'required|date',
            'end_date'      => 'required|date',
            'summa'      => 'required',
            'asos'      => 'required|string',
            'recon_hakim'      => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        //Upload file and image
        if($request->recon_hakim){
            $strposproject = strpos($request->recon_hakim,';');
            $subproject = substr($request->recon_hakim, 0,$strposproject);
            $exproject = explode('/',$subproject)[1];
            $img_nameproject = time()."r.".$exproject;

            $imgproject = Image::make($request->recon_hakim);
            $img_pathproject = public_path()."/reconstruction/";
            $imgproject->save($img_pathproject.$img_nameproject);
            $inputs['recon_hakim'] = $img_nameproject;
        }
        $inputs['status'] = 'waiting';
        $inputs['created_by'] = $request->user()->id;
        $reconstruction = Reconstruction::create($inputs);

        // Create Reconstruction Gallery
        if(count($inputs['gallery']) > 0){
            foreach ($inputs['gallery'] as $key => $gallery) {
                $strpositem = strpos($gallery,';');
                $subitem = substr($gallery, 0,$strpositem);
                $exitem = explode('/',$subitem)[1];
                $img_nameitem = 'foto'.time().$key."g.".$exitem;

                $imgitem = Image::make($gallery);
                $img_pathitem = public_path()."/reconstructiongallery/";
                $imgitem->save($img_pathitem.$img_nameitem);

                $gal = new ReconstructionGallery();
                $gal->reconstruction_id = $reconstruction->id;
                $gal->name = $img_nameitem;
                $gal->save();

            }
        }

        return response()->json(['success' => true, 'message' => 'Reconstruction успешно создан']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Reconstruction::with(['offerbuilding','gallery'])->find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Reconstruction не найден']);
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
        $result = Reconstruction::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Reconstruction не найден']);
        }

        $validator = Validator::make($request->all(), [   
            'offerbuilding_id'      => 'required|integer',
            'start_date'      => 'required|date',
            'end_date'      => 'required|date',
            'summa'      => 'required',
            'asos'      => 'required|string',
            'recon_hakim'      => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        // Upload recon_hakim
        if ($request->recon_hakim != $result->recon_hakim){
            $strpos = strpos($request->recon_hakim,';');
            $sub = substr($request->recon_hakim, 0,$strpos);
            $ex = explode('/',$sub)[1];
            $recon_hakim = time()."r.".$ex;
            $imghakim = Image::make($request->recon_hakim);
            $imghakim_path = public_path()."/reconstruction/";
            $imghakim->save($imghakim_path.$recon_hakim);
            $imagehakim = $imghakim_path.$result->recon_hakim;
            if (file_exists($imagehakim)){
                @unlink($imagehakim);
            }
        }
        else{
            $recon_hakim = $result->recon_hakim;
        }
        $inputs['recon_hakim'] = $recon_hakim;
        $inputs['status'] = 'waiting';
        $inputs['updated_by'] = $request->user()->id;
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Reconstruction успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Reconstruction::find($id);
        $img_path = public_path()."/reconstruction/";
        $recon_hakim = $img_path.$result->recon_hakim;
        if (file_exists($recon_hakim)){
            @unlink($recon_hakim);
        }
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Reconstruction не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Reconstruction удален']);
    }

    public function reject(Request $request)
    {
        $id = $request->id;
        $inputs = $request->only('id','comment');
        $result = Reconstruction::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Reconstruction не найден']);
        }
        if($result->status == 'accepted'){
            return response()->json(['error' => true, 'message' => 'Вы не можете изменить подтвержденный статус']);
        }else{
            $result->comment = $request->comment;
            $result->status = 'rejected';
            $result->save();
        }
        return response()->json(['success' => true, 'message' => 'Статус изменен']);
    }

    public function accept(Request $request)
    {   
        $id = $request->id;
        $result = Reconstruction::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Reconstruction не найден']);
        }
        $result->status = 'accepted';
        $result->save();
        return response()->json(['success' => true, 'message' => 'Статус изменен']);
    }
}
