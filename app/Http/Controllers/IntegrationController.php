<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TokenIntegration;
use Carbon\Carbon;
use Validator;
class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getTenderRegions(){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('http://crm.uztrans.uz/api/region/list');
            $result = json_decode($response->getBody()->getContents(),true);
            return response()->json($result);
        } catch (\Throwable $th) {
            throw $th;die;
            return response()->json(['error' => true, 'message' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже!']);
        }
    }

    public function tender(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'dir_type' => 'nullable|string',
        //     'from_date' => 'nullable|string',
        //     'to_date' => 'nullable|string',
        // ]);
        // if($validator->fails()){
        //     return response()->json(['error' => true, 'message' => $validator->messages()]);
        // }
        $inputs = $request->all();
        $user = $request->user();
   
        $checkInteg = $this->getTenderToken();
        if($checkInteg){
            try {
                // $query = json_encode($inputs);
                $client = new \GuzzleHttp\Client();
                $response = $client->post('http://crm.uztrans.uz/api/integration/get-directions', [
                    'headers' => [
                        'Content-Type' => 'application/json', 
                        'Accept' => 'application/json',
                        'Authorization' => "Bearer {$checkInteg->token}"
                    ],
                    // 'body' => $query
                ]);
                $result = json_decode($response->getBody()->getContents(),true);
                return response()->json($result);
            } catch (\Throwable $th) {
                throw $th;die;
                return response()->json(['error' => true, 'message' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже!']);
            }
        }
        return response()->json(['error' => true, 'message' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже!']);
    }

    public function tenderByRegion(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'region_id' => 'required',
            'dir_type' => 'nullable|string',
            'from_date' => 'nullable|string',
            'to_date' => 'nullable|string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->all();
        $user = $request->user();
   
        $checkInteg = $this->getTenderToken();
        if($checkInteg){
            try {
                $query = json_encode($inputs);
                $client = new \GuzzleHttp\Client();
                $response = $client->post('http://crm.uztrans.uz/api/integration/get-direction-byregion', [
                    'headers' => [
                        'Content-Type' => 'application/json', 
                        'Accept' => 'application/json',
                        'Authorization' => "Bearer {$checkInteg->token}"
                    ],
                    'body' => $query
                ]);
                $result = json_decode($response->getBody()->getContents(),true);
                return response()->json($result);
            } catch (\Throwable $th) {
                throw $th;die;
                return response()->json(['error' => true, 'message' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже!']);
            }
        }
        return response()->json(['error' => true, 'message' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже!']);
    }

    public function getTenderToken(){
        $integ = TokenIntegration::where('expired_time', '>', date('Y-m-d H:m:s'))->where('type','tender')->first();
        if(!$integ){
            try {
                $client = new \GuzzleHttp\Client();

                $response = $client->post('http://crm.uztrans.uz/api/login', [
                    'form_params' => [
                            'email' => 'integration@mail.ru',
                            'password' => 'integration1234',
                        ]
                    ]
                );
                $result = json_decode($response->getBody()->getContents(),true);

                if($result['token']){
                    $exp_date = Carbon::parse($result['exp_date']*60)->timestamp;
                    $current_timestamp = Carbon::now()->timestamp;
                    $expired_time = Carbon::createFromTimestamp($current_timestamp + $exp_date)->toDateTimeString();
                    $integ = TokenIntegration::create([
                        'expired_time' => $expired_time,
                        'type' => 'tender',
                        'token' => $result['token'],
                    ]);
                }
            } catch (\Throwable $th) {
                return false;
            }
        }
        if($integ){
            return $integ;
        }
        return false;
    }

}
