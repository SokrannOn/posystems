<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable = ['name','description','user_id','created_at','updated_at'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
