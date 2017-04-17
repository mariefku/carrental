<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;
use App\Car;
use App\Carmodel;

class CarController extends Controller
{    
    public function listItem(Request $request)
    { 
        $items = Car::all();

        return view('car.list')->with('items', $items);
    }

    public function createForm()
    {
        return view('car.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'carmodel_id' => 'required',
            'plate_number' => 'required',
            'prices' => 'required',
            'year' => 'required',
        ]);

        $item = new Car();
        $item->fill($request->except("prices","img"));
        $item->img = url('/storage/uploads/'.$request->img->hashName());
        $item->save();
        $item->prices()->createMany(array_values(collect($request->prices)->map(function ($val, $key) {
            return [
                "destination" => $key,
                "price" => $val,
            ];
        })->toArray()));

        if( $request->hasFile('img') ) {
            $destinationPath = storage_path().'/app/public/uploads/';
            $img = $request->img;
            $img->move($destinationPath, $img->hashName());
        }

        return redirect()->action('CarController@listItem');
    }

    public function updateForm($id)
    {
        $item = Car::find($id);
        return view('car.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'carmodel_id' => 'required',
            'plate_number' => 'required',
            'prices' => 'required',
        ]);

        $item = Car::find($id);
        $item->fill($request->except("prices"));
        $item->save();
        $item->prices()->delete();
        $item->prices()->createMany(array_values(collect($request->prices)->map(function ($val, $key) {
            return [
                "destination" => $key,
                "price" => strlen($val) == 0 ? 0 : $val,
            ];
        })->toArray()));

        return redirect()->action('CarController@updateItem', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        $item = Car::find($id);
        $item->delete();

        return redirect()->action('CarController@listItem');
    }

    public function datatable(Request $request)
    {
        $response = Datatables::eloquent(Car::query())->make(true);
        $data = $response->getData();
        $carmodel = Carmodel::all()->mapWithKeys(function ($val) {
        	return [$val->id => $val];
        });

        $data->data = collect($data->data)->map(function ($val) use ($carmodel) {
        	$val->carmodel_brand = $carmodel[$val->carmodel_id]->brand;
        	$val->carmodel_model = $carmodel[$val->carmodel_id]->model;
        	$val->carmodel_transmission = $carmodel[$val->carmodel_id]->transmission;
        	$val->carmodel_fuel = $carmodel[$val->carmodel_id]->fuel;

        	return $val;
        });

        return response()->json($data);
    }

    public function apiListItem(Request $request)
    {
        return response()->json(Car::all());
    }

    public function apiShowItem(Request $request, $id)
    {
        return response()->json(Car::find($id));
    }
}
