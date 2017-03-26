@extends('layout.web')

@section('content')

<form class="form-horizontal" action="{{ action('BookingController@storeItem') }}" method="post">
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

  <input type="hidden" name="nama"          value="{{ $items-> nama }}">
  <input type="hidden" name="nohp"          value="{{ $items-> nohp }}">
  <input type="hidden" name="email"         value="{{ $items-> email }}">
  <input type="hidden" name="tanggal"       value="{{ $items-> tanggal }}">
  <input type="hidden" name="bulan"         value="{{ $items-> bulan }}">
  <input type="hidden" name="tahun"         value="{{ $items-> tahun }}">

  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Data Pemesanan</h3>
      </div>
      <div class="panel-body">
          <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama Lengkap</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama" placeholder="" name="" value="{{ old('nama', $items->nama) }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="nohp" class="col-sm-4 control-label">Nomor Telepon/HP</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="" value="{{ old('nohp', $items->nohp) }}" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Alamat Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" placeholder="" name="" value="{{ old('email', $items->email) }}" required readonly>
              <span class="help-block small mb-0">Tiket akan dikirimkan ke alamat email ini</span>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="tanggal_lahir" placeholder="" name="" value="{{ $items->tanggal }} {{ $items->bulan }} {{ $items->tahun }}" required readonly>
            </div>
          </div>   
      </div>
      <div class="panel-footer text-right">
          <button type="button" class="btn btn-warning">Ubah Data</button>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Data Kendaraan</h3>
      </div>
      <div class="panel-body">
          <div class="col-sm-7">
            <div class="form-group">
              <label for="" class="col-sm-5 control-label">Brand/Model</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $items-> brand }} {{ $items-> model }}" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-5 control-label">Transmisi</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $items-> transmission }}" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-5 control-label">Bahan Bakar</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $items-> fuel }}" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-5 control-label">Tahun</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $items-> year }}" required readonly>
              </div>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label for="" class="col-sm-4 control-label">Tujuan</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $items-> destination }}" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-12 ">Tanggal Peminjaman</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="" placeholder="" name="" value="" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-12 text-left">Tanggal Kembali</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="" placeholder="" name="" value="" required readonly>
              </div>
            </div>
          </div>

          <div class="col-sm-12" style="">
              <div class="alert alert-warning" role="alert" style="color: #777777;background-color: #f5f5f5;border-color: #dddddd;margin:0px;">
                <h3 class="col-sm-5" style="margin:5px;">Total Tagihan |</h3>
                <h3 class="" style="margin:5px;">Rp {{ $items-> price }},00</h3>
              </div>
          </div>
      </div>
      <div class="panel-footer text-right">
            <button type="submit" class="btn btn-success ">Lanjutkan Pemesanan</button>
      </div>
    </div>
  </div>

</form>
@endsection