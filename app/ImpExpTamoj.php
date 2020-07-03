<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpExpTamoj extends Model
{
    protected $fillable = [
        'mode',
        'date',
        'vedcode',
        'product',
        'country_code',
        'code_group_id',
        'country_id',
        'country_name',
        'transport_type',
        'transport_country_code',
        'weight',
        'cost'
    ];
}
