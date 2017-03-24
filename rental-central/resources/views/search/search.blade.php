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
      'field' => 'destination_id',
      'label' => 'Tujuan',
      'options' => App\Destination::all()->pluck("name", "id")->toArray(),
      'default' => $destination_id,
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
          <th>Harga</th> 
          <th>Action</th>
        </tr>
      </thead>
    </table>

    @foreach($items as $item)
    <h1>{{ $item->id }} {{ $item->brand }} {{ $item->model }} {{ $item->transmission }} {{ $item->fuel }} {{ $item->price }} {{ $item->rental_id }}</h1>
    @endforeach

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
      {"data": "price"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableBook({!! json_encode(action("SearchController@searchCar")) !!} + "/" + data.rental_id + "/book/" + data.id+ "/" + data.destination_id)/* +
                  datatableDelete({!! json_encode(action("SearchController@searchCar")) !!} + "/" + data.id + "/delete")*/
        }
      }
    ]
} );
</script>
@endsection