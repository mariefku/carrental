<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;


class CarmodelController extends Controller
{    
    public function listItem(Request $request)
    { 
        $items = Carmodel::all();

        return view('carmodel.list')->with('items', $items);
    }

    public function createForm()
    {
        return view('carmodel.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'model' => 'required',
        ]);

        $item = new Carmodel();
        $item->fill($request->input());
        $item->save();

        return redirect()->action('CarmodelController@listItem');
    }

    public function updateForm($id)
    {
        $item = Carmodel::find($id);
        return view('carmodel.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'brand' => 'required',
            'model' => 'required',
            'transmission' => 'required|in:AT,MT',
            'fuel' => 'required',
        ]);

        $item = Carmodel::find($id);
        $item->fill($request->input());
        $item->save();

        return redirect()->action('CarmodelController@updateItem', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        $item = Carmodel::find($id);
        $item->delete();

        return redirect()->action('CarmodelController@listItem');
    }

    public function datatable(Request $request)
    {
        return Datatables::eloquent(Carmodel::query())->make(true);
    }

    public function apiListItem(Request $request)
    {
        return response()->json(Carmodel::all());
    }

    public function apiShowItem(Request $request, $id)
    {
        return response()->json(Carmodel::find($id));
    }
}
