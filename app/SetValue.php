<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetValue extends Model
{
    protected $table='setvalues';
    protected $fillable = ['name','value','status','description','user_id','created_at','updated_at'];
}
