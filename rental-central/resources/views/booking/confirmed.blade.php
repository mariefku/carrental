@extends('layout.web')

@section('content.fullpage')
    <div class="row bs-wizard" style="border-bottom:0;">

        <div class="col-xs-3 bs-wizard-step complete">
          <div class="text-center bs-wizard-stepnum">Step 1</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="{{ url('/search') }}" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Pilih Mobil</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 2</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Isi Data</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 3</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Konfrimasi Data</div>
        </div>

        <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 4</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Cetak Kode Booking</div>
        </div>
    </div>
    <hr> 
@endsection
@section('content')
  
  <div class="well">
    {!! $response !!}
  </div>

  <div class="col-sm-12">
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Selamat! <span style="color:#fbe8aa;"> {{ $items-> nama }} </span> </strong> Booking anda berhasil dilakukan.
    </div>
  </div>

  <div class="col-sm-8">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Booking Info</h3>
      </div>
      <div class="panel-body text-center">
          <h5> KODE BOOKING ANDA </h5>
          <div class="panel panel-default" style="width: 50%;margin: 0px auto;">
            <div class="panel-heading"> <strong style="font-size: 24px;"> {{ $newkode_booking }} </strong> </div>
          </div>

          <hr>

          <h5> <i class="fa fa-envelope-o" aria-hidden="true"></i> Email berisi kode booking juga telah kami kirim ke email anda <strong> {{ $items-> email }} </strong> </h5>
      </div>
    </div>

    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Cetak/Download Kode Booking</h3>
      </div>
      <div class="panel-body text-center">
        <a href=" {{ url('/bookings/viewPDF/'.str_replace("#","",$newkode_booking)) }} " target="_blank">
          <button type="submit" class="btn btn-raised btn-default"> <strong style="font-size: 24px;"> <i class="fa fa-print" aria-hidden="true"></i> CETAK/DOWNLOAD </strong> </button>
        </a>
        <br>
        <span style="color: red;">*tunjukkan struk booking/kode booking saat anda mengambil mobil</span>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="booking-info">
            <h3>Booking info</h3>
            <div class="form-group">
                <div class="form-elements">
                    <label>{{ $items-> brand }} {{ $items-> model }}</label>
                    <div class="form-item">
                        <img src="{{ $items-> img_url }}" alt="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-elements">
                    <label>Rental</label>
                    <div class="form-item">
                        <span>{{ App\Rental::find($items->rental_id)->name }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-elements">
                    <label>Alamat</label>
                    <div class="form-item">
                        <span>{{ App\Rental::find($items->rental_id)->address }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-elements">
                    <label>Destination</label>
                    <div class="form-item">
                        <input type="text" class="awe-calendar" value=" {{ $items->destination }} " disabled="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-elements form-checkin">
                    <label>Rent From</label>
                    <div class="form-item">
                        <input type="hidden" id="start_date" value="{{ $items->start_date }}" >
                        <input type="text" class="awe-calendar" id="show_start_date" value="" disabled>
                    </div>
                </div>
                <div class="form-elements form-checkout">
                    <label>Untill</label>
                    <div class="form-item">
                        <input type="hidden" id="end_date" value="{{ $items->end_date }}" >
                        <input type="text" class="awe-calendar" id="show_end_date" value="" disabled>
                    </div>
                </div>
            </div>
            
            <div class="price">
                <em>Total </em>
                <span class="amount">{{ currency($items->price) }}</span>
            </div>

        </div>
  </div>


@endsection
@section('content.js')
<script>
  //init option hidden bootstrap datepicker
  $('#start_date').datepicker({
      format: 'yyyy-mm-dd',
  });

  $('#end_date').datepicker({
      format: 'yyyy-mm-dd',
  });

  //set showing value from hidden bootstrap datepicker
  $('#show_start_date').val(
    $('#start_date').datepicker('getFormattedDate','DD, dd MM yyyy')
  );
  $('#show_end_date').val(
    $('#end_date').datepicker('getFormattedDate','DD, dd MM yyyy')
  );
</script>
@endsection