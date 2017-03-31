@extends('layout.admin')

@section('content')
  <h3>Destination List</h3>
  <div class="list-main-btn">
    <div class="row">
      <div class="col-sm-4">
        <a href="{{ action('DestinationController@createForm') }}" class="btn btn-raised btn-success">Add Item</a>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
@endsection

@section('content.js')
<script>
$('#destination').addClass('active');

$('#itemTable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": {!! json_encode(action("DestinationController@listItem")) !!} + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "name"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableEdit({!! json_encode(action("DestinationController@listItem")) !!} + "/" + data.id + "/update") +
                  datatableDelete({!! json_encode(action("DestinationController@listItem")) !!} + "/" + data.id + "/delete")
        }
      }
    ]
} );
</script>
@endsection