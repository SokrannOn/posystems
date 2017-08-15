<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';
    protected $fillable = ['name'];
    public function commune()
    {
        return $this->belongsTo('App\Commune');
    }
 	public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
