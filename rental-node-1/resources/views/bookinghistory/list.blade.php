@extends('layout.admin')

@section('content')
  <h3>Booking History</h3>

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
        <th>Status</th>
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
        "url": {!! json_encode(action("BookingHistoryController@listItem")) !!} + "/datatable",
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
      {"data": function(data) {
          if(data.status == '1'){
            return '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ACTIVE';
          }else{
            return '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> REJECTED';
          }
        }
      }
    ],
    "createdRow": function( row, data, dataIndex ) {
      if ( data.status == "0" ) {
        $(row).addClass( 'danger' );
      }
    },
    "columnDefs": [
      {
        "targets": 7,
        "createdCell": function (td, cellData, rowData, row, col) {
          if ( cellData == '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ACTIVE' ) {
            $(td).addClass('text-center').css({
                                              "background": "#16a085",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }else{
            $(td).addClass('text-center').css({
                                              "background": "#c0392b",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }
        }
      },
    ]
} );
</script>
@endsection