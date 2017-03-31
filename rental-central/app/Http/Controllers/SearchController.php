<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rental;
use Exception;

class SearchController extends Controller
{


    protected function fetchAll($opt)
    {

        $model_name = $opt['model_name'];
        $destination = $opt['destination'];
        $result = [];

        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search',  [
                    'json' => [
                        'rental_id' => $rental->id,
                        'model_name' => $model_name,
                        'destination' => $destination,
                    ]
                ]);
            } catch (Exception $e) {
                continue;
            }
            if ($res->getStatusCode() != 200)
                continue;
            $result = array_merge($result, json_decode($res->getBody()));
        }


        return $result;
    }

    protected function fetchAll2($opt)
    {

        $model_name = $opt['model_name'];
        $destination = $opt['destination'];
        $start_date = $opt['start_date'];
        $end_date = $opt['end_date'];
        $result = [];

        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search3',  [
                    'json' => [
                        'rental_id' => $rental->id,
                        'model_name' => $model_name,
                        'destination' => $destination,
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ]
                ]);
            } catch (Exception $e) {
                continue;
            }
            if ($res->getStatusCode() != 200)
                continue;
            $result = json_decode($res->getBody());
        }


        return $result;
    }

    public function searchForm()
    {
        return view('search.search');
    }

    public function searchCar(Request $request)
    {

        $this->validate($request, [
            'model_name' => 'required',
        ]);

        $model_name = $request->model_name;
        if ($model_name == null)
            $model_name = [];
        $destination = $request->destination;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $opt = [];

        $items = $this->fetchAll([
            "destination" => $destination,
            "model_name" => $model_name,
        ]);
        
        $datas = $this->fetchAll2([
            "destination" => $destination,
            "model_name" => $model_name,
            "start_date" => $start_date,
            "end_date" => $end_date,
        ]); 

        \Session::flash('data', $datas);

        return view('search.result')
            ->with('items', $items)
            ->with('model_name', $model_name)
            ->with('destination', $destination);
    }

    public function datatable(Request $request)
    {

        $items = session('data');
        $data['data'] = $items;
        return response()->json($data);
    }

    public function book($id_r, $id_c, $id_d)
    {
        $rental = Rental::find($id_r);
        $id_cars = $id_c;
        $destination_id = $id_d;
        $result = [];

        if ($rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/booking',  [
                    'json' => [
                        'id_cars' => $id_cars,
                        'destination_id' => $destination_id
                        //'tanggal_pinjam' => $tanggal_pinjam,
                        //'tanggal_kembali' => $tanggal_kembali,
                    ]
                ]);
            } catch (Exception $e) {
                $e->getMessage();
            }

            if ($res->getStatusCode() != 200)
            $res->getStatusCode();

            $result = $res->getBody();
        }

        return $result;
    }

}

