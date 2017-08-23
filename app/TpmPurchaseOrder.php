<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpmPurchaseOrder extends Model
{
    
    protected $table='tmppurchaseoders';
    protected $fillable = ['product_id','qty','unitPrice','amount','user_id','created_at','updated_at'];
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
