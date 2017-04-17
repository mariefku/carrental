@extends('layout.admin')

@section('content.fullpage')
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
              <input type="text" class="form-control" id="tanggal_lahir" value="{{ $items->tanggal_lahir }}" required readonly>
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
              <img src="{{  route('ktp.getPhoto', array('filename' => $items->fotoktp )) }}" alt="" style="width: 50%;">
            </div>
          </div>   
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
                        <img src="{!! $img_url[0] !!}" alt="">
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
                        <input type="hidden" class="awe-calendar" id="start_date" value="{{ $items->date_rent }}" disabled>
                        <input type="text" class="awe-calendar" id="show_start_date" value="" disabled>
                    </div>
                </div>
                <div class="form-elements form-checkout">
                    <label>Untill</label>
                    <div class="form-item">
                        <input type="hidden" class="awe-calendar" id="end_date" value="{{ $items->date_return }}" disabled>
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