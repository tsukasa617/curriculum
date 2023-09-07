<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Trader_contract_conclusion extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = array('id');
}
