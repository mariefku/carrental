<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Carmodel;
use App\Car;
use App\Booking;

class ApiController extends Controller
{
    public function apiSearch(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination_id = $request->destination_id;
    	$rental_id	= $request->rental_id;
    	
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

	         $items = $car->get();
	         foreach ($items as $item) {
	         	$newarray[] = array(
		         			"id" => $item->id,
						    "created_at"  => $item->created_at,
						    "updated_at" => $item->updated_at,
						    "carmodel_id" => $item->carmodel_id,
						    "plate_number" => $item->plate_number,
						    "brand" => $item->brand,
						    "model" => $item->model,
						    "transmission" => $item->transmission,
						    "fuel" => $item->fuel,
						    "car_id" => $item->car_id,
						    "destination_id" => $item->destination_id,
						    "price" => $item->price,
						    "year" => $item->year,
						    "rental_id" => intval($rental_id),
	         				);
	         }

	         return response()->json($newarray);
    	}
        
        return response()->json([]);
    }

    public function apiSearch2(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination = $request->destination;
    	$rental_id	= $request->rental_id;
    	
    	if ($model_name) {
    		$car =  Car::getQuery();
    		$car->join('carmodels', function ($join){
		            $join->on('cars.carmodel_id', '=', 'carmodels.id');
		        })
	    		->join('car_prices', function ($join) use ($destination){
			            $join->on('cars.id', '=', 'car_prices.car_id')
			            ->where('car_prices.destination', '=', $destination);
			        })
			 ->select('cars.*','carmodels.*','car_prices.*','cars.id as idmobil')
	         ->where('carmodels.brand', 'like', '%' . $model_name . '%')
     		 ->orWhere('carmodels.model', 'like', '%' . $model_name . '%')
	         ;

	         $items = $car->get();
	         foreach ($items as $item) {
	         	$newarray[] = array(
		         			"id" => $item->idmobil,
						    "created_at"  => $item->created_at,
						    "updated_at" => $item->updated_at,
						    "carmodel_id" => $item->carmodel_id,
						    "plate_number" => $item->plate_number,
						    "brand" => $item->brand,
						    "model" => $item->model,
						    "transmission" => $item->transmission,
						    "fuel" => $item->fuel,
						    "car_id" => $item->car_id,
						    "destination" => $item->destination,
						    "price" => $item->price,
						    "year" => $item->year,
						    "rental_id" => intval($rental_id),
	         				);
	         }
	         return response()->json($newarray);


    	}

        return response()->json([]);
    }

    public function apiSearch3(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination = $request->destination;
    	$rental_id	= $request->rental_id;
    	$start_date	= $request->start_date;
    	$end_date	= $request->end_date;
    	
    	if ($model_name) {
    		$car =  Car::getQuery();
    		$car->select('cars.*','carmodels.*','car_prices.*','cars.id as idmobil')
    			->whereNotIn('cars.id', function($query) use ($start_date,$end_date){
	    		  	$query->select('bookings.car_id')
					      ->distinct()
					      ->from('bookings')
	        			  ->join('cars', function ($join){
				        	$join->on('bookings.car_id', '=', 'cars.id');
				          })
					      ->where('bookings.date_rent', '<=' , $end_date)
					      ->where('bookings.date_return', '>=' , $start_date);
				})
    			->join('carmodels', function ($join){
		            $join->on('cars.carmodel_id', '=', 'carmodels.id');
	        	})
	    		->join('car_prices', function ($join) use ($destination){
		            $join->on('cars.id', '=', 'car_prices.car_id')
			             ->where('car_prices.destination', '=', $destination);
		        })
				->where( function ($query) use ($model_name){
			        $query->where('carmodels.brand', 'like', '%' . $model_name . '%')
			              ->orWhere('carmodels.model', 'like', '%' . $model_name . '%');
			    })
				->where('cars.status', '=', '1');
			    ;
	     		

	         $items = $car->get();
	         foreach ($items as $item) {
	         	$newarray[] = array(
		         			"id" => $item->idmobil,
						    "created_at"  => $item->created_at,
						    "updated_at" => $item->updated_at,
						    "carmodel_id" => $item->carmodel_id,
						    "plate_number" => $item->plate_number,
						    "brand" => $item->brand,
						    "model" => $item->model,
						    "transmission" => $item->transmission,
						    "fuel" => $item->fuel,
						    "car_id" => $item->car_id,
						    "destination" => $item->destination,
						    "price" => $item->price,
						    "year" => $item->year,
						    "rental_id" => intval($rental_id),
					    	"start_date" => $start_date,
					    	"end_date" => $end_date,
	         				);
	         }
	         return response()->json($newarray);


    	}

        return response()->json([]);
    }


    public function apiBooking(Request $request)
    {

    	if ($request) {
	        $booking = new Booking();
	        $booking->nama = $request->nama;
	        $booking->nohp = $request->nohp;
	        $booking->email = $request->email;
	        $booking->tanggal_lahir = $request->tanggal_lahir;
	        $booking->car_id = $request->car_id;
	        $booking->brand = $request->brand;
	        $booking->model = $request->model;
	        $booking->transmission = $request->transmission;
	        $booking->fuel = $request->fuel;
	        $booking->destination = $request->destination;
	        $booking->price = $request->price;
	        $booking->year = $request->year;
	        $booking->date_rent = $request->start_date;
	        $booking->date_return = $request->end_date;
	        $booking->save();

	         return response('<span style="color:green;"><strong>Success from node-1 !!<strong></span>');

    	}

        return response('<span style="color:red;"><strong>Failed from node-1 !!<strong></span>');
    }
}
