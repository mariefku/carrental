<?php $__env->startSection('content'); ?>
  <h3>Car Model List</h3>
  <div class="list-main-btn">
    <div class="row">
      <div class="col-sm-4">
        <a href="<?php echo e(action('CarController@createForm')); ?>" class="btn btn-success">Add Item</a>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nopol</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Transmission</th>
        <th>Fuel</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content.js'); ?>
<script>
$('#itemTable').DataTable( {
    "ajax": {
        "url": <?php echo json_encode(action("CarController@listItem")); ?> + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "plate_number"},
      {"data": "carmodel_brand"},
      {"data": "carmodel_model"},
      {"data": "carmodel_transmission"},
      {"data": "carmodel_fuel"},
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