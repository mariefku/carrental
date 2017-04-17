<?php $__env->startSection('content'); ?>
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
        "url": <?php echo json_encode(action("BookingController@listItem")); ?> + "/datatable",
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
          return datatableDetail(<?php echo json_encode(action("BookingController@listItem")); ?> + "/" + data.id +        "/update") +
                 datatableConfirm(<?php echo json_encode(action("BookingController@listItem")); ?> + "/" + data.id + "/confirm") +
                 datatableReject(<?php echo json_encode(action("BookingController@listItem")); ?> + "/" + data.id + "/reject")
        }
      }
    ]
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>