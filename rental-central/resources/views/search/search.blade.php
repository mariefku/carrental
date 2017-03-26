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
      'field' => 'start_date',
      'label' => 'Tanggal Berangkat',
      'default' => $start_date,
    ])
    @include('form.date', [
      'field' => 'end_date',
      'label' => 'Tanggal Kembali',
      'default' => $end_date,
    ])

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
                                data.rental_id
                                )
        }
      }
    ]
} );
</script>
@endsection