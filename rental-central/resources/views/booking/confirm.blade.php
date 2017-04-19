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
        
        <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 3</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Konfrimasi Data</div>
        </div>

        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 4</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Cetak Kode Booking</div>
        </div>
    </div>
    <hr>
  

  @if ($errors->has('g-recaptcha-response'))
    <div class="col-sm-12">
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Terjadi Kesalahan!</strong>
        <a href="#captcha" class="alert-link" style="color: #fbe8aa;">Error captcha</a>, ulangi validasi captcha.
      </div>
    </div>
  @endif   

  <div class="col-sm-8">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Data Pemesanan</h3>
      </div>
      <div class="panel-body">
          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" value="{{ old('nama', $items->nama) }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Nomor Telepon/HP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="" value="{{ old('nohp', $items->nohp) }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Alamat Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" value="{{ old('email', $items->email) }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal_lahir" value="{{ $items->tanggal }} {{ $items->bulan }} {{ $items->tahun }}" required readonly>
            </div>
          </div>

           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Nomor KTP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal_lahir" value="{{ $items->noktp }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" rows="3" id="tanggal_lahir" style="padding-left: 12px; " required readonly>{{ $items->alamat }}</textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Foto KTP</label>
            <div class="col-sm-10">
              <img src="{{  route('ktp.getPhoto', array('filename' => $filename)) }}" alt="" style="width: 50%;">
            </div>
          </div>   
      </div>
      <div class="panel-footer text-right">
        <form action="{{ action('GuestBookingController@updateItem') }}" method="post">
          <div>
          {{ csrf_field() }}
          <input type="hidden" name="id"            value="{{ $items-> id }}">
          <input type="hidden" name="created_at"    value="{{ $items-> created_at }}">
          <input type="hidden" name="updated_at"    value="{{ $items-> updated_at }}">
          <input type="hidden" name="carmodel_id"   value="{{ $items-> carmodel_id }}">
          <input type="hidden" name="plate_number"  value="{{ $items-> plate_number }}">
          <input type="hidden" name="brand"         value="{{ $items-> brand }}">
          <input type="hidden" name="model"         value="{{ $items-> model }}">
          <input type="hidden" name="transmission"  value="{{ $items-> transmission }}">
          <input type="hidden" name="fuel"          value="{{ $items-> fuel }}">
          <input type="hidden" name="car_id"        value="{{ $items-> car_id }}">
          <input type="hidden" name="destination"   value="{{ $items-> destination }}">
          <input type="hidden" name="price"         value="{{ $items-> price }}">
          <input type="hidden" name="year"          value="{{ $items-> year }}">
          <input type="hidden" name="rental_id"     value="{{ $items-> rental_id }}">
          <input type="hidden" name="start_date"    value="{{ $items-> start_date }}" id="start_date">
          <input type="hidden" name="end_date"      value="{{ $items-> end_date }}" id="end_date">
          <input type="hidden" name="img"         value="{{ $items-> img }}">

          <input type="hidden" name="nama"          value="{{ $items-> nama }}">
          <input type="hidden" name="nohp"          value="{{ $items-> nohp }}">
          <input type="hidden" name="email"         value="{{ $items-> email }}">
          <input type="hidden" name="tanggal"       value="{{ $items-> tanggal }}">
          <input type="hidden" name="bulan"         value="{{ $items-> bulan }}">
          <input type="hidden" name="tahun"         value="{{ $items-> tahun }}">

          <input type="hidden" name="noktp"         value="{{ $items-> noktp }}">
          <input type="hidden" name="alamat"         value="{{ $items-> alamat }}">
          <input type="hidden" name="filename"         value="{{ $filename }}">
          </div>
          
          <button type="submit" class="btn btn-raised btn-warning">Ubah Data</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="detail-sidebar" style="margin: 0px;">
        <div class="booking-info">
            <h3>Booking info</h3>
            <div class="form-group">
                <div class="form-elements">
                    <label>{{ $items-> brand }} {{ $items-> model }}</label>
                    <div class="form-item">
                        <img src="{{ App\Rental::find($items->rental_id)->url.$items->img  }}/getPhoto" alt="">
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
                    <label>No. Telepon</label>
                    <div class="form-item">
                        <span>{{ App\Rental::find($items->rental_id)->telp }}</span>
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
                        <input type="text" class="awe-calendar" id="show_start_date" value="" disabled>
                    </div>
                </div>
                <div class="form-elements form-checkout">
                    <label>Untill</label>
                    <div class="form-item">
                        <input type="text" class="awe-calendar" id="show_end_date" value="" disabled>
                    </div>
                </div>
            </div>
            
            <div class="price">
                <em>Total </em>
                <span class="amount">{{ currency($items->price) }}</span>
            </div>

            <form action="{{ action('GuestBookingController@storeItem') }}" method="post">
            <div class="price" id="captcha">
                {!! app('captcha')->display(); !!} 
                 @if ($errors->has('g-recaptcha-response'))
                  <div class="col-sm-12 text-left"><span class="help-block text-danger" style="display: block;">error captcha, ulangi validasi captcha. </span></div>
                  @endif   
            </div>
            
            <div class="form-submit">
                <div class="add-to-cart">
                    
                      <div>
                      {{ csrf_field() }}
                      <input type="hidden" name="id"            value="{{ $items-> id }}">
                      <input type="hidden" name="created_at"    value="{{ $items-> created_at }}">
                      <input type="hidden" name="updated_at"    value="{{ $items-> updated_at }}">
                      <input type="hidden" name="carmodel_id"   value="{{ $items-> carmodel_id }}">
                      <input type="hidden" name="plate_number"  value="{{ $items-> plate_number }}">
                      <input type="hidden" name="brand"         value="{{ $items-> brand }}">
                      <input type="hidden" name="model"         value="{{ $items-> model }}">
                      <input type="hidden" name="transmission"  value="{{ $items-> transmission }}">
                      <input type="hidden" name="fuel"          value="{{ $items-> fuel }}">
                      <input type="hidden" name="car_id"        value="{{ $items-> car_id }}">
                      <input type="hidden" name="destination"   value="{{ $items-> destination }}">
                      <input type="hidden" name="price"         value="{{ $items-> price }}">
                      <input type="hidden" name="year"          value="{{ $items-> year }}">
                      <input type="hidden" name="rental_id"     value="{{ $items-> rental_id }}">
                      <input type="hidden" name="start_date"    value="{{ $items-> start_date }}" id="start_date">
                      <input type="hidden" name="end_date"      value="{{ $items-> end_date }}" id="end_date">
                      <input type="hidden" name="img"         value="{{ $items-> img }}">

                      <input type="hidden" name="nama"          value="{{ $items-> nama }}">
                      <input type="hidden" name="nohp"          value="{{ $items-> nohp }}">
                      <input type="hidden" name="email"         value="{{ $items-> email }}">
                      <input type="hidden" name="tanggal"       value="{{ $items-> tanggal }}">
                      <input type="hidden" name="bulan"         value="{{ $items-> bulan }}">
                      <input type="hidden" name="tahun"         value="{{ $items-> tahun }}">

                      <input type="hidden" name="noktp"         value="{{ $items-> noktp }}">
                      <input type="hidden" name="alamat"        value="{{ $items-> alamat }}">
                      <input type="hidden" name="filename"      value="{{ $filename }}">
                      </div> 

                    <button type="submit">
                    Konfirmasi Pemesanan <i class="material-icons" style="font-size: 24px;position: relative;top: 7px;">arrow_forward</i>
                    </button>
                    </form>
                </div>
            </div>
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