<?php $__env->startSection('content'); ?>
  <h3>
    <a href="<?php echo e(action('CarmodelController@listItem')); ?>">Item</a>
    | #<?php echo e($item->id); ?>

    | Edit
  </h3>
    <div class="row">
    <?php echo Form::open([
        'role' => 'form',
        'url' => action('CarmodelController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ]); ?>


    <?php echo $__env->make('form.text', [
      'field' => 'brand',
      'label' => 'Brand',
      'placeholder' => 'car brand',
      'default' => old('brand', $item->brand),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.text', [
      'field' => 'model',
      'label' => 'Model',
      'placeholder' => 'car model',
      'default' => old('model', $item->model),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.select', [
      'field' => 'transmission',
      'label' => 'Transmission',
      'options' => [
        'MT' => 'Manual Transmission',
        'AT' => 'Automatic Transmission',
      ],
      'default' => old('transmission', $item->transmission),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.select', [
      'field' => 'fuel',
      'label' => 'Fuel',
      'options' => [
        'Premium' => 'Premium',
        'Pertamax' => 'Pertamax',
        'Solar' => 'Solar',
      ],
      'default' => old('fuel', $item->fuel),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    <?php echo Form::close(); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>