<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Region;
use App\StatisticAvtoMainIndicator;
use Validator;
use DB;
class StatisticAvtoMainIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    {
        $year= $request->year.'-01-01';
        $lastYear = StatisticAvtoMainIndicator::latest('year')->first();
        $getYear = '';
        if($lastYear){
            $getYear = empty($request->year) ? $lastYear->year : $year; 
            $result = DB::select("SELECT type,
                SUM(IFNULL(quarter_one, 0) + IFNULL(quarter_two, 0) + IFNULL(quarter_three, 0) + IFNULL(quarter_four, 0)) summ,
                MAX(year) year,
                SUM(IFNULL(quarter_one, 0)) quarter_one,
                SUM(IFNULL(quarter_two, 0)) quarter_two,
                SUM(IFNULL(quarter_three, 0)) quarter_three,
                SUM(IFNULL(quarter_four, 0)) quarter_four FROM statistic_avto_main_indicators 
                where year = '$getYear'
                GROUP BY type"
            );
        }else{
            $result = [];
        }
        $r['items'] = $result;
        $r['getYear'] = substr($getYear,0,4);
        return response()->json(['success' => true, 'result' => $r]);
    }

    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type'=>'required|string',
            'year'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $year = $request->year.'-01-01';
        $oldyear = (int)($request->year-1).'-01-01';
        $type = $request->type;
        $data = DB::select("
            SELECT 
            t1.id,
            t1.region_id,
            r.name region_name,
            t1.type,
            t1.year,
            IFNULL(IFNULL(t1.quarter_one, 0) + IFNULL(t1.quarter_two, 0) + IFNULL(t1.quarter_three, 0) + IFNULL(t1.quarter_four, 0),0) total_last,
            ROUND(IFNULL(IFNULL(t1.quarter_one, 0) + IFNULL(t1.quarter_two, 0) + IFNULL(t1.quarter_three, 0) + IFNULL(t1.quarter_four, 0),0)/IFNULL(IFNULL(t2.quarter_one, 0) + IFNULL(t2.quarter_two, 0) + IFNULL(t2.quarter_three, 0) + IFNULL(t2.quarter_four, 0),0)*100) total_percentage,
            IFNULL(t1.quarter_one,0) quarter_one,
            ROUND(IFNULL(IFNULL(t1.quarter_one, 0)/IFNULL(t2.quarter_one, 0)*100,0)) quarter_one_percentage, 
            IFNULL(t1.quarter_two,0) quarter_two,
            ROUND(IFNULL(IFNULL(t1.quarter_two, 0)/IFNULL(t2.quarter_two, 0)*100,0)) quarter_two_percentage, 
            IFNULL(t1.quarter_three,0) quarter_three,
            ROUND(IFNULL(IFNULL(t1.quarter_three, 0)/IFNULL(t2.quarter_three, 0)*100,0)) quarter_three_percentage,
            IFNULL(t1.quarter_four,0) quarter_four,
            ROUND(IFNULL(IFNULL(t1.quarter_four, 0)/IFNULL(t2.quarter_four, 0)*100,0)) quarter_four_percentage
            FROM `statistic_avto_main_indicators` t1 
            left join (
                SELECT * FROM `statistic_avto_main_indicators` 
                where year = '$oldyear' and type = '$type'
            ) t2 USING(region_id)
            left join (
                SELECT * FROM `regions` 
            ) r on t1.region_id = r.id
            where t1.year = '$year' and t1.type = '$type'"
        );
        $result = $this->customPaginate($data);
        return response()->json(['success' => true, 'result' => $result]);
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
        $validator = Validator::make($request->all(), [
            'region_id'=>'required|integer',
            'type'=>'required|string',
            'year'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }

        $inputs = $request->all();
        $inputs = $request->only('region_id','type','number','year','quarter_one','quarter_two','quarter_three','quarter_four');
        $inputs['year'] = $inputs['year'].'-01-01';
        $checkResult = StatisticAvtoMainIndicator::where(['region_id'=>$inputs['region_id'],'type'=>$inputs['type'],'year'=>$inputs['year']])->first();
        if($checkResult){
            return response()->json(['error' => true, 'message' => 'Вы уже добавили на этот год такое данное!']);
        }else{
            $result = StatisticAvtoMainIndicator::create($inputs);
        }
        return response()->json(['success' => true, 'message' => 'Statistic успешно создана']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = StatisticAvtoMainIndicator::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Statistic не найден']);
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
        $result = StatisticAvtoMainIndicator::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Statistic не найден']);
        }
        $validator = Validator::make($request->all(), [            
            'region_id'=>'required|integer',
            'type'=>'required|string',
            'year'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true, 'message' => $validator->messages()]);
        }
        $inputs = $request->only('region_id','type','number','year','quarter_one','quarter_two','quarter_three','quarter_four');
        $inputs['year'] = $inputs['year'].'-01-01';
        $result->update($inputs);

        return response()->json(['success' => true, 'message' => 'Statistic успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = StatisticAvtoMainIndicator::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'Statistic не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'Statistic удален']);
    }
}

// SELECT 
// t1.id,
// t1.region_id,
// r.name region_name,
// t1.type,
// t1.year,
// IFNULL(IFNULL(t1.quarter_one, 0) + IFNULL(t1.quarter_two, 0) + IFNULL(t1.quarter_three, 0) + IFNULL(t1.quarter_four, 0),0) total_last,
// ROUND(IFNULL(IFNULL(t1.quarter_one, 0) + IFNULL(t1.quarter_two, 0) + IFNULL(t1.quarter_three, 0) + IFNULL(t1.quarter_four, 0),0)/IFNULL(IFNULL(t2.quarter_one, 0) + IFNULL(t2.quarter_two, 0) + IFNULL(t2.quarter_three, 0) + IFNULL(t2.quarter_four, 0),0)*100) total_percentage,
// IFNULL(t1.quarter_one,0) quarter_one,
// ROUND(IFNULL(IFNULL(t1.quarter_one, 0)/IFNULL(t2.quarter_one, 0)*100,0)) quarter_one_percentage, 
// IFNULL(t1.quarter_two,0) quarter_two,
// ROUND(IFNULL(IFNULL(t1.quarter_two, 0)/IFNULL(t2.quarter_two, 0)*100,0)) quarter_two_percentage, 
// IFNULL(t1.quarter_three,0) quarter_three,
// ROUND(IFNULL(IFNULL(t1.quarter_three, 0)/IFNULL(t2.quarter_three, 0)*100,0)) quarter_three_percentage,
// IFNULL(t1.quarter_four,0) quarter_four,
// ROUND(IFNULL(IFNULL(t1.quarter_four, 0)/IFNULL(t2.quarter_four, 0)*100,0)) quarter_four_percentage
// FROM `statistic_avto_main_indicators` t1 
// left join (
//     SELECT * FROM `statistic_avto_main_indicators` 
//     where year = '$oldyear' and type = '$type'
// ) t2 USING(region_id)
// left join (
//     SELECT * FROM `regions` 
// ) r on t1.region_id = r.id
// where t1.year = '$year' and t1.type = '$type'