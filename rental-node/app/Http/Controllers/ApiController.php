<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Carmodel;
use App\Car;

class ApiController extends Controller
{
    public function apiSearch(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination_id = $request->destination_id;
    	
    	if ($model_name) {
    		$car = Car::getQuery();
    		$car->join('carmodels', function ($join){
		            $join->on('cars.carmodel_id', '=', 'carmodels.id');
		        })
	    		->join('car_prices', function ($join) use ($destination_id){
			            $join->on('cars.id', '=', 'car_prices.car_id')
			            ->where('car_prices.destination_id', '=', $destination_id);
			        })
			 
	         ->where('carmodels.brand', 'like', '%' . $model_name . '%')
     		 ->orWhere('carmodels.model', 'like', '%' . $model_name . '%')
	         ;

	         return response()->json($car->get());
    	}
        
        return response()->json([]);
    }

    public function apiSearch2(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination_id = $request->destination_id;
    	
    	if ($model_name) {
    		$car =  Car::getQuery();
    		$car->join('carmodels', function ($join){
		            $join->on('cars.carmodel_id', '=', 'carmodels.id');
		        })
	    		->join('car_prices', function ($join) use ($destination_id){
			            $join->on('cars.id', '=', 'car_prices.car_id')
			            ->where('car_prices.destination_id', '=', $destination_id);
			        })
			 
	         ->where('carmodels.brand', 'like', '%' . $model_name . '%')
     		 ->orWhere('carmodels.model', 'like', '%' . $model_name . '%')
	         ;

	        $data = $car->get()->mapWithKeys(function ($val) {
        		return [$val->id => $val];
  		      });


	        $data->data = collect($data)->map(function ($val) use ($data) {
	        	$val->id = $data[$val->id]->id;
	        	$val->brand = $data[$val->id]->brand;
	        	$val->carmodel = $data[$val->id]->model;
	        	$val->transmission = $data[$val->id]->transmission;
	        	$val->fuel = $data[$val->id]->fuel;

	        	return $val;
	        });


        	return response()->json($data);
    	}

        return response()->json([]);
    }
}
