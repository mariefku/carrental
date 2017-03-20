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
        var_dump(session('data'));

        return view('search.search')
            ->with('items', $items)
            ->with('model_name', $model_name)
            ->with('destination_id', $destination_id)
            ->with('start_date', \Carbon\Carbon::now()->format('d/m/Y'))
            ->with('end_date', \Carbon\Carbon::now()->addDay(1)->format('d/m/Y'));
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


    public function datatable(Request $request)
    {

        $items = session('data');
        $jsonArray = array();
        foreach ($items as $item) {
            $item = array($item);
            $jsonArray = array_merge($jsonArray,$item);
        }
        $data['data'] = $jsonArray;
           return response()->json($data);
    }
}

