<?php $__env->startSection('content'); ?>
  <h3 class="text-danger">Rejected Booking List</h3>
  
  <hr style="border-top: 1px solid #d9534f;">
  
  <a href="<?php echo e(action('BookingController@newItem')); ?>" style="text-decoration: none;"> <button class="btn btn-primary">Incoming Bookings</button> </a>
  <a href="<?php echo e(action('BookingController@confirmedItem')); ?>" style="text-decoration: none;"> <button class="btn btn-success">Confirmed Bookings</button> </a>
  <a href="<?php echo e(action('BookingController@rejectedItem')); ?>" style="text-decoration: none;"> <button class="btn btn-danger">Rejected Bookings</button> </a>
  <a href="<?php echo e(action('BookingController@canceledItem')); ?>" style="text-decoration: none;"> <button class="btn btn-warning">Canceled Bookings</button> </a>
  
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content.js'); ?>
<script>
$('#booking').addClass('active');

$('#itemTable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": <?php echo json_encode(action("BookingController@newItem")); ?> + "/rejected",
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
      }
    ]
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>