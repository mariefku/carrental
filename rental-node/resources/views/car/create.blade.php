@extends('layout.admin')

@section('content')
  <h3>
    <a href="{{ action('CarController@listItem') }}">Car Model</a> | Add Item
  </h3>
  <div class="row">
    {!!
      Form::open([
        'role' => 'form',
        'url' => action('CarController@createItem'),
        'method' => 'post',
      ])
    !!}

@php
  function generateRandomString($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
@endphp

    @include('form.text', [
      'field' => 'plate_number',
      'label' => 'Plate Number',
      'placeholder' => 'plate number',
      'default' => generateRandomString(rand(1,2)).' '.rand(1000,9999).' '.generateRandomString(rand(2,3)),
    ])

    @include('form.select', [
      'field' => 'carmodel_id',
      'label' => 'Model',
      'options' => App\Carmodel::all()->map(function($val) {
        $val->_full_name = "{$val->brand} {$val->model} {$val->transmission} {$val->fuel}";
        return $val;
      })->pluck("_full_name", "id"),
      'default' => old('carmodel_id'),
    ])

    @include('form.text', [
      'field' => 'year',
      'label' => 'Year',
      'placeholder' => 'year',
      'default' => old('year'),
    ])

    <div class="form-group">
      <label class="control-label">
        Harga
      </label>
      <div class="container">
        @include('form.text', [ 
          'field' => 'prices[Semarang]',
          'label' => 'Semarang',
          'default' => 500000,

        ])
        @include('form.text', [ 
          'field' => 'prices[Solo]',
          'label' => 'Solo',
          'default' => 500000,

        ])
        @include('form.text', [ 
          'field' => 'prices[Jepara]',
          'label' => 'Jepara',
          'default' => 500000,

        ])
        @include('form.text', [ 
          'field' => 'prices[Yogyakarta]',
          'label' => 'Yogyakarta',
          'default' => 500000,

        ])
        @include('form.text', [ 
          'field' => 'prices[Jakarta]',
          'label' => 'Jakarta',
          'default' => 500000,

        ])
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {!!
      Form::close()
    !!}
  </div>
@endsection