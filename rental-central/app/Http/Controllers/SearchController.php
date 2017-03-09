<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rental;
use App\Carmodel;
use Exception;

class SearchController extends Controller
{
    protected function fetchAll($opt)
    {
        $model_id = Carmodel::modelName($opt["model_name"])->get()->pluck('id');

        $result = [];
        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search/',  [
                    'json' => [
                        'carmodel_id' => $model_id,
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
        return view('search.search')
            ->with('items', $items)
            ->with('model_name', $model_name)
            ->with('destination_id', $destination_id)
            ->with('start_date', \Carbon\Carbon::now()->format('d/m/Y'))
            ->with('end_date', \Carbon\Carbon::now()->addDay(1)->format('d/m/Y'));
    }
}
