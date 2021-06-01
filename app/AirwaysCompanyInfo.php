<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\AirwaysCompany;

class AirwaysCompanyInfo extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "airways_company_id",
        "address",
        "year",
        "fleet_size",
        "call_name",
        "destination_qty",
    ];

    public function airways_company(){
        return $this->belongsTo(AirwaysCompany::class,"airways_company_id");
    }
}
