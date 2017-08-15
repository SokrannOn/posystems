<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';
    protected $fillable = ['name'];
    public function district()
    {
        return $this->belongsTo(District::class);
    }
	public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
