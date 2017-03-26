<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   protected $guarded = ['id', 'created_at', 'updated_at'];
}
