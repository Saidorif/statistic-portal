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
        DB::enableQueryLog();
        $data_vedcode = DB::select("select code.name,code.code,coalesce(total_weight) as total_weight,
          coalesce(total_cost) as total_cost,
          coalesce(im_total_cost) as im_total_cost,
          coalesce(im_eks_total_cost) as im_eks_total_cost,
          coalesce(ek_total_weight) as ek_total_weight,
          coalesce(im_total_weight) as im_total_weight
          from code_groups as code
          left join (select code_group_id, sum(weight / 1000) as total_weight from imp_exp_tamojs
          group by code_group_id) as im on code.code::int = im.code_group_id
          left join (select code_group_id, sum(cost / 1000) as total_cost from imp_exp_tamojs
          group by code_group_id) as ir on code.code::int = ir.code_group_id

          left join (select code_group_id, sum(cost / 1000) as im_total_cost from imp_exp_tamojs
          where mode='ИМ'
          group by code_group_id) as im_t on code.code::int = im_t.code_group_id

          left join (select code_group_id, sum(cost / 1000) as im_eks_total_cost from imp_exp_tamojs
          where mode='ЭК'
          group by code_group_id) as im_eks_t on code.code::int = im_eks_t.code_group_id


          left join (select code_group_id, sum(weight / 1000) as ek_total_weight from imp_exp_tamojs
          where mode='ЭК'
          group by code_group_id) as ek_t on code.code::int = ek_t.code_group_id

          left join (select code_group_id, sum(weight / 1000) as im_total_weight from imp_exp_tamojs
          where mode='ИМ'
          group by code_group_id) as import_t on code.code::int = import_t.code_group_id");
        $result = [
          'data_vedcode' => $data_vedcode
        ];
        return response()->json(['success' => true, 'result' => $result]);
    }
}
