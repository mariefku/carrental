<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeModelName($query, $names)
    {
        if (count($names) == 0)
            return $query;

        return $query->where(function ($q) use ($names) {
            foreach($names as $name) {
                $q = $q->orWhere('model', 'LIKE', "%$name%");
            };

            return $q;
        });
    }
}
