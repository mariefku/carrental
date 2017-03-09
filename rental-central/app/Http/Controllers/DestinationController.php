<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;
use App\Destination;

class DestinationController extends Controller
{    
    public function listItem(Request $request)
    { 
        $items = Destination::all();

        return view('destination.list')->with('items', $items);
    }

    public function createForm()
    {
        return view('destination.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $item = new Destination();
        $item->fill($request->input());
        $item->save();

        return redirect()->action('DestinationController@listItem');
    }

    public function updateForm($id)
    {
        $item = Destination::find($id);
        return view('destination.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $item = Destination::find($id);
        $item->fill($request->input());
        $item->save();

        return redirect()->action('DestinationController@updateItem', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        $item = Destination::find($id);
        $item->delete();

        return redirect()->action('DestinationController@listItem');
    }

    public function datatable(Request $request)
    {
        return Datatables::eloquent(Destination::query())->make(true);
    }

    public function apiListItem(Request $request)
    {
        return response()->json(Destination::all());
    }

    public function apiShowItem(Request $request, $id)
    {
        return response()->json(Destination::find($id));
    }
}
