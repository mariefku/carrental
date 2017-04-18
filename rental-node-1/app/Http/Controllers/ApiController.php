<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Carmodel;
use App\Car;
use App\Booking;
use App\CarImage;

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
    		$car =  Car::getQuery();
    		$car->select('cars.*','carmodels.*','car_prices.*','cars.id as idmobil')
    			->whereNotIn('cars.id', function($query) use ($start_date,$end_date){
	    		  	$query->select('bookings.car_id')
					      ->distinct()
					      ->from('bookings')
	        			  ->join('cars', function ($join){
				        	$join->on('bookings.car_id', '=', 'cars.id');
				          })
				          ->where( function ($query) {
						        $query->where('bookings.status', '1')
						              ->orWhere('bookings.status', '2');
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
						    "img_url" => $item->img,
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
    		$check = Booking::where('car_id', $request->car_id)
                            ->where('date_rent', $request->start_date)
                            ->where('date_return', $request->end_date)
                            ->get();

            if(count($check) > 0){
                abort(500, 'Server Error. Data already Exist');
            }else{
	    		//Save to table Booking
		        $booking = new Booking();

				$booking->kode_booking = $request->kode_booking;

		        $booking->nama = $request->nama;
		        $booking->nohp = $request->nohp;
		        $booking->email = $request->email;
		        $booking->tanggal_lahir = $request->tanggal_lahir;
		        $booking->noktp = $request->noktp;
		        $booking->alamat = $request->alamat;
		        $booking->fotoktp = $request->fotoktp;

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

		        $booking->status = '1';

		        $booking->save();

		        return response('<span style="color:green;"><strong>Success from node-1 !!<strong></span>');
	        }
    	}

        abort(500, 'Server Error. Data already Exist');
    }

    public function apiGetCarImage(Request $request) {
		$car_id = $request->car_id;
    	
    	if ($car_id) {
    		$car = Car::where('id', '=', $car_id)->pluck('img');		
	        return response()->json($car);
    	}

        return response()->json([]);
    }

    public function apiGetStatus(Request $request) {
		$kode_booking = $request->kode_booking;
    	
    	if ($kode_booking) {
    		$status = Booking::where('kode_booking', '=', '#'.$kode_booking)->pluck('status');		
	        return response()->json($status);
    	}

        return response()->json([]);
    }
}
