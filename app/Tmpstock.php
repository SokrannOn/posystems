<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tmpstock extends Model
{
    protected $table = 'tmpstocks';
    protected $fillable=['product_id', 'qty', 'amount', 'mfd','expd'];


    public function  product(){
        return $this->belongsTo(Product::class);
    }
}
