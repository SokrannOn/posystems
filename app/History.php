<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable=['importId','productId','qty','landingPrice','mfd','expd'];

    public function import(){
        return $this->belongsTo(Import::class,'importId','id');
    }
    public function products(){
        return $this->belongsTo(Product::class,'productId','id');
    }
}
