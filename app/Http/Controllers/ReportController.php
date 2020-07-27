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
