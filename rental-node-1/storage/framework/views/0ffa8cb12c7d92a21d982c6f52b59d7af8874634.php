<?php $__env->startSection('content'); ?>
  <h3>
    <a href="<?php echo e(action('CarController@listItem')); ?>">Car Model</a> | Add Item
  </h3>
  <div class="row">
    <?php echo Form::open([
        'role' => 'form',
        'url' => action('CarController@createItem'),
        'method' => 'post',
        'files' => true,
      ]); ?>


<?php 
  function generateRandomString($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
 ?>

    <?php echo $__env->make('form.text', [
      'field' => 'plate_number',
      'label' => 'Plate Number',
      'placeholder' => 'plate number',
      'default' => generateRandomString(rand(1,2)).' '.rand(1000,9999).' '.generateRandomString(rand(2,3)),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.select', [
      'field' => 'carmodel_id',
      'label' => 'Model',
      'options' => App\Carmodel::all()->map(function($val) {
        $val->_full_name = "{$val->brand} {$val->model} {$val->transmission} {$val->fuel}";
        return $val;
      })->pluck("_full_name", "id"),
      'default' => old('carmodel_id'),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.text', [
      'field' => 'year',
      'label' => 'Year',
      'placeholder' => 'year',
      'default' => old('year'),
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.file', [
      'field' => 'img',
      'label' => 'Car Photo',
      'default' => '',
      'attributes' => [
        'id' => 'img'
      ],
      'showimg_id' => '1'
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!--
    <?php echo $__env->make('form.file', [
      'field' => 'img[2]',
      'label' => 'Car Photo',
      'default' => '',
      'attributes' => [
        'id' => 'img_2'
      ],
      'showimg_id' => '2'
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.file', [
      'field' => 'img[3]',
      'label' => 'Car Photo',
      'default' => '',
      'attributes' => [
        'id' => 'img_3'
      ],
      'showimg_id' => '3'
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('form.file', [
      'field' => 'img[4]',
      'label' => 'Car Photo',
      'default' => '',
      'attributes' => [
        'id' => 'img_4'
      ],
      'showimg_id' => '4'
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    -->

    <div class="form-group">
      <label class="control-label">
        Harga
      </label>
      <div class="container">
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[Semarang]',
          'label' => 'Semarang',
          'default' => 500000,

        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[Solo]',
          'label' => 'Solo',
          'default' => 500000,

        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[Jepara]',
          'label' => 'Jepara',
          'default' => 500000,

        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[Yogyakarta]',
          'label' => 'Yogyakarta',
          'default' => 500000,

        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('form.text', [ 
          'field' => 'prices[Jakarta]',
          'label' => 'Jakarta',
          'default' => 500000,

        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    <?php echo Form::close(); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content.js'); ?>
<script>
  function readURL(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#showimage_'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#showimage_1").hide();

  $("#img").change(function(){
      readURL(this,1);
      $("#showimage_1").show();
  });

  /*
  $("#img_2").change(function(){
      readURL(this,2);
      $("#showimage_2").show();
  });

  $("#img_3").change(function(){
      readURL(this,3);
      $("#showimage_3").show();
  });

  $("#img_4").change(function(){
      readURL(this,4);
      $("#showimage_4").show();
  });
  */

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>