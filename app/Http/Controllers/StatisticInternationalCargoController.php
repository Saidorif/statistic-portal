<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\StatisticInternationalCargo;
use DB;
use Validator;
class StatisticInternationalCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    {
        $year= $request->year;
        $lastYear = StatisticInternationalCargo::latest('year')->first();
        $getYear = '';
        if($lastYear){
            $getYear = empty($request->year) ? $lastYear->year : $year; 
            $oldyear = (int)($getYear-1);
            $result = DB::select("SELECT 
                t1.id,
                t1.type,
                IFNULL(t1.yanvar, 0) + 
                IFNULL(t1.fevral, 0) + 
                IFNULL(t1.mart, 0) + 
                IFNULL(t1.aprel, 0) + 
                IFNULL(t1.may, 0) + 
                IFNULL(t1.iyun, 0) + 
                IFNULL(t1.iyul, 0) + 
                IFNULL(t1.avgust, 0) + 
                IFNULL(t1.sentabr, 0) + 
                IFNULL(t1.oktabr, 0) + 
                IFNULL(t1.noyabr, 0) + 
                IFNULL(t1.dekabr, 0) + 
                0 total,
                IFNULL(t2.yanvar, 0) + 
                IFNULL(t2.fevral, 0) + 
                IFNULL(t2.mart, 0) + 
                IFNULL(t2.aprel, 0) + 
                IFNULL(t2.may, 0) + 
                IFNULL(t2.iyun, 0) + 
                IFNULL(t2.iyul, 0) + 
                IFNULL(t2.avgust, 0) + 
                IFNULL(t2.sentabr, 0) + 
                IFNULL(t2.oktabr, 0) + 
                IFNULL(t2.noyabr, 0) + 
                IFNULL(t2.dekabr, 0) + 
                0 old_total,
                ROUND(
                    IFNULL(
                        IFNULL(t1.yanvar, 0) + 
                        IFNULL(t1.fevral, 0) + 
                        IFNULL(t1.mart, 0) + 
                        IFNULL(t1.aprel, 0) + 
                        IFNULL(t1.may, 0) + 
                        IFNULL(t1.iyun, 0) + 
                        IFNULL(t1.iyul, 0) + 
                        IFNULL(t1.avgust, 0) + 
                        IFNULL(t1.sentabr, 0) + 
                        IFNULL(t1.oktabr, 0) + 
                        IFNULL(t1.noyabr, 0) + 
                        IFNULL(t1.dekabr, 0) + 
                        0
                    ,0)/IFNULL(
                        IFNULL(t2.yanvar, 0) + 
                        IFNULL(t2.fevral, 0) + 
                        IFNULL(t2.mart, 0) + 
                        IFNULL(t2.aprel, 0) + 
                        IFNULL(t2.may, 0) + 
                        IFNULL(t2.iyun, 0) + 
                        IFNULL(t2.iyul, 0) + 
                        IFNULL(t2.avgust, 0) + 
                        IFNULL(t2.sentabr, 0) + 
                        IFNULL(t2.oktabr, 0) + 
                        IFNULL(t2.noyabr, 0) + 
                        IFNULL(t2.dekabr, 0) + 
                        0
                    ,0)
                *100) total_percentage,
                IFNULL(t1.yanvar, 0) yanvar,
                IFNULL(t1.fevral, 0) fevral,
                IFNULL(t1.mart, 0) mart,
                IFNULL(t1.aprel, 0) aprel, 
                IFNULL(t1.may, 0) may, 
                IFNULL(t1.iyun, 0) iyun, 
                IFNULL(t1.iyul, 0) iyul, 
                IFNULL(t1.avgust, 0) avgust, 
                IFNULL(t1.sentabr, 0) sentabr, 
                IFNULL(t1.oktabr, 0) oktabr, 
                IFNULL(t1.noyabr, 0) noyabr, 
                IFNULL(t1.dekabr, 0) dekabr,
                t1.year year
                FROM statistic_international_cargos t1
                left join (
                    SELECT * FROM `statistic_international_cargos` 
                    where year = '$oldyear'
                ) t2 USING(type)
                where t1.year = '$getYear'" 
            );
            $all_calculation = DB::select("
                SELECT 
                t1.year,
                MAX('all') type,
                SUM(
                    IFNULL(t1.yanvar, 0) + 
                    IFNULL(t1.fevral, 0) + 
                    IFNULL(t1.mart, 0) + 
                    IFNULL(t1.aprel, 0) + 
                    IFNULL(t1.may, 0) + 
                    IFNULL(t1.iyun, 0) + 
                    IFNULL(t1.iyul, 0) + 
                    IFNULL(t1.avgust, 0) + 
                    IFNULL(t1.sentabr, 0) + 
                    IFNULL(t1.oktabr, 0) + 
                    IFNULL(t1.noyabr, 0) + 
                    IFNULL(t1.dekabr, 0) + 
                0) total,
                IFNULL((SELECT 
                    SUM(
                    IFNULL(yanvar, 0) + 
                    IFNULL(fevral, 0) + 
                    IFNULL(mart, 0) + 
                    IFNULL(aprel, 0) + 
                    IFNULL(may, 0) + 
                    IFNULL(iyun, 0) + 
                    IFNULL(iyul, 0) + 
                    IFNULL(avgust, 0) + 
                    IFNULL(sentabr, 0) + 
                    IFNULL(oktabr, 0) + 
                    IFNULL(noyabr, 0) + 
                    IFNULL(dekabr, 0) + 
                    0) total
                    FROM `statistic_international_cargos`
                    where year = '$oldyear'
                    GROUP BY year),0) last_total,
                IFNULL(SUM(t1.yanvar),0) yanvar,
                IFNULL(SUM(t1.fevral),0) fevral,
                IFNULL(SUM(t1.mart),0) mart,
                IFNULL(SUM(t1.aprel),0) aprel,
                IFNULL(SUM(t1.may),0) may,
                IFNULL(SUM(t1.iyun),0) iyun,
                IFNULL(SUM(t1.iyul),0) iyul,
                IFNULL(SUM(t1.avgust),0) avgust,
                IFNULL(SUM(t1.sentabr),0) sentabr,
                IFNULL(SUM(t1.oktabr),0) oktabr,
                IFNULL(SUM(t1.noyabr),0) noyabr,
                IFNULL(SUM(t1.dekabr),0) dekabr
                FROM `statistic_international_cargos` t1
                where t1.year = '$getYear'
                GROUP BY t1.year
            ");

        }else{
            $result = [];
            $all_calculation = [];
        }
        $all = array_merge($all_calculation,$result);
        $r['items'] = $all;
        $r['all_calculation'] = $all_calculation;
        $r['getYear'] = $getYear;
        return response()->json(['success' => true, 'result' => $r]);
    }

    public function customPaginate($items, $perPage = 14, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(),[
            'type'=>'required|string',
            'year'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $inputs = $request->all();
        $inputs = $request->only('type','number','year','yanvar','fevral','mart','aprel','may','iyun','iyul','avgust','sentabr','oktabr','noyabr','dekabr');
        $checkResult = StatisticInternationalCargo::where(['type'=>$inputs['type'],'year'=>$inputs['year']])->first();
        if($checkResult){
            return response()->json(['error' => true, 'message' => 'Вы уже добавили на этот год такое данное!']);
        }else{
            $result = StatisticInternationalCargo::create($inputs);
        }
        return response()->json(['success' => true, 'message' => 'StatisticInternationalCargo успешно создана']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = StatisticInternationalCargo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalCargo не найден']);
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
        $result = StatisticInternationalCargo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalCargo не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'type'=>'required|string',
            'year'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('type','number','year','yanvar','fevral','mart','aprel','may','iyun','iyul','avgust','sentabr','oktabr','noyabr','dekabr');
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'StatisticInternationalCargo успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = StatisticInternationalCargo::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalCargo не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'StatisticInternationalCargo удален']);
    }
}

