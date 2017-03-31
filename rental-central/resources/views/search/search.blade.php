@extends('layout.web')

@section('content')

  <div class="panel panel-info">

    <div class="panel-heading">
      <h3 class="panel-title">Search</h3>
    </div>

    {!!
      Form::open([
        'role' => 'form',
        'url' => action('SearchController@searchCar'),
        'method' => 'get',
      ])
    !!}

    <div class="panel-body">

      <div class="col-sm-6">
        @include('form.select', [
          'field' => 'destination',
          'label' => '<i class="material-icons">location_on</i> TUJUAN',
          'options' => App\Destination::all()->pluck("name", "name")->toArray(),
          'default' => '',
          'labelStyle' => 'font-size:16px;',
        ])

        @include('form.text', [
          'field' => 'model_name',
          'label' => '<i class="material-icons">directions_car</i> MODEL/BRAND',
          'default' => app('request')->input('model_name'),
          'help' => 'cth: Avanza',
          'labelStyle' => 'font-size:16px;',
        ])
      </div>

      <div class="col-sm-6">
        @include('form.date', [
          'field' => '',
          'label' => '<i class="material-icons">today</i> TANGGAL BERANGKAT',
          'attributes' => [
              'id' => 'show_start_date',
              'readonly' => 'true',
          ],
          'labelStyle' => 'font-size:16px;',
        ])
        <input type="hidden" name="start_date" id="start_date">

        @include('form.date', [
          'field' => '',
          'label' => '<i class="material-icons">today</i> TANGGAL KEMBALI',
          'attributes' => [
            'id' => 'show_end_date',
            'readonly' => 'true',
          ],
          'labelStyle' => 'font-size:16px;',
        ])
        <input type="hidden" name='end_date' id="end_date">
      </div>
    </div>

    <div class="panel-footer text-center">
          <button type="submit" class="btn btn-raised btn-info">
          <i class="material-icons">search</i>
           Cari
          </button>
    </div>

    {!!
      Form::close()
    !!}
  </div>

@endsection
@section('content.js')
<script>

  //$(".select").dropdown({"optionClass": "withripple"});
  $(".select").dropdown({ "autoinit" : ".select" });

  //init and set date
  @if ( app('request')->input('start_date') == null || app('request')->input('end_date') == null )
    var start_date = new Date();
    var end_date = new Date();
        end_date.setDate(end_date.getDate() + 1);
  @else
    var start_date=new Date("{!! app('request')->input('start_date') !!}");
    var end_date = new Date("{!! app('request')->input('end_date') !!}");
  @endif

  //init option bootstrap datepicker
  $('#show_start_date').datepicker({
      format: 'DD, dd MM yyyy',
      autoclose: true,
  }).datepicker("setDate", start_date).datepicker("setStartDate", new Date());

  $('#show_end_date').datepicker({
      format: 'DD, dd MM yyyy',
      autoclose: true,
  }).datepicker("setDate", end_date).datepicker("setStartDate", end_date);


  //set hidden value from bootstrap datepicker
  $('#start_date').val(
    $('#show_start_date').datepicker('getFormattedDate','yyyy-mm-dd')
  );
  $('#end_date').val(
    $('#show_end_date').datepicker('getFormattedDate','yyyy-mm-dd')
  );

  //on change datepicker set value to hidden date from bootstrap datepicker
  $('#show_start_date').on("changeDate", function() {
      $('#start_date').val(
          $('#show_start_date').datepicker('getFormattedDate','yyyy-mm-dd')
      );
  });
  $('#show_end_date').on("changeDate", function() {
      $('#end_date').val(
          $('#show_end_date').datepicker('getFormattedDate','yyyy-mm-dd')
      );
  });
</script>
@endsection