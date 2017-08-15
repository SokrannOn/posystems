<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table='zones';
    protected $fillable = ['name','description','user_id','created_at','updated_at'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
