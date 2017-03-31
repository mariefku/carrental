@extends('layout.web')

@section('content')



<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">Data Pemesanan</h3>
  </div>

  <form class="" action="{{ action('BookingController@confirmItem') }}" method="post">
    {{ csrf_field() }}    
    <div class="panel-body">

    <input type="hidden" name="id"            value="{{ $databooks-> id }}">
    <input type="hidden" name="created_at"    value="{{ $databooks-> created_at }}">
    <input type="hidden" name="updated_at"    value="{{ $databooks-> updated_at }}">
    <input type="hidden" name="carmodel_id"   value="{{ $databooks-> carmodel_id }}">
    <input type="hidden" name="plate_number"  value="{{ $databooks-> plate_number }}">
    <input type="hidden" name="brand"         value="{{ $databooks-> brand }}">
    <input type="hidden" name="model"         value="{{ $databooks-> model }}">
    <input type="hidden" name="transmission"  value="{{ $databooks-> transmission }}">
    <input type="hidden" name="fuel"          value="{{ $databooks-> fuel }}">
    <input type="hidden" name="car_id"        value="{{ $databooks-> car_id }}">
    <input type="hidden" name="destination"   value="{{ $databooks-> destination }}">
    <input type="hidden" name="price"         value="{{ $databooks-> price }}">
    <input type="hidden" name="year"          value="{{ $databooks-> year }}">
    <input type="hidden" name="rental_id"     value="{{ $databooks-> rental_id }}">
    <input type="hidden" name="start_date"     value="{{ $databooks-> start_date }}">
    <input type="hidden" name="end_date"     value="{{ $databooks-> end_date }}">

        <div class="form-group">
          <label for="nama" class="col-sm-12 control-label">Nama Lengkap</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="{{ old('nama') }}" required>
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="nohp" class="col-sm-12 control-label">Nomor Telepon/HP</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="nohp" value="{{ old('nohp') }}" required>
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-12 control-label">Alamat Email</label>
          <div class="col-sm-12">
            <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" required>
            <span class="help-block small mb-0">Tiket akan dikirimkan ke alamat email ini</span>
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="" class="col-sm-12 control-label">Tanggal Lahir</label>

          <div class="col-sm-3">
            <select name="tanggal" id="" class="form-control" required>
              <option value="">Tgl</option>
              @for ($i = 1; $i <= 31 ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>  
          </div>
          <div class="col-sm-6">
            <select name="bulan" id="" class="form-control" required>
              <option value="">Bulan</option>
              @php
                $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                $jml_bln=count($bulan);
              @endphp
              @for ($i = 0; $i < $jml_bln ; $i++)
                <option value="{{ $bulan[$i] }}">{{ $bulan[$i] }}</option>
              @endfor
            </select>  
          </div>
          <div class="col-sm-3">
            <select name="tahun" id="" class="form-control" required>
              <option value="">Thn</option>
              @php
                $now=date('Y');
              @endphp
              @for ($i = 1937; $i < $now ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>  
          </div>
        </div>   
    </div>

    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-raised btn-success">Lanjutkan Pemesanan</button>
    </div>

  </form>
</div>
@endsection