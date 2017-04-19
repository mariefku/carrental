<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{

    public function apiSearch(Request $request)
    {
    	$model_name = $request->model_name;
    	$destination = $request->destination;
    	$rental_id	= $request->rental_id;
    	$start_date	= $request->start_date;
    	$end_date	= $request->end_date;
    	
    	if ($model_name) {
    		$car =  DB::table('cars');
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
	         $newarray  = [];
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
						    "img" => $item->img,
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
    		DB::table('bookings')->insert([
				'kode_booking' 	=> $request->kode_booking,

		        'nama' 			=> $request->nama,
		        'nohp' 			=> $request->nohp,
		        'email' 		=> $request->email,
		        'tanggal_lahir' => $request->tanggal_lahir,
		        'noktp' 		=> $request->noktp,
		        'alamat' 		=> $request->alamat,
		        'fotoktp' 		=> $request->fotoktp,

		        'car_id' 		=> $request->car_id,
		        'brand' 		=> $request->brand,
		        'model' 		=> $request->model,
		        'transmission' 	=> $request->transmission,
		        'fuel' 			=> $request->fuel,
		        'destination' 	=> $request->destination,
		        'price' 		=> $request->price,
		        'year' 			=> $request->year,
		        'date_rent' 	=> $request->start_date,
		        'date_return' 	=> $request->end_date,

		        'status' 		=> '1'
		    ]);
	       
	         return response('<span style="color:green;"><strong>Success from node-1 !!<strong></span>');

    	}

        return response('<span style="color:red;"><strong>Failed from node-1 !!<strong></span>');
    }

    public function apiGetCarImage(Request $request) {
		$car_id = $request->car_id;
    	
    	if ($car_id) {
    		$car = Car::where('id', '=', $car_id)->pluck('img');		
	        return response()->json($car);
    	}

        return response()->json([]);
    }
}
