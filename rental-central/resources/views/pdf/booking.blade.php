<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Booking Details</title>
    <link href="{{ asset('css/bootstrap-pdf.css') }}" rel="stylesheet">
	<style>
		body{
			padding: 5px;
			margin: 5px;
		}
		table>tbody {
			border: none !important;
		}
		table>tbody>tr {
			border: none !important;
		}
		table>tbody>tr>th {
			border: none !important;
		}
		table>tbody>tr>td {
			border: none !important;
		}
	</style>
</head>
<body>
<div>
	
	<div class="col-sm-6 text-center" style="width: 50%;float: left;">
		<div class="text-center" style="font-size: 28px;"><strong> BOOKING STRUCT </strong></div>	
	</div>
	<div class="col-sm-6 text-left" style="width: 50%;float: left;">
		<strong>Booking Date</strong> : {{ \Carbon\Carbon::Now('Asia/Jakarta')	}}
	</div>

	<div class="col-sm-12" style="clear: both;">
		<hr>
	</div>

	<div class="col-sm-6" style="width: 50%;float: left;">
		<table>
			<tbody>
				<tr>
					<th> Tanggal Pinjam </th>
					<td> : </td>
					<td> {{ $data->start_date }} </td>
				</tr>
				<tr>
					<th> Tanggal Kembali </th>
					<td> : </td>
					<td> {{ $data->end_date }} </td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-sm-6" style="width: 50%;float: left;">
		<table>
			<tbody>
				<tr>
					<th> Tujuan </th>
					<td> : </td>
					<td style="text-transform: uppercase;"> {{ $data->destination }} </td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-sm-12" style="clear: both;">
		<hr>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading text-center" style="font-size: 24px;"> KODE BOOKING : <strong> {{ $kode_booking }} </strong></div>
	  <div class="panel-body">
		<div>
			<table border="0" class="table table-condensed">
				<tbody>
					<tr>
						<th> Nama Lengkap </th>
						<td> : </td>
						<td style="text-transform: uppercase;"> {{ $data->nama }} </td>
					</tr>
					<tr>
						<th>Brand/Model Mobil</th>
						<td>:</td>
						<td style="text-transform: uppercase;">{{ $data->brand }} {{ $data->model }}</td>
					</tr>
					<tr>
						<th>Transmisi</th>
						<td>:</td>
						<td style="text-transform: uppercase;">{{ $data->transmission }}</td>
					</tr>
					<tr>
						<th>Bahan Bakar</th>
						<td>:</td>
						<td style="text-transform: uppercase;">{{ $data->fuel }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
</div>
</body>
</html>