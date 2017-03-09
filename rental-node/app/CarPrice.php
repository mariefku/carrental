<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarPrice extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function car()
    {
    	return $this->belongsTo('App\Car');
    }
}
