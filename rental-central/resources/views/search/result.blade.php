@extends('layout.web')


@section('content.fullpage')
  <div class="col-sm-3">
    <div class="panel panel-info">

      <div class="panel-heading">
        <h3 class="panel-title">reSearch</h3>
      </div>

      {!!
        Form::open([
          'role' => 'form',
          'url' => action('SearchController@searchCar'),
          'method' => 'get',
        ])
      !!}

      <div class="panel-body">


          @include('form.select', [
            'field' => 'destination',
            'label' => 'Tujuan',
            'options' => App\Destination::all()->pluck("name", "name")->toArray(),
            'default' => $destination,
            'formStyle' => 'margin:0px;',
          ])

          @include('form.text', [
            'field' => 'model_name',
            'label' => 'Model/Brand',
            'default' => app('request')->input('model_name'),
            'help' => 'cth: Avanza',
            'formStyle' => 'margin:0px;',
          ])



          @include('form.date', [
            'field' => '',
            'label' => 'Tanggal Berangkat',
            'attributes' => [
                'id' => 'show_start_date',
            ],
            'formStyle' => 'margin:0px;',
          ])
          <input type="hidden" name="start_date" id="start_date">

          @include('form.date', [
            'field' => '',
            'label' => 'Tanggal Kembali',
            'attributes' => [
              'id' => 'show_end_date',
            ],
            'formStyle' => 'margin:0px;',
          ])
          <input type="hidden" name='end_date' id="end_date">

      </div>

      <div class="panel-footer text-center">
            <button type="submit" class="btn btn-raised btn-info">
            <i class="material-icons">search</i> Cari
            </button>
      </div>

      {!!
        Form::close()
      !!}
    </div>
  </div>
         

  <div class="col-md-9">
      <div class="filter-page__content">
          <div class="filter-item-wrapper">

          @foreach ($pager as $data)                            
            <!-- ITEM -->
            <div class="hotel-item">
                <div class="item-media">
                    <div class="image-cover">
                        <img src="{{ $data->img_url }}" alt="">
                    </div>
                </div>
                <div class="item-body">
                    <div class="item-title">
                        <h2>
                            <a href="#">{{ $data->brand }} {{ $data->model }}</a>
                        </h2>
                    </div>
                    <!-- div class="item-hotel-star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div -->
                    <div class="item-address">
                        <i class="awe-icon awe-icon-marker-2"></i>
                        {{ \App\Rental::find($data->rental_id)->name }}
                    </div>
                    <div class="item-footer">
                        <div class="item-rate">
                            <span>{{ $data->year }}</span>
                        </div>

                        @php
                          $transmission = "Automatic Transmission";
                          if ( $data->transmission == "MT" ){
                            $transmission = "Manual Transmission";
                          }
                        @endphp

                        <div class="item-icon">
                            <i class="material-icons" style="font-size: 18px;position: relative;top: 3px;" title="Fuel">local_gas_station</i> {{ $data->fuel }}
                            <i class="fa fa-sitemap" aria-hidden="true" title="{{ $transmission }}"></i> {{ $data->transmission }}
                            <i class="awe-icon awe-icon-gym"></i>
                            <i class="awe-icon awe-icon-car"></i>
                            <i class="awe-icon awe-icon-food"></i>
                            <i class="awe-icon awe-icon-level"></i>
                            <i class="awe-icon awe-icon-wifi"></i>
                        </div>
                    </div>
                </div>
                <div class="item-price-more">
                    <div class="price" style="padding-top: 30px;">
                        price
                        <span class="amount">{{ currency($data->price * $numberofdays) }}</span>
                    </div>
                  <form action="../bookings" method="post" style="margin-top: 35px;">
                    {{ csrf_field() }}
                    <div>
                    <input type="hidden" name="id"            value="{{ $data->id }}">
                    <input type="hidden" name="created_at"    value="{{ $data->created_at }}">
                    <input type="hidden" name="updated_at"    value="{{ $data->updated_at }}">
                    <input type="hidden" name="carmodel_id"   value="{{ $data->carmodel_id }}">
                    <input type="hidden" name="plate_number"  value="{{ $data->plate_number }}">
                    <input type="hidden" name="brand"         value="{{ $data->brand }}">
                    <input type="hidden" name="model"         value="{{ $data->model }}">
                    <input type="hidden" name="transmission"  value="{{ $data->transmission }}">
                    <input type="hidden" name="fuel"          value="{{ $data->fuel }}">
                    <input type="hidden" name="car_id"        value="{{ $data->car_id }}">
                    <input type="hidden" name="destination"   value="{{ $data->destination }}">
                    <input type="hidden" name="price"         value="{{ $data->price * $numberofdays }}">
                    <input type="hidden" name="year"          value="{{ $data->year }}">
                    <input type="hidden" name="rental_id"     value="{{ $data->rental_id }}">
                    <input type="hidden" name="start_date"    value="{{ $data->start_date }}">
                    <input type="hidden" name="end_date"      value="{{ $data->end_date }}">
                    <input type="hidden" name="img_url"       value="{{ $data->img_url }}">
                    </div>
                    <button type="submit" class="awe-btn">Book Now</button>
                  </form>
                </div>
            </div>
            <!-- END / ITEM -->
          @endforeach
          
          <!-- PAGINATION -->
            {!! $pager->appends(app('request')->except('page'))->render() !!}
          <!-- END / PAGINATION -->

      </div>
  </div>
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
}).datepicker("setDate", end_date).datepicker("setStartDate", new Date());


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