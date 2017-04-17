@extends('layout.admin')

@section('content')

  <h3>
    <a href="{{ action('CarController@listItem') }}">Item</a>
    | #{{ $item->id }}
    | Edit
  </h3>
  <br><br>
    <div class="row">
    {!!
      Form::open([
        'role' => 'form',
        'url' => action('CarController@updateItem', ['id' => $item->id]),
        'method' => 'post',
      ])
    !!}

    @php
      $ischecked = false;
      if ($item->status == '1')
      $ischecked = true;
    @endphp

    <div class="form-group col-sm-12">
      <label class="control-label">
        Is The Car Available?
      </label>
      <br>
      <div class="col-sm-2 alert" style="color: #fff;margin: 0px;" id="status_wrapper">
        <div class="col-sm-7">
          <input type="hidden" name="status" value="0">
          <label class="switch" style="margin: 0;vertical-align: middle;">
            {{ Form::checkbox('status', 1, $ischecked,['id' => 'status_val']) }}
            <div class="slider round" id="switch"></div>
          </label>

        </div>
        @if ($item->status == '1')
          <div class="col-sm-5" style="padding-left: 0;">
            <h3 style="margin:0;font-weight: bold;" id='status'>YES</h3>
          </div>
        @else
          <div class="col-sm-5" style="padding-left: 0;">
            <h3 style="margin:0;font-weight: bold;" id='status'>NO</h3>
          </div>
        @endif
      </div>
    </div>
    @include('form.text', [
      'field' => 'plate_number',
      'label' => 'Plate Number',
      'placeholder' => 'plate number',
      'default' => old('plate_number', $item->plate_number),
    ])

    @include('form.select', [
      'field' => 'carmodel_id',
      'label' => 'Model',
      'options' => App\Carmodel::all()->map(function($val) {
        $val->_full_name = "{$val->brand} {$val->model} {$val->transmission} {$val->fuel}";
        return $val;
      })->pluck("_full_name", "id"),
      'default' => old('carmodel_id', $item->carmodel_id),
    ])

    <div class="form-group col-sm-12">
      <label class="control-label">
        Harga
      </label>
      <div class="container">
      @foreach(App\CarPrice::all()->where('car_id',$item->id) as $carprice)
        @include('form.text', [ 
          'field' => 'prices[' . $carprice->destination . ']',
          'label' => $carprice->destination,
          'default' => old('price', $carprice->price),
        ])
      @endforeach
      </div>
    </div>

    <div class="form-group col-sm-12">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {!!
      Form::close()
    !!}
  </div>

  <script>
    $(document).ready(function() {
      var checkBoxes = $("input[name=status]");
      var status_wrapper = $("#status_wrapper");

      $("#switch").click(function() {
          var status = $("#status");
          if(checkBoxes.is(':checked')){
            status.html('NO');
            status_wrapper.css('background-color','#c0392b');
          }else{
            status.html('YES');
            status_wrapper.css('background-color','#16a085');
          }
      });

      if(checkBoxes.is(':checked')){
        status_wrapper.css('background-color','#16a085');
      }else{
        status_wrapper.css('background-color','#c0392b');
      }

    });
  </script>
@endsection