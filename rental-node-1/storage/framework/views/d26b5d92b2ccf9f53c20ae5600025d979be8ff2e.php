<?php $__env->startSection('content'); ?>
  <h3>
    <a href="<?php echo e(action('CarController@listItem')); ?>">Item</a>
    | #<?php echo e($item->id); ?>

    | Edit
  </h3>
    <div class="row">
    <?php echo Form::open([
        'role' => 'form',
        'url' => action('CarController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ]); ?>


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

    <div class="form-group">
      <label class="control-label">
        Harga
      </label>
      <div class="container">
      <?php $__currentLoopData = App\Destination::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[' . $destination->id . ']',
          'label' => $destination->name,
          'default' => $item->priceTo($destination->id)->price,
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    <?php echo Form::close(); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>