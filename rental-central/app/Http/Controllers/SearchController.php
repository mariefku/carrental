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
        $destination_id = $opt['destination_id'];
        $result = [];

        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search',  [
                    'json' => [
                        'rental_id' => $rental->id,
                        'model_name' => $model_name,
                        'destination_id' => $destination_id,
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
        $destination_id = $opt['destination_id'];
        $result = [];

        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search2',  [
                    'json' => [
                        'rental_id' => $rental->id,
                        'model_name' => $model_name,
                        'destination_id' => $destination_id,
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

    public function searchCar(Request $request)
    {
        $model_name = $request->model_name;
        if ($model_name == null)
            $model_name = [];
        $destination_id = $request->destination_id;
        $opt = [];
        $items = $this->fetchAll([
            "destination_id" => $destination_id,
            "model_name" => $model_name,
        ]);
        $datas = $this->fetchAll2([
            "destination_id" => $destination_id,
            "model_name" => $model_name,
        ]); 

        \Session::flash('data', $datas);

        return view('search.search')
            ->with('items', $items)
            ->with('model_name', $model_name)
            ->with('destination_id', $destination_id)
            ->with('start_date', \Carbon\Carbon::now()->format('d/m/Y'))
            ->with('end_date', \Carbon\Carbon::now()->addDay(1)->format('d/m/Y'));
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

