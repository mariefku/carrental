<?php $__env->startSection('content'); ?>
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
        <th>Action</th>
        <th>Status</th>
      </tr>
    </thead>
  </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content.js'); ?>
<script>
$('#booking').addClass('active');

$('#itemTable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": <?php echo json_encode(action("BookingController@newItem")); ?> + "/all",
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
          return datatableDetail(<?php echo json_encode(action("BookingController@newItem")); ?> + "/" + data.kode_booking.replace("#", "") + "/detail")
        }
      },
      { 
        "sortable": false,
        "data": function(data) {
          if(data.status == '1'){
            return '<i class="fa fa-exclamation" aria-hidden="true"></i> NEW';
          }else if(data.status == '2'){
            return '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> CONFIRMED';
          }else if(data.status == '3'){
            return '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> REJECTED';
          }else if(data.status == '4'){
            return '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> CANCELED';
          }
        }
      }
    ],
    "createdRow": function( row, data, dataIndex ) {
      if ( data.status == "1" ) {
        $(row).addClass( 'info' );
      }else if( data.status == "2" ){
        $(row).addClass( 'success' );
      }else if( data.status == "3" ){
        $(row).addClass( 'danger' );
      }else if( data.status == "4" ){
        $(row).addClass( 'warning' );
      }
    },
    "columnDefs": [
      {
        "targets": 8,
        "createdCell": function (td, cellData, rowData, row, col) {
          if ( cellData == '<i class="fa fa-exclamation" aria-hidden="true"></i> NEW' ) {
            $(td).addClass('text-center').css({
                                              "background": "#446CB3",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }else if( cellData == '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> CONFIRMED' ){
            $(td).addClass('text-center').css({
                                              "background": "#16a085",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }else if( cellData == '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> REJECTED' ){
            $(td).addClass('text-center').css({
                                              "background": "#96281B",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }else if( cellData == '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> CANCELED' ){
            $(td).addClass('text-center').css({
                                              "background": "#D35400",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }

        }
      },
      { "width": "12%", "targets": 8 },
      { "width": "20%", "targets": 2 }
    ]
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>