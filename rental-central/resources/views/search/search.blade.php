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
    @include('form.checkbox', [
      'field' => 'model_name[]',
      'label' => 'Model',
      'checkbox' => App\Carmodel::all()->map(function ($i) use ($model_name) {
        return [
          "value" => $i->model,
          "label" => $i->brand . " " . $i->model,
          "default" => in_array($i->model, $model_name),
        ];
      }),
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

    @foreach($items as $item)
    <h1>{{ $item->plate_number }}</h1>
    <h2>{{ App\Carmodel::find($item->carmodel_id)->brand }} {{ App\Carmodel::find($item->carmodel_id)->model }}</h2>
    @endforeach

@endsection

@section('content.js')
<script>
</script>
@endsection