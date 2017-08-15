<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';
    protected $fillable = ['name','contactNo','email','homeNo','streetNo','village_id','district_id','commune_id','province_id','location','channel_id','user_id'];
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function village()
    {
    	return $this->belongsTo('App\Village');
    }
    public function purchaseorders()
    {
        return $this->hasMany(Purchaseorder::class);
    }
}