<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;

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

    public function createForm()
    {
        return view('booking.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nohp' => 'required|number',
            'email' => 'required|email',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $item = new Booking();
        $item->fill($request->input());
        $item->save();

        return redirect()->action('BookingController@listItem');
    }

    public function updateForm($id)
    {
        $item = Booking::find($id);
        return view('booking.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $item = Booking::find($id);
        $item->fill($request->input());
        $item->save();

        return redirect()->action('BookingController@updateItem', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        $item = Booking::find($id);
        $item->delete();

        return redirect()->action('BookingController@listItem');
    }

    public function datatable(Request $request)
    {
        return Datatables::eloquent(Booking::query())->make(true);
    }

    public function apiListItem(Request $request)
    {
        return response()->json(Booking::all());
    }

    public function apiShowItem(Request $request, $id)
    {
        return response()->json(Booking::find($id));
    }
}
