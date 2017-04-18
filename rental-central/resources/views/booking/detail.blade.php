@extends('layout.admin')

@section('content.fullpage')
@php

  if ($status == "NEW BOOKING"){
    $alert = "info";
    $color = "#5bc0de";
    $icon = "new_releases";
  }elseif ($status == "CONFIRMED") {
    $alert = "success";
    $color = "#5cb85c";
    $icon = "done";
  }elseif ($status == "REJECTED") {
    $alert = "danger";
    $color = "#d9534f";
    $icon = "highlight_off";
  }elseif ($status == "CANCELED") {
    $alert = "warning";
    $color = "#ff5722";
    $icon = "cancel";
  }else{
    $alert = "";
    $color = "";
    $icon = "";
  }
@endphp

  <div class="col-sm-12">
    <h2 style="font-weight: 700;color: {{ $color }};float: left;">DETAIL BOOKING {{ $items->kode_booking }}</h2>
    <h2 style="font-weight: 700;color: {{ $color }};float: right;"><i class="material-icons" style="font-size: 28px;">{{ $icon }}</i> {{ $status }}</h2>
    <hr style="clear: both;">
  </div>

  <div class="col-sm-8">

    @if ($status != "")
      <div class="alert alert-dismissible alert-{{ $alert }}">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Status Booking untuk kode booking <strong> {{ $items->kode_booking }} </strong> adalah <strong style="color: #fbe8aa;">{{ $status }}  </strong>
      </div>
    @endif

    <div class="panel panel-{{ $alert }}">
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
        <div class="booking-info" style="border: 2px solid {{ $color }};">
            <h3>Booking info</h3>
            <div class="form-group">
                <div class="form-elements">
                    <label>{{ $items-> brand }} {{ $items-> model }}</label>
                    <div class="form-item">
                        <img src="@foreach ($img_url as $img) {{ $img }} @endforeach" alt="">
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
                <span class="amount" style="color: {{ $color }};">{{ currency($items->price) }}</span>
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