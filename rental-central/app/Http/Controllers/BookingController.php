<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Booking;


class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listItem(Request $request)
    { 
        $items = Booking::all();

        return view('booking.list')->with('items', $items);
    }

    public function datatable(Request $request)
    {
        $booking =  Booking::query();
        $booking->select('bookings.*','rentals.name')
                ->join('rentals', function ($join){
                    $join->on('rentals.id', '=', 'bookings.rental_id');
                });
        return Datatables::eloquent($booking)->make(true);
    }

    public function detailItem($kode_booking)
    { 
        $items = Booking::where('kode_booking', '=' , '#'.$kode_booking)->firstOrFail();

        //GET CAR IMAGE
        $rental = \App\Rental::find($items->rental_id);
        $result_img = [];
        $status = [];
        if ($rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('GET', $rental->url . '/api/getCarImage?car_id='.$items->car_id);
                $res2 = $client->request('GET', $rental->url . '/api/getStatus?kode_booking='.$kode_booking);

                $status = $res->getStatusCode();
                $status2 = $res->getStatusCode();
                if($status == 200 && $status2 == 200){
                    $result = $res->getBody();
                    $result2 = $res2->getBody();
                }else{
                    throw new \Exception('<span style="color:red;"><strong>Failed Server Respond!!</strong></span>');
                }
            } catch (Exception $e) {
                dd($e);
            }

            $result_img = json_decode($result);
            $status = json_decode($result2);
        }

        foreach ($status as $status) {

            if ($status == "1"){
                $status = "NEW BOOKING";
            }elseif ($status == "2") {
                $status = "CONFIRMED";
            }elseif ($status == "3") {
                $status = "REJECTED";
            }elseif ($status == "4") {
                $status = "CANCELED";
            }else{
                $status = "";
            }

        }

        if ($status == null){
            $status = "";
        }


        return view('booking.detail')->with('items', $items)->with('img',$result_img)->with('status',$status);
    }



}

