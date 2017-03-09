<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class ApiController extends Controller
{
    public function apiSearch(Request $request)
    {
    	$carmodel_id = $request->carmodel_id;

    	$car = Car::getQuery();

    	if ($carmodel_id) {
    		$car->whereIn('carmodel_id', $carmodel_id);
    	}

        return response()->json($car->get());
    }
}
