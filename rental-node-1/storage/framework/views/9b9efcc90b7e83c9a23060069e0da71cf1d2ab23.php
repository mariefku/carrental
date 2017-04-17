<?php $__env->startSection('content'); ?>
  <h3>Booking List</h3>
  <table class="table table-striped table-bordered" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Model</th>
        <th>Brand</th>
        <th>Destination</th>
        <th>Price</th>
        <th>Transmission</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content.js'); ?>
<script>
$('#itemTable').DataTable( {
    "ajax": {
        "url": <?php echo json_encode(action("BookingController@listItem")); ?> + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "model"},
      {"data": "brand"},
      {"data": "destination_id"},
      {"data": "price"},
      {"data": "transmission"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableEdit(<?php echo json_encode(action("CarController@listItem")); ?> + "/" + data.id + "/update") +
                  datatableDelete(<?php echo json_encode(action("CarController@listItem")); ?> + "/" + data.id + "/delete")
        }
      }
    ]
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>