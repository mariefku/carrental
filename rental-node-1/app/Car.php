<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function prices()
    {
    	return $this->hasMany('App\CarPrice');
    }

    public function model()
    {
        return $this->belongsTo('App\Carmodel');
    }

    public function priceTo($dest_id)
    {
        $ret = $this->prices()->where('destination_id', '=', $dest_id)->first();
        if ($ret == null)
            return new CarPrice();
        
        return $ret;
    }
}
