@extends('layout.admin')

@section('content')
  <h3>Car Model List</h3>
  <div class="list-main-btn">
    <div class="row">
      <div class="col-sm-4">
        <a href="{{ action('CarController@createForm') }}" class="btn btn-success">Add Item</a>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered" id="itemTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nopol</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Transmission</th>
        <th>Fuel</th>
        <th>Year</th>
        <th>Action</th>
        <th>Available</th>
      </tr>
    </thead>
  </table>
@endsection

@section('content.js')
<script>
$('#itemTable').DataTable( {
    "ajax": {
        "url": {!! json_encode(action("CarController@listItem")) !!} + "/datatable",
        "type": "POST"
    },
    "columns": [
      {"data": "id"},
      {"data": "plate_number"},
      {"data": "carmodel_brand"},
      {"data": "carmodel_model"},
      {"data": "carmodel_transmission"},
      {"data": "carmodel_fuel"},
      {"data": "year"},
      {
        "data": null,
        "sortable": false,
        "render": function(data) {
          return datatableEdit({!! json_encode(action("CarController@listItem")) !!} + "/" + data.id + "/update") +
                  datatableDelete({!! json_encode(action("CarController@listItem")) !!} + "/" + data.id + "/delete")
        }
      },
      {"data": function(data) {
          if(data.status == '1'){
            return '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> YES';
          }else{
            return '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> NO';
          }
        }
      },
    ],
    "createdRow": function( row, data, dataIndex ) {
      if ( data.status == "0" ) {
        $(row).addClass( 'danger' );
      }
    },
    "columnDefs": [
      {
        "targets": 8,
        "createdCell": function (td, cellData, rowData, row, col) {
          if ( cellData == '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> YES' ) {
            $(td).addClass('text-center').css({
                                              "background": "#16a085",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }else{
            $(td).addClass('text-center').css({
                                              "background": "#c0392b",
                                              "color": "#fff",
                                              "font-weight": "bold",
                                              "vertical-align": "middle",
                                          })
          }
        }
      },
    ]
} );
</script>
@endsection