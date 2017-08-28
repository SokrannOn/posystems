<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subimport extends Model
{
    //

    public  function products(){
        return $this->belongsToMany(Product::class,'subimport_product','subimport_id','product_id')->withTimestamps()->withPivot('qty','mfd', 'expd');
    }
}
