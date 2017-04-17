@extends('layout.web')

@section('content.fullpage')       
    <div class="row bs-wizard" style="border-bottom:0;">
        
        <div class="col-xs-3 bs-wizard-step complete">
          <div class="text-center bs-wizard-stepnum">Step 1</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="{{ url('/search') }}" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Pilih Mobil</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 2</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Isi Data</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
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
@endsection
@section('content')
<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">Data Pemesanan</h3>
  </div>

  <form class="" action="{{ action('BookingController@confirmItem') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}    
    <div class="panel-body">
    <div>
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
    <input type="hidden" name="start_date"    value="{{ $databooks-> start_date }}">
    <input type="hidden" name="end_date"      value="{{ $databooks-> end_date }}">
    <input type="hidden" name="end_date"      value="{{ $databooks-> end_date }}">
    <input type="hidden" name="img_url"      value="{{ $databooks-> img_url }}">
    </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="nama" class="col-sm-12 control-label">Nama Lengkap</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="{{ old('nama', $databooks->nama) }}" required>
              <br>
            </div>
          </div>

          <div class="form-group">
            <label for="nohp" class="col-sm-12 control-label">Nomor Telepon/HP</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="nohp" placeholder="Contoh: 08123456789" name="nohp" value="{{ old('nohp', $databooks->nohp) }}" required>
              <br>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-12 control-label">Alamat Email</label>
            <div class="col-sm-12">
              <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email', $databooks->email)  }}" required>
              <span class="help-block small mb-0">Kode booking akan dikirimkan ke alamat email ini</span>
              <br>
            </div>
          </div>
            
          <div class="form-group">
            <label for="" class="col-sm-12 control-label">Tanggal Lahir</label>

            <div class="col-sm-3">
              <select name="tanggal" id="" class="form-control" required>
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31 ; $i++)
                    <option value="{{ $i }}" @if ($databooks->tanggal != null && $i == $databooks->tanggal) selected @endif > {{ $i }}</option>
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
                  <option value="{{ $bulan[$i] }}" @if ($databooks->bulan != null && $bulan[$i] == $databooks->bulan) selected @endif >{{ $bulan[$i] }}</option>
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
                  <option value="{{ $i }}" @if ($databooks->tahun != null && $i == $databooks->tahun) selected @endif >{{ $i }}</option>
                @endfor
              </select>  
            </div>
          </div>
        </div>

        <div class="col-sm-6" style="border-left: 1px solid #4caf50">
          <div class="form-group">
            <label for="noktp" class="col-sm-12 control-label">Nomor KTP</label>
            <div class="col-sm-12">
              <input type="number" class="form-control" id="noktp" placeholder="" name="noktp" value="{{ old('noktp', $databooks->noktp) }}" required>
              <span class="help-block small mb-0">Isi dengan Nomor KTP anda</span>
              <br>
            </div>
          </div>

          <div class="form-group">
            <label for="alamat" class="col-sm-12 control-label">Alamat Tempat Tinggal</label>
            <div class="col-sm-12">
              <textarea class="form-control" rows="5" id="alamat" name="alamat" required> {{ old('alamat', $databooks->alamat ) }} </textarea>
              <span class="help-block small mb-0">Isi dengan alamat anda sesuai KTP</span>
              <br>
            </div>
          </div>    

          <div class="form-group">
            <label for="fotoktp" class="col-sm-12 control-label">Upload KTP</label>
            <div class="col-sm-12">

              <img src="@if($databooks->filename != null) {{  route('ktp.getPhoto', array('filename' => $databooks->filename)) }} @endif" id="showimage">
              <input type="text" readonly="" class="form-control" placeholder="ganti foto...">
              @if($databooks->filename != null)
                <input type="hidden" class="form-control" accept="image/*" name="filename" value="{{ $databooks->filename }}">
              @endif
              <input type="file" class="form-control" accept="image/*" id="fotoktp" name="fotoktp" value="">
              <span class="help-block small mb-0">Unggah Foto/Gambar/Scan KTP anda</span>
              <br>
            </div>
          </div>
        </div>

    </div>

    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-raised btn-success">Lanjutkan Pemesanan</button>
    </div>

  </form>
</div>
@endsection
@section('content.js')
<script>
  function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#showimage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#fotoktp").change(function(){
      readURL(this);
  });
</script>
@endsection