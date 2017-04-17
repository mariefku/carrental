@extends('layout.admin')

@section('content')
  <h3>Rental List</h3>
  <div class="list-main-btn">
    <div class="row">
      <div class="col-sm-4">
        <a href="{{ action('RentalController@createForm') }}" class="btn btn-raised btn-success">Add Item</a>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>URL</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Alamat</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
@endsection

@section('content.js')
<script>
$('#rental').addClass('active');

$('#itemTable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": {!! json_encode(action("RentalController@listItem")) !!} + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "name"},
      {"data": "url"},
      {"data": "lat"},
      {"data": "lng"},
      {"data": "address"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableEdit({!! json_encode(action("RentalController@listItem")) !!} + "/" + data.id + "/update") +
                  datatableDelete({!! json_encode(action("RentalController@listItem")) !!} + "/" + data.id + "/delete")
        }
      }
    ],
    "columnDefs": [
      { "width": "15%", "targets": 6 }
    ]
} );
</script>
@endsection