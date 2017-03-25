@extends('layout.web')

@section('content')



<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title">Data Pemesanan</h3>
  </div>

  <form class="" action="{{ action('BookingController@createItem') }}" method="post">
    {{ csrf_field() }}    
    <div class="panel-body">

        <input type="hidden" class="form-control" id="nama" placeholder="" name="id_rental" value="{{ $databooks->rental_id }}">
        <input type="hidden" class="form-control" id="nama" placeholder="" name="id_mobil" value="{{ $databooks->car_id }}">
        <input type="hidden" class="form-control" id="nama" placeholder="" name="id_rental" value="{{ $databooks->destination_id }}">

        <div class="form-group">
          <label for="nama" class="col-sm-12 control-label">Nama Lengkap</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="{{ old('nama') }}">
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="nohp" class="col-sm-12 control-label">Nomor Telepon/HP</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="nohp" value="{{ old('nohp') }}">
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-12 control-label">Alamat Email</label>
          <div class="col-sm-12">
            <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}">
            <span class="help-block small mb-0">Tiket akan dikirimkan ke alamat email ini</span>
            <br>
          </div>
        </div>

        <div class="form-group">
          <label for="" class="col-sm-12 control-label">Tanggal Lahir</label>

          <div class="col-sm-3">
            <select name="tanggal" id="" class="form-control">
              <option value="">Tgl</option>
              @for ($i = 1; $i <= 31 ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>  
          </div>
          <div class="col-sm-6">
            <select name="bulan" id="" class="form-control">
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
            <select name="tahun" id="" class="form-control">
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
        <button type="submit" class="btn btn-success">Lanjutkan Pemesanan</button>
    </div>

  </form>
</div>
@endsection