<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;
use App\Rental;

class RentalController extends Controller
{    
    public function listItem(Request $request)
    { 
        $items = Rental::all();

        return view('rental.list')->with('items', $items);
    }

    public function createForm()
    {
        return view('rental.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
            'lat' => 'required',
            'lng' => 'required',
            'telp' => 'required',           
        ]);

        $item = new Rental();
        $item->fill($request->input());
        $item->save();

        return redirect()->action('RentalController@listItem');
    }

    public function updateForm($id)
    {
        $item = Rental::find($id);
        return view('rental.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
            'lat' => 'required',
            'lng' => 'required',
            'telp' => 'required',     
        ]);

        $item = Rental::find($id);
        $item->fill($request->input());
        $item->save();

        return redirect()->action('RentalController@updateItem', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        $item = Rental::find($id);
        $item->delete();

        return redirect()->action('RentalController@listItem');
    }

    public function datatable(Request $request)
    {
        return Datatables::eloquent(Rental::query())->make(true);
    }

    public function apiListItem(Request $request)
    {
        return response()->json(Rental::all());
    }

    public function apiShowItem(Request $request, $id)
    {
        return response()->json(Rental::find($id));
    }
}
