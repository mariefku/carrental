@extends('layout.admin')

@section('content')
  <h3>
    <a href="{{ action('RentalController@listItem') }}">Item</a>
    | #{{ $item->id }}
    | Edit
  </h3>
    <div class="row">
    {!!
      Form::open([
        'role' => 'form',
        'url' => action('RentalController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ])
    !!}

    <div class="col-sm-12">
      @include('form.text', [
        'field' => 'name',
        'label' => 'Name',
        'placeholder' => 'rental name',
        'default' => old('name',$item->name),
      ])
    </div>

    <div class="col-sm-12">
      @include('form.text', [
        'field' => 'url',
        'label' => 'URL',
        'placeholder' => 'rental url',
        'default' => old('url',$item->url),
      ])
    </div>

    <div class="col-sm-6">
      @include('form.text', [
        'field' => 'lat',
        'label' => 'Latitude',
        'placeholder' => 'latitude',
        'default' => old('lat',$item->lat),
        'attributes' => [
          'id' => 'lat',
        ],
      ])

      @include('form.text', [
        'field' => 'lng',
        'label' => 'Longitude',
        'placeholder' => 'longitude',
        'default' => old('lng',$item->lng),
        'attributes' => [
          'id' => 'lng',
        ],
      ])
    </div>

    <div class="col-sm-6">
      <div class="col-sm-2" id="pilih_lokasi_wrapper">
          <!-- Button trigger modal -->
        <div class="form-group">
          <button type="button" class="btn btn-raised btn-default" data-toggle="modal" id="pilih_lokasi" data-target="#myModal">
            <img src="{{ asset('images/maps.png') }}" alt="" style="width: 40px;height: auto;">
            <div id="pilih_lokasi_text">Ganti Lokasi</div>
          </button>
        </div>  
      </div>
    </div>

    <div class="col-sm-12">
      @include('form.textarea', [
        'field' => 'address',
        'label' => 'Address',
        'placeholder' => 'Address',
        'default' => old('address',$item->address),
      ])
    </div>

    <div class="col-sm-12">
      @include('form.text', [
        'field' => 'telp',
        'label' => 'No. Telp',
        'placeholder' => 'no. telp',
        'default' => old('telp',$item->telp),
      ])
    </div>

    <div class="col-sm-12">
      <div class="form-group">
        <button type="submit" class="btn btn-raised btn-primary">Simpan</button>
      </div>
    </div>      
    {!!
      Form::close()
    !!}
  </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h1 style="margin:0;padding:0;">PILIH LOKASI</h1>
      </div>
      <div class="modal-body">

        <div id="map-canvas" class="col-sm-12"></div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-raised btn-primary btn-lg" id="btn_selesai" data-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('content.js')
<script>
$('#rental').addClass('active');

  var map = new google.maps.Map(document.getElementById('map-canvas'),{
      center:{
        lat: {!! $item->lat !!},
        lng: {!! $item->lng !!}
      },
      zoom:15
  });

  var marker = new google.maps.Marker({
    position: {
        lat: {!! $item->lat !!},
        lng: {!! $item->lng !!}
    },
    map: map,
    draggable: true
  });

  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();

    $('#lat').val(lat);
    $('#lng').val(lng);
  });

  $('#btn_selesai').click( function () {
      jQuery('#lat').val(marker.getPosition().lat());
      jQuery('#lng').val(marker.getPosition().lng());
  });

  $('#myModal').on('shown.bs.modal', function () {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(marker.getPosition());
  });   
</script>
@endsection