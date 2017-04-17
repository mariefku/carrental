<?php $__env->startSection('content'); ?>

  <h3>
    <a href="<?php echo e(action('CarController@listItem')); ?>">Item</a>
    | #<?php echo e($item->id); ?>

    | Edit
  </h3>
  <br><br>
    <div class="row">
    <?php echo Form::open([
        'role' => 'form',
        'url' => action('CarController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ]); ?>


    <?php 
      $ischecked = false;
      if ($item->status == '1')
      $ischecked = true;
     ?>

    <div class="form-group col-sm-12">
      <label class="control-label">
        Is The Car Available?
      </label>
      <br>
      <div class="col-sm-2 alert" style="color: #fff;margin: 0px;" id="status_wrapper">
        <div class="col-sm-7">
          <input type="hidden" name="status" value="0">
          <label class="switch" style="margin: 0;vertical-align: middle;">
            <?php echo e(Form::checkbox('status', 1, $ischecked,['id' => 'status_val'])); ?>

            <div class="slider round" id="switch"></div>
          </label>

        </div>
        <?php if($item->status == '1'): ?>
          <div class="col-sm-5" style="padding-left: 0;">
            <h3 style="margin:0;font-weight: bold;" id='status'>YES</h3>
          </div>
        <?php else: ?>
          <div class="col-sm-5" style="padding-left: 0;">
            <h3 style="margin:0;font-weight: bold;" id='status'>NO</h3>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php echo $__env->make('form.text', [
      'field' => 'plate_number',
      'label' => 'Plate Number',
      'placeholder' => 'plate number',
      'default' => old('plate_number', $item->plate_number),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.select', [
      'field' => 'carmodel_id',
      'label' => 'Model',
      'options' => App\Carmodel::all()->map(function($val) {
        $val->_full_name = "{$val->brand} {$val->model} {$val->transmission} {$val->fuel}";
        return $val;
      })->pluck("_full_name", "id"),
      'default' => old('carmodel_id', $item->carmodel_id),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="form-group col-sm-12">
      <label class="control-label">
        Harga
      </label>
      <div class="container">
      <?php $__currentLoopData = App\CarPrice::all()->where('car_id',$item->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carprice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[' . $carprice->destination . ']',
          'label' => $carprice->destination,
          'default' => old('price', $carprice->price),
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <div class="form-group col-sm-12">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    <?php echo Form::close(); ?>

  </div>

  <script>
    $(document).ready(function() {
      var checkBoxes = $("input[name=status]");
      var status_wrapper = $("#status_wrapper");

      $("#switch").click(function() {
          var status = $("#status");
          if(checkBoxes.is(':checked')){
            status.html('NO');
            status_wrapper.css('background-color','#c0392b');
          }else{
            status.html('YES');
            status_wrapper.css('background-color','#16a085');
          }
      });

      if(checkBoxes.is(':checked')){
        status_wrapper.css('background-color','#16a085');
      }else{
        status_wrapper.css('background-color','#c0392b');
      }

    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>