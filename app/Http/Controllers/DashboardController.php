<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attestat;
use App\User;
use \DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        if(!empty($params['date_from']) && !empty($params['date_to'])){
          $date_from = $params['date_from'];
          $date_to = $params['date_to'];
        }else{
          $date_from = date('Y-01-d');
          $date_to = date('Y-m-d');
        }
        $data_vedcode = DB::select("select code.name,code.code,coalesce(total_weight) as total_weight,
          coalesce(total_cost) as total_cost,
          coalesce(im_total_cost) as im_total_cost,
          coalesce(im_eks_total_cost) as im_eks_total_cost,
          coalesce(ek_total_weight) as ek_total_weight,
          coalesce(im_total_weight) as im_total_weight
          from code_groups as code
          left join (select code_group_id, sum(weight / 1000) as total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          group by code_group_id) as im on code.code::int = im.code_group_id
          left join (select code_group_id, sum(cost / 1000) as total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          group by code_group_id) as ir on code.code::int = ir.code_group_id

          left join (select code_group_id, sum(cost / 1000) as im_total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ИМ'
          group by code_group_id) as im_t on code.code::int = im_t.code_group_id

          left join (select code_group_id, sum(cost / 1000) as im_eks_total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ЭК'
          group by code_group_id) as im_eks_t on code.code::int = im_eks_t.code_group_id


          left join (select code_group_id, sum(weight / 1000) as ek_total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ЭК'
          group by code_group_id) as ek_t on code.code::int = ek_t.code_group_id

          left join (select code_group_id, sum(weight / 1000) as im_total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ИМ'
          group by code_group_id) as import_t on code.code::int = import_t.code_group_id");

        $data_country = DB::select("select c.name,c.id,coalesce(total_weight) as total_weight,
          coalesce(total_cost) as total_cost,
          coalesce(im_total_cost) as im_total_cost,
          coalesce(im_eks_total_cost) as im_eks_total_cost,
          coalesce(ek_total_weight) as ek_total_weight,
          coalesce(im_total_weight) as im_total_weight
          from countries as c
          left join (select country_id, sum(weight / 1000) as total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          group by country_id) as im on c.id = im.country_id
          left join (select country_id, sum(cost / 1000) as total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          group by country_id) as ir on c.id = ir.country_id

          left join (select country_id, sum(cost / 1000) as im_total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ИМ'
          group by country_id) as im_t on c.id = im_t.country_id

          left join (select country_id, sum(cost / 1000) as im_eks_total_cost from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ЭК'
          group by country_id) as im_eks_t on c.id = im_eks_t.country_id


          left join (select country_id, sum(weight / 1000) as ek_total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ЭК'
          group by country_id) as ek_t on c.id = ek_t.country_id

          left join (select country_id, sum(weight / 1000) as im_total_weight from imp_exp_tamojs where date between '$date_from' and '$date_to'
          and mode='ИМ'
          group by country_id) as import_t on c.id = import_t.country_id");
        $result = [
          'data_vedcode' => $data_vedcode,
          'data_country' => $data_country,
        ];
        return response()->json(['success' => true, 'result' => $result]);
    }
}
