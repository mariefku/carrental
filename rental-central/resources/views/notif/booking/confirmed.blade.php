@component('mail::message')

<hr>
Terdapat booking baru dengan kode booking :
@component('mail::panel')
	<strong> {!! $kode_booking !!} </strong>
@endcomponent

<hr>
@component('mail::table')

<h3>Detail Booking</h3>
|								      |	  |		     |
| ----------------------------------- |:-:| -------------------------------------------- |
| <strong> Nama </strong>             | : | {{ $booking->nama }}     					 |
| <strong> No. HP </strong>           | : | {{ $booking->nohp }}     					 |
| <strong> Alamat </strong>           | : | {{ $booking->alamat }}     				 	 |
| <strong> Email </strong>            | : | {{ $booking->email }}     					 |
| <strong> Tgl Lahir </strong>        | : | {{ \Carbon\Carbon::createFromFormat('d/m/Y', $booking->tanggal.'/'.$booking->bulan.'/'.$booking->tahun)->toDateString() }}     						 |
| <strong> No. KTP </strong>          | : | {{ $booking->noktp }}     					 |
| 						              |  |      										 |
| <strong> Mobil </strong>            | : | {{ $booking->brand }}  {{ $booking->model }} |
| <strong> Tujuan </strong>      	  | : | {{ $booking->destination }}     			 |
| <strong> Tanggal Pinjam </strong>   | : | {{ $booking->start_date }}     				 |
| <strong> Tanggal Kembali </strong>  | : | {{ $booking->end_date }}     				 |
| <strong> Total Tagihan </strong>    | : | {{ currency($booking->price) }}				 |

@endcomponent
<hr>

@component('mail::button', ['url' => url('/bookings/viewPDF/'.str_replace("#","",$kode_booking))])
Cetak/Download Kode Booking
@endcomponent


@endcomponent