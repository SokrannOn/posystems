<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table='products';
    protected $fillable = ['product_code','product_barcode','name','description','unitPrice','category_id','user_id','created_at','updated_at'];
    public function purchaseorders()
    {
        return $this->belongsToMany('App\Purchaseorder','purchaseorder_product')->pivot('product_id','unitPrice','qty','amount','user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tmpPurchaseOrders()
    {
        return $this->hasMany(TmpPurchaseOrder::class);
    }
    public function tmpEditPurchaseOrders()
    {
        return $this->hasMany(TpmEditPurchaseOrder::class);
    }
    public function pricelists()
    {
        return $this->hasMany(Pricelist::class);
    }
    public  function imports(){
        return $this->belongsToMany(Import::class,'import_product','importId','productId')->withTimestamps()->withPivot('qty', 'landingPrice', 'mfd', 'expd');
    }
    public function histories(){
        return $this->hasMany(History::class,'productId', 'id');
    }

    public  function subimports(){
        return $this->belongsToMany(Product::class,'subimport_product','subimport_id','product_id')->withTimestamps()->withPivot('qty','mfd', 'expd');
    }
}