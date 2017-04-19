<?php $__env->startSection('content'); ?>
<!-- style>

.row .block {
    float: left;
    width: 25%;
    height: 150px;
}
.hovicon {
    display: inline-block;
    font-size: 45px;
    line-height: 90px;
    cursor: pointer;
    margin: 20px;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    text-align: center;
    position: relative;
    text-decoration: none;
    z-index: 1;
    color: #000;
}
.hovicon.small {
    font-size: 20px;
    line-height:45px;
    width:45px;
    height:45px;
    margin:7px;
}
.hovicon.mini {
    font-size: 15px;
    line-height:32px;
    width:30px;
    height:30px;
    margin:7px;
}
.hovicon.auto-width {
    width: auto;
    height: auto;
    padding: 15px;
}
.hovicon:after {
    pointer-events: none;
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    content:'';
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
}
.hovicon:before {
    speak: none;
    font-size: 48px;
    line-height: 90px;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    display: block;
    -webkit-font-smoothing: antialiased;
}
/* Effect 1 */
 .hovicon.effect-1 {
    background: rgba(000, 000, 000, 0.1);
    -webkit-transition: background 0.2s, color 0.2s;
    -moz-transition: background 0.2s, color 0.2s;
    transition: background 0.2s, color 0.2s;
}
.hovicon.effect-1:after {
    top: -7px;
    left: -7px;
    padding: 7px;
    box-shadow: 0 0 0 4px #009688;
    -webkit-transition: -webkit-transform 0.2s, opacity 0.2s;
    -webkit-transform: scale(.8);
    -moz-transition: -moz-transform 0.2s, opacity 0.2s;
    -moz-transform: scale(.8);
    -ms-transform: scale(.8);
    transition: transform 0.2s, opacity 0.2s;
    transform: scale(.8);
    opacity: 0;
}
/* Effect 1a */
 .hovicon.effect-1.sub-a:hover {
    background: #009688;
    color: #fff;
}
.hovicon.effect-1.sub-a:hover i {
    color: #fff;
}
.hovicon.effect-1.sub-a:hover:after {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    opacity: 1;
}

</style -->

  <div class="col-sm-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Data Pemesanan</h3>
      </div>
      <div class="panel-body">
      <form action="" class="form-horizontal">

          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" value="<?php echo e(old('nama', $items->nama)); ?>" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Nomor Telepon/HP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="" value="<?php echo e(old('nohp', $items->nohp)); ?>" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Alamat Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" value="<?php echo e(old('email', $items->email)); ?>" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal_lahir" value="<?php echo e($items->tanggal_lahir); ?>" required readonly>
            </div>
          </div>

           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Nomor KTP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal_lahir" value="<?php echo e($items->noktp); ?>" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" rows="3" id="tanggal_lahir" style="padding-left: 12px; " required readonly><?php echo e($items->alamat); ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Foto KTP</label>
            <div class="col-sm-10">
              <img src="http://localhost/github/rental-central/public/<?php echo e($items->fotoktp); ?>/getPhoto" alt="" style="width: 50%;">
            </div>
          </div>   

        </form>
      </div>
    </div>
  </div>

  <div class="col-sm-4" style="padding: 0px;">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Booking Info</h3>
      </div>
      <div class="panel-body">

          <div class="col-sm-12">
            <h3 style="margin-bottom: 2px;"><?php echo e($items-> brand); ?> <?php echo e($items-> model); ?></h3>
            <span style="font-style: italic;"><?php echo e(\App\Car::find($items->car_id)->plate_number); ?></span>
            <div class="col-sm-12">
              <img src="<?php echo e(route('car.getPhoto', array('filename' => \App\Car::find($items->car_id)->img))); ?>" alt="" style="width:100%;">

            </div>
          </div>

          <div class="col-sm-12">
            <h3 class="text-center text-primary">Destination</h3>
            <div class="col-sm-12 text-center bg-danger">
              <strong style="font-size: 24px;font-style: italic;"><?php echo e($items->destination); ?></strong>
            </div>
          </div>
          
          <div class="col-sm-12">
            <hr>
          </div>

          <div class="col-sm-6" style="padding: 0px 5px;">
            <h4 class="text-center text-primary">Rent From</h4>
            <div class="col-sm-12 text-center" style="padding: 0px;">
              <input type="hidden"  id="start_date" value="<?php echo e($items->date_rent); ?>" disabled>
              <strong id="show_start_date" style="font-style: italic;"></strong>
            </div>
          </div>

          <div class="col-sm-6" style="padding: 0px 5px; border-left: 1px solid #f2dede;">
            <h4 class="text-center text-primary">Untill</h4>
            <div class="col-sm-12 text-center" style="padding: 0px;">
              <input type="hidden" id="end_date" value="<?php echo e($items->date_return); ?>" disabled>
              <strong id="show_end_date" style="font-style: italic;"></strong>
            </div>
          </div>
          
          <div class="col-sm-12">
            <hr>
          </div>
  
          <div class="col-sm-12">
            <h3 class="text-center text-primary">Total Price</h3>
            <div class="col-sm-12 text-center bg-danger">
              <strong style="font-size: 24px;font-style: italic;" class="text-danger">Rp <?php echo e($items->price); ?></strong>
            </div>
          </div>
      </div>
    </div>
  </div>

<!-- div class="row" style="position: fixed;right: 0;top: 30%;padding-right: 25px;">
    <div class="block">
      <a href="http://localhost/github/rental-central/public/bookings/viewPDF/<?php echo e(str_replace("#","",$items->kode_booking)); ?>" target="_blank">
        <div class="hovicon effect-1 sub-a" title="CETAK PDF">
          <b><i class="fa fa-print" aria-hidden="true"></i> <div style="position: absolute;top: 30px;right: 35px;font-size: 10px;">print</div></b>
        </div>
      </a>
    </div>
</div -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content.js'); ?>
<script>
  //init option hidden bootstrap datepicker
  $('#start_date').datepicker({
      format: 'yyyy-mm-dd',
  });

  $('#end_date').datepicker({
      format: 'yyyy-mm-dd',
  });

  //set showing value from hidden bootstrap datepicker
  $('#show_start_date').html(
    $('#start_date').datepicker('getFormattedDate','DD, dd MM yyyy')
  );
  $('#show_end_date').html(
    $('#end_date').datepicker('getFormattedDate','DD, dd MM yyyy')
  );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>