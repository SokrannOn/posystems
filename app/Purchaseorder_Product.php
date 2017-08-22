<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder_Product extends Model
{
    protected $table='purchaseorder_product';
    protected $fillable = ['product_id','qty','unitPrice','amount','user_id','created_at','updated_at'];
}