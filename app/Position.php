<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table='positions';
    protected $fillable = ['name','description','user_id','created_at','updated_at'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
