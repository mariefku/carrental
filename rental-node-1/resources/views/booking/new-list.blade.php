@extends('layout.admin')

@section('content')
  <h3 class="text-info">New Booking List</h3>
  
  <hr style="border-top: 1px solid #337ab7;">

  <a href="{{ action('BookingController@newItem') }}" style="text-decoration: none;"> <button class="btn btn-primary">Incoming Bookings</button> </a>
  <a href="{{ action('BookingController@confirmedItem') }}" style="text-decoration: none;"> <button class="btn btn-success">Confirmed Bookings</button> </a>
  <a href="{{ action('BookingController@rejectedItem') }}" style="text-decoration: none;"> <button class="btn btn-danger">Rejected Bookings</button> </a>
  <a href="{{ action('BookingController@canceledItem') }}" style="text-decoration: none;"> <button class="btn btn-warning">Canceled Bookings</button> </a>
  
  <hr>

  <table class="table table-striped table-bordered table-hover" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Kode Booking</th>
        <th>Nama</th>
        <th>Tujuan</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah Pembayaran</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
@endsection

@section('content.js')
<script>
$('#booking').addClass('active');

$('#itemTable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": {!! json_encode(action("BookingController@newItem")) !!} + "/new",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "kode_booking"},
      {"data": "nama"},
      {"data": "destination"},
      {"data": "date_rent"},
      {"data": "date_return"},
      {"data": "price"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableDetail({!! json_encode(action("BookingController@newItem")) !!} + "/" + data.kode_booking.replace("#", "") + "/detail") +
                 datatableConfirm({!! json_encode(action("BookingController@newItem")) !!} + "/" + data.id + "/confirm") +
                 datatableReject({!! json_encode(action("BookingController@newItem")) !!} + "/" + data.id + "/reject")
        }
      }
    ],
    "columnDefs": [
      { "width": "20%", "targets": 7 }
    ]
} );
</script>
@endsection