<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table='suppliers';
    protected $fillable = ['companyname','address','personname','contactperson','email','user_id','created_at','updated_at'];

    public function imports(){
        return $this->hasMany(Import::class);
    }
}
