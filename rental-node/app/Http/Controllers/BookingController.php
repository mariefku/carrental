<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\Car;
use App\Carmodel;
use App\CarPrice;

class BookingController extends Controller
{
    public function listItem(Request $request)
    { 
        $items = Booking::all();

        return view('booking.list')->with('items', $items);
    }

    public function datatable(Request $request)
    {
		$car = Booking::getQuery();
		$car->join('cars', function ($join){
	            $join->on('bookings.car_id', '=', 'cars.id');
	        })
    		->join('carmodels', function ($join){
	            $join->on('cars.carmodel_id', '=', 'carmodels.id');
	        })
     		->leftjoin('car_prices', function ($join){
	            $join->on('bookings.car_id', '=', 'car_prices.car_id')
	            ->where('car_prices.destination_id', "=" , 'bookings.destination_id');
	        })
	        ->select('bookings.*','cars.*','carmodels.*','car_prices.price as price_now','bookings.id as idbooking')  
	        ;



         $items = $car->get();
         foreach ($items as $item) {
         	$newarray[] = array(
	         			"id" => $item->idbooking,
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
         				);
         }

         $data['data'] = $newarray;

         return response()->json($data);

    }    
}
