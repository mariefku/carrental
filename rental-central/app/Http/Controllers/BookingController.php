<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Booking;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

use App\Notifications\BookingConfirmed;
use App\Notifications;
use App\Mail\SendMail;
use Mail;
use PDF;

class BookingController extends Controller
{
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
        if ($rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('GET', $rental->url . '/api/getCarImage?car_id='.$items->car_id);
                
                $status = $res->getStatusCode();
                if($status == 200){
                    $result = $res->getBody();
                }else{
                    throw new \Exception('<span style="color:red;"><strong>Failed Server Respond!!</strong></span>');
                }
            } catch (Exception $e) {
                dd($e);
            }

            $result_img = json_decode($result);
        }

        return view('booking.detail')->with('items', $items)->with('img_url',$result_img);
    }

    public function viewConfirmed()
    {
        $timestamp = Carbon::now('Asia/Jakarta')->timestamp;
        $kode_booking = Booking::pluck('kode_booking')->toArray();

        // Generate a new unique number
        do {
            $randnum = '#'.rand(1000000, 9999999).$timestamp;
        } while (in_array($randnum, $kode_booking));

        $newkode_booking = $randnum;

        return view('booking.confirmed')->with('newkode_booking',$newkode_booking);
    }

    public function viewItem(Request $request)
    {
        $databooks = $request;
        return view('booking.view')->with('databooks', $databooks);
    }

    public function createForm(Request $request)
    {
        $databooks = $request;
        return view('booking.create')->with('databooks', $databooks);
    }

    public function confirmItem(Request $request)
    {
        $this->validate($request, [          
            'id' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'carmodel_id' => 'required',
            'plate_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'transmission' => 'required',
            'fuel' => 'required',
            'car_id' => 'required',
            'destination' => 'required',
            'price' => 'required',
            'year' => 'required',
            'rental_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',

            'noktp' => 'required',
            'alamat' => 'required',
            
        ]);

        $items = $request;

        $filename = $request->filename;

        if( $request->hasFile('fotoktp') && $request->file('fotoktp')->isValid() ) {
            $filename = $request->fotoktp->hashName();
            $destinationPath = storage_path().'/app/public/uploads/';
            $img = $request->fotoktp;
            $img->move($destinationPath, $img->hashName());
        }


        return view('booking.confirm')->with('items', $items)->with('filename', $filename);
    }

    public function updateItem(Request $request)
    {
        $this->validate($request, [          
            'id' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'carmodel_id' => 'required',
            'plate_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'transmission' => 'required',
            'fuel' => 'required',
            'car_id' => 'required',
            'destination' => 'required',
            'price' => 'required',
            'year' => 'required',
            'rental_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',

            'noktp' => 'required',
            'alamat' => 'required',
            'filename' => 'required',
        ]);

        $databooks = $request;

        return view('booking.update')->with('databooks', $databooks);
    }

    public function storeItem(Request $request)
    {

        $rules = array(          
            'id' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'carmodel_id' => 'required',
            'plate_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'transmission' => 'required',
            'fuel' => 'required',
            'car_id' => 'required',
            'destination' => 'required',
            'price' => 'required',
            'year' => 'required',
            'rental_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',

            'noktp' => 'required',
            'alamat' => 'required',
            'filename' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            
        );

        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()){
            $items = $request;
            $filename = $request->filename;
            return view('booking.confirm')->with('items', $items)->with('filename',$filename)->withErrors($validator);
        }
        else{

            $check = Booking::where('car_id', $request->car_id)
                            ->where('date_rent', $request->start_date)
                            ->where('date_return', $request->end_date)
                            ->get();

            if(count($check) > 0){
                $error = 'Mobil Tidak tersedia atau telah dibooking, silahkan cari hari/tanggal lain';
                return redirect()->action('SearchController@searchForm')->with('error',$error);
            }else{

                /* GENERATE BOOKING KODE */
                $timestamp = Carbon::now('Asia/Jakarta')->timestamp;
                $kode_booking = Booking::pluck('kode_booking')->toArray();

                // Generate a new unique number
                do {
                    $randnum = '#'.rand(1000000, 9999999).$timestamp;
                } while (in_array($randnum, $kode_booking));

                $newkode_booking = $randnum;
                /* END GENERATE KODE */

                /* CASE ON MONTH NAME */
                if ($request->bulan == 'Januari') {
                    $request->bulan = 1;
                }
                elseif ($request->bulan == 'Februari') {
                    $request->bulan = 2;
                }
                elseif ($request->bulan == 'Maret') {
                    $request->bulan = 3;
                }
                elseif ($request->bulan == 'April') {
                    $request->bulan = 4;
                }
                elseif ($request->bulan == 'Mei') {
                    $request->bulan = 5;
                }
                elseif ($request->bulan == 'Juni') {
                    $request->bulan = 6;
                }
                elseif ($request->bulan == 'Juli') {
                    $request->bulan = 7;
                }
                elseif ($request->bulan == 'Agustus') {
                    $request->bulan = 8;
                }
                elseif ($request->bulan == 'September') {
                    $request->bulan = 9;
                }
                elseif ($request->bulan == 'Oktober') {
                    $request->bulan = 10;
                }
                elseif ($request->bulan == 'November') {
                    $request->bulan = 11;
                }
                elseif ($request->bulan == 'Desember') {
                    $request->bulan = 12;
                }
                /* END CASE ON MONTH NAME */

                //Send API Booking
                $res = $this->api_book($request,$newkode_booking);
                if ($res == 200) {

                    //Generate PDF
                    $pdf     = PDF::loadView('pdf.booking',[
                                                'data' => $request,
                                                'kode_booking' => $newkode_booking
                                            ])
                                    ->setPaper('a5', 'landscape')
                                    ->setWarnings(false)
                                    ->save('storage/bookings-pdf/booking-'.$newkode_booking.'.pdf');

                    /* SAVE DATABASE */
                    $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->tanggal.'/'.$request->bulan.'/'.$request->tahun);
                    
                    $item = new Booking();
                    $item->kode_booking     = $newkode_booking;
                    $item->rental_id        = $request->rental_id;
                    $item->nama             = $request->nama;
                    $item->nohp             = $request->nohp;
                    $item->email            = $request->email;
                    $item->tanggal_lahir    = $tanggal_lahir->toDateString();
                    $item->alamat           = $request->alamat;
                    $item->noktp            = $request->noktp;
                    $item->fotoktp          = $request->filename;
                    $item->car_id           = $request->car_id;
                    $item->brand            = $request->brand;
                    $item->model            = $request->model;
                    $item->transmission     = $request->transmission;
                    $item->fuel             = $request->fuel;
                    $item->destination      = $request->destination;
                    $item->price            = $request->price;
                    $item->year             = $request->year;
                    $item->date_rent        = $request->start_date;
                    $item->date_return      = $request->end_date;
                    $item->status           = '1';
                    $item->save();
                    /* END SAVE DATABASE */

                    if ($item) {
                        //Send email to Guest who booking a car
                        Mail::to($request->email)->send(new SendMail($request,$newkode_booking));

                        //Send email to notify Admin if there is new order
                        $user = \App\User::first();
                        $user->notify(new BookingConfirmed($request,$newkode_booking));

                        //Request as item
                        $items = $request;

                        return view('booking.confirmed')
                                ->with('items',$items)
                                ->with('newkode_booking',$newkode_booking)
                                ->with('response',$res);
                    }else{
                        $error = 'Mobil Tidak tersedia atau telah dibooking, silahkan cari hari/tanggal lain';
                        return redirect()->action('SearchController@searchForm')->with('error',$error);
                    }
                }else{
                    $error = 'Mobil Tidak tersedia atau telah dibooking, silahkan cari hari/tanggal lain';
                    return redirect()->action('SearchController@searchForm')->with('error',$error);
                }           
            }
        }
    }

    public function viewPDF($kode_booking){
        $addmins = strtotime('+30 minutes');
        $cache_expires = date('D, d M Y H:i:s \G\M\T',$addmins);

        $filename = 'booking-#'.$kode_booking.'.pdf';
        $path = storage_path() . '/app/public/bookings-pdf/'.$filename;

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
            'Expires' => $cache_expires
        ]);
    }

    protected function api_book($request,$kode_booking)
    {
        $item = $request;
        $tanggal_lahir = \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal.'/'.$item->bulan.'/'.$item->tahun);

        
        $rental = \App\Rental::find($item->rental_id);    
        $result = '<span style="color:red;"><strong>Failed !!</strong></span>';    
        if ($rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/booking',  [
                    'json' => [
                        "kode_booking" => $kode_booking,

                        "nama" => $item->nama,
                        "nohp" => $item->nohp,
                        "email" => $item->email,
                        "tanggal_lahir" => $tanggal_lahir->toDateString(),
                        "noktp" => $item->noktp,
                        "alamat" => $item->alamat,
                        "fotoktp" => $item->filename,

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
                        "destination" => $item->destination,
                        "price" => $item->price,
                        "year" => $item->year,
                        "start_date" => $item->start_date,
                        "end_date" => $item->end_date
                        
                    ]
                ]);

                $status = $res->getStatusCode();
                if($status == 200){
                    $result = $res->getStatusCode();
                }else{
                    throw new \Exception('<span style="color:red;"><strong>Failed Server Respond!!</strong></span>');
                }

            }
            catch (RequestException $e) {
                if ($e->hasResponse()) {
                   $result = 500;
                }else{
                   $result = 500;
                }
                return $result;
            }
        }

        return $result;
    }

}

