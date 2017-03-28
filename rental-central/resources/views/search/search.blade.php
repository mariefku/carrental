@extends('layout.web')

@section('content')
  <h3>Search</h3>

    {!!
      Form::open([
        'role' => 'form',
        'url' => action('SearchController@searchCar'),
        'method' => 'get',
      ])
    !!}

    @include('form.select', [
      'field' => 'destination',
      'label' => 'Tujuan',
      'options' => App\Destination::all()->pluck("name", "name")->toArray(),
      'default' => $destination,
    ])
    @include('form.text', [
      'field' => 'model_name',
      'label' => 'Model/Brand',
      'default' => app('request')->input('model_name'),
    ])

    @include('form.date', [
      'field' => '',
      'label' => 'Tanggal Berangkat',
      'attributes' => [
          'id' => 'show_start_date',
      ],
    ])
    <input type="hidden" name="start_date" id="start_date">

    @include('form.date', [
      'field' => '',
      'label' => 'Tanggal Kembali',
      'attributes' => [
        'id' => 'show_end_date',
      ],
    ])
  <input type="hidden" name='end_date' id="end_date">

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Cari</button>
    </div>
    {!!
      Form::close()
    !!}

    <table class="table table-striped table-bordered" id="itemTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Brand</th>
          <th>Model</th>
          <th>Transmission</th>
          <th>Fuel</th>
          <th>Year</th>
          <th>Harga</th> 
          <th>Action</th>
        </tr>
      </thead>
    </table>


@endsection

@section('content.js')
<script>
$('#itemTable').DataTable( {
    "ajax": {
        "url": {!! json_encode(action("SearchController@searchCar")) !!} + "/datatable",
        "type": "POST"
    },

    "columns": [
      {"data": "id"},
      {"data": "brand"},
      {"data": "model"},
      {"data": "transmission"},
      {"data": "fuel"},
      {"data": "year"},
      {"data": "price"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableBook( "bookings",
                                data.id,
                                data.created_at,
                                data.updated_at,
                                data.carmodel_id,
                                data.plate_number,
                                data.brand,
                                data.model,
                                data.transmission,
                                data.fuel,
                                data.car_id,
                                data.destination,
                                data.price,
                                data.year,
                                data.rental_id,
                                data.start_date,
                                data.end_date
                                )
        }
      }
    ]
} );

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