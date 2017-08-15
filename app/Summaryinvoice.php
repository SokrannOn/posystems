<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summaryinvoice extends Model
{
    //

    public function purchaseorders()
    {
    	return $this->belongsToMany(Purchaseorder::class);
    }
    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
