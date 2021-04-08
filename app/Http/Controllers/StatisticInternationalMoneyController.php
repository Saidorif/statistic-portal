<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\StatisticInternationalMoney;
use DB;
use Validator;

class StatisticInternationalMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function main(Request $request)
    {
        $year= $request->year;
        $months= $request->months;
        $lastYear = StatisticInternationalMoney::latest('year')->first();
        $sqlT1Sum = '';
        $sqlSum = '';
        $sqlT1 = '';
        $sqlT1GroupBySum = '';
        $sqlT2Sum = '';
        if(count($months) > 0){
            foreach($months as $key => $value){
                $sqlT1Sum .= 'IFNULL(t1.'.$value.', 0) + ';
                $sqlT2Sum .= 'IFNULL(t2.'.$value.', 0) + ';
                $sqlT1 .= 'IFNULL(t1.'.$value.', 0) '.$value.',';
                $sqlSum = 'IFNULL('.$value.', 0) + '; 
                $sqlT1GroupBySum .= 'IFNULL(SUM(t1.'.$value.'),0) '.$value.',';
            }
        }else{
            $sqlT1Sum = 'IFNULL(t1.yanvar, 0) +
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
                IFNULL(t1.dekabr, 0) + ';

            $sqlT2Sum = 'IFNULL(t2.yanvar, 0) + 
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
                IFNULL(t2.dekabr, 0) + ';   

            $sqlT1 = 'IFNULL(t1.yanvar, 0) yanvar,
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
                IFNULL(t1.dekabr, 0) dekabr,';    

            $sqlSum = 'IFNULL(yanvar, 0) + 
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
                IFNULL(dekabr, 0) +'; 

            $sqlT1GroupBySum = 'IFNULL(SUM(t1.yanvar),0) yanvar,
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
                IFNULL(SUM(t1.dekabr),0) dekabr,'; 


        }
        $getYear = '';
  
        if($lastYear){
            $getYear = empty($request->year) ? $lastYear->year : $year; 
            $oldyear = (int)($getYear-1);
            $result = DB::select("SELECT 
                t1.id,
                t1.type,
                $sqlT1Sum
                0 total,
                $sqlT2Sum
                0 old_total,
                ROUND(
                    IFNULL(
                        $sqlT1Sum
                        0
                    ,0)/IFNULL(
                        $sqlT2Sum
                        0
                    ,0)
                *100) total_percentage,
                $sqlT1
                t1.year year
                FROM statistic_international_money t1
                left join (
                    SELECT * FROM `statistic_international_money` 
                    where year = '$oldyear'
                ) t2 USING(type)
                where t1.year = '$getYear'" 
            );
            $all_calculation = DB::select("
                SELECT 
                t1.year,
                MAX('all') type,
                SUM(
                    $sqlT1Sum
                0) total,
                $sqlT1GroupBySum
                IFNULL((SELECT 
                    SUM(
                        $sqlSum
                    0) total
                    FROM `statistic_international_money`
                    where year = '$oldyear'
                    GROUP BY year),0) last_total       
                FROM `statistic_international_money` t1
                where t1.year = '$getYear'
                GROUP BY t1.year
            ");

        }else{
            $result = [];
            $all_calculation = [];
        }
        // $all = array_merge($all_calculation,$result);
        $r['items'] = $result;
        // $r['all_calculation'] = $all_calculation;
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
        $checkResult = StatisticInternationalMoney::where(['type'=>$inputs['type'],'year'=>$inputs['year']])->first();
        if($checkResult){
            return response()->json(['error' => true, 'message' => 'Вы уже добавили на этот год такое данное!']);
        }else{
            $result = StatisticInternationalMoney::create($inputs);
        }
        return response()->json(['success' => true, 'message' => 'StatisticInternationalMoney успешно создана']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = StatisticInternationalMoney::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalMoney не найден']);
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
        $result = StatisticInternationalMoney::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalMoney не найден']);
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

        return response()->json(['success' => true, 'message' => 'StatisticInternationalMoney успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = StatisticInternationalMoney::find($id);
        if(!$result){
            return response()->json(['error' => true, 'message' => 'StatisticInternationalMoney не найден']);
        }
        $result->delete();

        return response()->json(['success' => true, 'message' => 'StatisticInternationalMoney удален']);
    }
}
