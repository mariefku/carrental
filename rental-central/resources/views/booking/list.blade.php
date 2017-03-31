@extends('layout.admin')

@section('content')
  <h3>Booking List</h3>

  <table class="table table-striped table-bordered table-hover" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Email</th>
        <th>No. Telepon/HP</th>
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
        "url": {!! json_encode(action("BookingController@listItem")) !!} + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "nama"},
      {"data": "tanggal_lahir"},
      {"data": "email"},
      {"data": "nohp"},
      {"data": "destination"},
      {"data": "date_rent"},
      {"data": "date_return"},
      {"data": "price"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableDetail({!! json_encode(action("BookingController@listItem")) !!} + "/" + data.id + "/update")
        }
      }
    ]
} );
</script>
@endsection