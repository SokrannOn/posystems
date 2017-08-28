<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    protected $table='purchaseorders';
    protected $fillable = ['poDate','totalAmount','discount','customer_id','isGenerate','user_id','created_at','updated_at'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function products()
    {
    	return $this->belongsToMany('App\Product','purchaseorder_product')->withPivot('qty','unitPrice','amount','user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function summaryinvioces()
    {
        return $this->belongsToMany(Summaryinvioce::class);
    }

    public function stockouts(){
        return $this->hasOne(Stockout::class);
    }
}
