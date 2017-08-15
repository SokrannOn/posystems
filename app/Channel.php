<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table='channels';
    protected $fillable = ['name','description','user_id','created_at','updated_at'];
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
