@extends('layout.admin')

@section('content.fullpage')
  <h3>Booking List</h3>

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
        <th>Rental</th>
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
        "url": {!! json_encode(action("BookingController@listItem")) !!} + "/datatable",
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
      {"data": "name"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableDetail({!! json_encode(action("BookingController@listItem")) !!} + "/" + data.kode_booking.replace("#", "") + "/detail")
        }
      }
    ]
} );
</script>
@endsection