<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\ImpExpTamoj;
use App\CodeGroup;
use DB;

class ReportController extends Controller
{
    public function first(Request $request)
    {
        $start = microtime(true);
        $data = DB::select("select
            c.id, 
            c.name, 
            COALESCE (ex_old_whole_year.ex_old_whole_weight, 0) ex_old_whole_weight,
            COALESCE (ex_old_year.ex_old_weight, 0) ex_old_weight,
            COALESCE (ex_new_year.ex_new_weight, 0) ex_new_weight,
            COALESCE (( ex_new_year.ex_new_weight/ex_old_year.ex_old_weight ) *100, 0) ex_percantage,
            COALESCE (imp_old_whole_year.imp_old_whole_weight, 0) imp_old_whole_weight,
            COALESCE (imp_old_year.imp_old_weight, 0) imp_old_weight,
            COALESCE (imp_new_year.imp_new_weight, 0) imp_new_weight,
            COALESCE (( imp_new_year.imp_new_weight/imp_old_year.imp_old_weight ) *100, 0) imp_percantage
            from countries c 
            left join ( select SUM( weight )/1000 ex_old_whole_weight , country_id from imp_exp_tamojs where mode = 'ЭК' AND date between '2019-01-01' AND '2019-12-31' GROUP BY country_id ) 
            ex_old_whole_year 
            on c.id = ex_old_whole_year.country_id
            left join ( select SUM( weight )/1000 ex_old_weight , country_id from imp_exp_tamojs where mode = 'ЭК' AND date between '2019-01-01' AND '2019-04-01' GROUP BY country_id ) 
            ex_old_year 
            on c.id = ex_old_year.country_id
            left join ( select SUM( weight )/1000 ex_new_weight , country_id from imp_exp_tamojs where mode = 'ЭК' AND date between '2020-01-01' AND '2020-04-01' GROUP BY country_id ) 
            ex_new_year 
            on c.id = ex_new_year.country_id
            left join ( select SUM( weight )/1000 imp_old_whole_weight , country_id from imp_exp_tamojs where mode = 'ИМ' AND date between '2019-01-01' AND '2019-12-31' GROUP BY country_id ) 
            imp_old_whole_year 
            on c.id = imp_old_whole_year.country_id
            left join ( select SUM( weight )/1000 imp_old_weight , country_id from imp_exp_tamojs where mode = 'ИМ' AND date between '2019-01-01' AND '2019-04-01' GROUP BY country_id ) 
            imp_old_year 
            on c.id = imp_old_year.country_id
            left join ( select SUM( weight )/1000 imp_new_weight , country_id from imp_exp_tamojs where mode = 'ИМ' AND date between '2020-01-01' AND '2020-04-01' GROUP BY country_id ) 
            imp_new_year 
            on c.id = imp_new_year.country_id
            WHERE ex_old_whole_year.ex_old_whole_weight is not null OR 
            ex_new_year.ex_new_weight is not null OR  
            ex_old_year.ex_old_weight is not null OR  
            imp_old_whole_year.imp_old_whole_weight is not null OR 
            imp_new_year.imp_new_weight is not null OR  
            imp_old_year.imp_old_weight is not null");
        
        $result = [];
        foreach ($data as $key => $d) {
            $result[] = [
                "city" => $d->name,
                "import" => [
                  "year" => $d->imp_old_whole_weight,
                  "lastYear" => $d->imp_old_weight,
                  "currentYear" => $d->imp_new_weight,
                  "tempUp" => $d->imp_percantage
                ],
                "export" => [
                  "year" => $d->ex_old_whole_weight,
                  "lastYear" => $d->ex_old_weight,
                  "currentYear" => $d->ex_new_weight,
                  "tempUp" => $d->ex_percantage
                ],
            ];
        }
        $time_elapsed_secs = microtime(true) - $start;
        return response()->json(['success' => true, 'result' => $result,'time_elapsed_secs' => $time_elapsed_secs]);
    }

    public function second(Request $request)
    {
        $countries = Country::all();
        $codegroup = CodeGroup::pluck('name','id');
        $result = [];
        $data = DB::select("select max(c.id) as c_id,max(c.name) as c_name,sum(rs.weight / 1000) as total,max(rs.name) as code_name,rs.id as code_id from countries c 
            left join ( select code.id,code.name,ie.country_id,ie.weight from code_groups code 
            left join imp_exp_tamojs ie on ie.code_group_id = code.id ) rs on rs.country_id = c.id group by c.id, rs.id");

        foreach ($data as $key => $d) {
            if(!empty($codegroup[$d->code_id])){
                $result[$codegroup[$d->code_id]][$d->c_name] = $d;
            }
        }

        $count_countries = [];

        foreach ($result as $key => $res) {
            $total = 0;
            $count_c = 0;
            foreach ($res as $k => $r) {
                $total += $r->total;
                $count_c ++;
            }
            $result[$key]['TOTAL'] = $total;
            $count_countries[] = $count_c;
        }

        return response()->json(['success' => true,'count' => count($result),'count_countries' => $count_countries, 'result' => $result]);
    }
}
