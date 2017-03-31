@extends('layout.admin')

@section('content')
  <h3>
    <a href="{{ action('DestinationController@listItem') }}">Destination</a> | Add Item
  </h3>
  <div class="row">
    {!!
      Form::open([
        'role' => 'form',
        'url' => action('DestinationController@createItem'),
        'method' => 'post',
      ])
    !!}

    @include('form.text', [
      'field' => 'name',
      'label' => 'Name',
      'placeholder' => 'destination name',
      'default' => old('name'),
    ])

    <div class="form-group">
      <button type="submit" class="btn btn-raised btn-primary">Simpan</button>
    </div>
    {!!
      Form::close()
    !!}
  </div>
@endsection
@section('content.js')
<script>
$('#destination').addClass('active');
</script>
@endsection