<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function listItem(Request $request)
    { 
        $items = Booking::all();

        return view('booking.list')->with('items', $items);
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

            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $items = $request;
        return view('booking.confirm')->with('items', $items);
    }

    public function storeItem(Request $request)
    {

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
            $request->bulan = 1;
        }
        elseif ($request->bulan == 'Desember') {
            $request->bulan = 12;
        }

        $tanggal_lahir = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal.'/'.$request->bulan.'/'.$request->tahun);
        
        $item = new Booking();
        $item->rental_id = $request->rental_id;
        $item->nama = $request->nama;
        $item->nohp = $request->nohp;
        $item->email = $request->email;
        $item->tanggal_lahir = $tanggal_lahir->toDateString();
        $item->car_id = $request->car_id;
        $item->brand = $request->brand;
        $item->model = $request->model;
        $item->transmission = $request->transmission;
        $item->fuel = $request->fuel;
        $item->destination = $request->destination;
        $item->price = $request->price;
        $item->year = $request->year;
        $item->save();

        $local = '<strong> Local Save = </strong> <span style="color:red;"><strong>Failed !!</strong></span>';
        if ($item) {
            $local = '<strong> Local Save = </strong> <span style="color:green;"><strong>Success !!</strong></span>';
        }
         
        $res = $this->api_book($request);


        //$rental = App\Rental::find($item->rental_id);
        //$api_suceess = 'Node '.$rental->url.' Save Success';

        return $local.' <br><strong> API Booking = </strong>'.$res;
    }

    protected function api_book($request)
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
                        "nama" => $item->nama,
                        "nohp" => $item->nohp,
                        "email" => $item->email,
                        "tanggal_lahir" => $tanggal_lahir->toDateString(),
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
                        "year" => $item->year
                    ]
                ]);

                $status = $res->getStatusCode();
                if($status == 200){
                    $result = $res->getBody();
                }else{
                    throw new \Exception('<span style="color:red;"><strong>Failed Server Respond!!</strong></span>');
                }

            }
            catch (RequestException $e) {
                if ($e->hasResponse()) {
               $result = '<span style="color:red;"><strong>Failed Respond Server Tidak Dapat Dihubungi!!</strong></span>
                            <br>
                            <br>'.
                            Psr7\str($e->getResponse());
                }else{

                $result = '<span style="color:red;"><strong>Fatal Error Server Not Found!!</strong></span>
                            <br>
                            <br>'.
                            Psr7\str($e->getRequest());
                }
                return $result;

            }

           
        }

        return $result;
    }

}

