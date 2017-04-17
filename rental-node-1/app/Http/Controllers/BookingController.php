<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Facades\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\BookingHistory;
use App\Car;
use App\Carmodel;
use App\CarPrice;

class BookingController extends Controller
{
    public function allItem(Request $request)
    { 
        return view('booking.all-list');
    }

    public function newItem(Request $request)
    { 
        return view('booking.new-list');
    }

    public function confirmedItem(Request $request)
    { 
        return view('booking.confirmed-list');
    }

    public function rejectedItem(Request $request)
    { 
        return view('booking.rejected-list');
    }

    public function canceledItem(Request $request)
    { 
        return view('booking.canceled-list');
    }

    public function DTallItem(Request $request)
    {
        return Datatables::eloquent(Booking::query())->make(true);
    }

    public function DTnewItem(Request $request)
    {
        return Datatables::eloquent(Booking::where('status','1'))->make(true);
    }

    public function DTconfirmedItem(Request $request)
    { 
        return Datatables::eloquent(Booking::where('status','2'))->make(true);
    }

    public function DTrejectedItem(Request $request)
    { 
        return Datatables::eloquent(Booking::where('status','3'))->make(true);
    }

    public function DTcanceledItem(Request $request)
    { 
        return Datatables::eloquent(Booking::where('status','4'))->make(true);
    }

    public function confirmItem($id)
    {
        $item = Booking::find($id);
        $item->status = '2';
        $item->save();

        return redirect()->action('BookingController@newItem');
    }

    public function rejectItem($id)
    {
        $item = Booking::find($id);
        $item->status = '3';
        $item->save();

        return redirect()->action('BookingController@newItem');
    }

    public function cancelItem($id)
    {
        $item = Booking::find($id);
        $item->status = '4';
        $item->save();

        return redirect()->action('BookingController@newItem');
    }

    public function detailItem($kode_booking)
    { 
        $items = Booking::where('kode_booking', '=' , '#'.$kode_booking)->firstOrFail();

        return view('booking.detail')->with('items', $items);
    }
}
