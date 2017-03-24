<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function price()
    {
    	return $this->belongsTo('App\CarPrice');
    }

    public function model()
    {
        return $this->belongsTo('App\Carmodel');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}
