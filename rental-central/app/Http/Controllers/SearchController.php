<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rental;
use Exception;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class SearchController extends Controller
{
    public function searchForm()
    {
        return view('search.search');
    }

    public function searchCar(Request $request)
    {

        $this->validate($request, [
            'model_name' => 'required',
            'destination' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $model_name = $request->model_name;
        if ($model_name == null)
            $model_name = [];
        $destination = $request->destination;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $opt = [];
        
        $datas = $this->fetchAll([
            "destination" => $destination,
            "model_name" => $model_name,
            "start_date" => $start_date,
            "end_date" => $end_date,
        ]); 


        usort($datas, function($a, $b)
        {
            return strcmp($a->price, $b->price);
        });

        $page = $request->page;

        if ($request->page == null) {
            $page = 1;
        }
        
        $pager = $this->myPagination($datas,$page);

        $date1 = strtotime($start_date); // or your date as well
        $date2 = strtotime($end_date);
        $datediff = $date2 - $date1;
        $numberofdays = floor($datediff / (60 * 60 * 24)) + 1;

        // \Session::flash('data', $datas);

        return view('search.result')
               ->with('model_name', $model_name)
               ->with('destination', $destination)
               ->with('numberofdays', $numberofdays)
               ->with('pager',$pager);
    }

    protected function fetchAll($opt)
    {

        $model_name = $opt['model_name'];
        $destination = $opt['destination'];
        $start_date = $opt['start_date'];
        $end_date = $opt['end_date'];
        $result = [];

        foreach(Rental::all() as $rental) {
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', $rental->url . '/api/search',  [
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

            $result = array_merge( $result , json_decode($res->getBody()) );
        }

        return $result;
    }

    protected function myPagination($array,$page)
    {
        $perPage = 5; // Get the current page or default to 1, this is what you miss!
        $offset = ($page * $perPage) - $perPage;

        $pagination = new LengthAwarePaginator(
                        array_slice($array, $offset, $perPage, true), //the data and its slicing
                        count($array),  //total data
                        $perPage,       //how much data per page
                        $page,          //the current page
                        ['path' => Paginator::resolveCurrentPath()] //resolve the path
                      );

        return $pagination;
    }

}

