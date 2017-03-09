@extends('layout.admin')

@section('content')
  <h3>
    <a href="{{ action('CarmodelController@listItem') }}">Item</a>
    | #{{ $item->id }}
    | Edit
  </h3>
    <div class="row">
    {!!
      Form::open([
        'role' => 'form',
        'url' => action('CarmodelController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ])
    !!}

    @include('form.text', [
      'field' => 'brand',
      'label' => 'Brand',
      'placeholder' => 'car brand',
      'default' => old('brand', $item->brand),
    ])

    @include('form.text', [
      'field' => 'model',
      'label' => 'Model',
      'placeholder' => 'car model',
      'default' => old('model', $item->model),
    ])

    @include('form.select', [
      'field' => 'transmission',
      'label' => 'Transmission',
      'options' => [
        'MT' => 'Manual Transmission',
        'AT' => 'Automatic Transmission',
      ],
      'default' => old('transmission', $item->transmission),
    ])

    @include('form.select', [
      'field' => 'fuel',
      'label' => 'Fuel',
      'options' => [
        'Premium' => 'Premium',
        'Pertamax' => 'Pertamax',
        'Solar' => 'Solar',
      ],
      'default' => old('fuel', $item->fuel),
    ])

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {!!
      Form::close()
    !!}
  </div>
@endsection