<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpmEditPurchaseOrder extends Model
{
    protected $table='tmpeditpurchaseorders';
    public $timestamps = false;

    protected $fillable = ['product_id','qty','unitPrice','amount','user_id'];
}
