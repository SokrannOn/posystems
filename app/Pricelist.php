<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $table='pricelists';
    protected $fillable = ['product_id','fobprice','margin','landingprice','sellingprice','startdate','enddate'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
