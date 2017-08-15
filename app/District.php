<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name'];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
