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

    @include('form.text', [
      'field' => 'name',
      'label' => 'Name',
      'placeholder' => 'rental name',
      'default' => old('name', $item->name),
    ])

    @include('form.text', [
      'field' => 'url',
      'label' => 'URL',
      'placeholder' => 'rental url',
      'default' => old('url', $item->url),
    ])

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {!!
      Form::close()
    !!}
  </div>
@endsection