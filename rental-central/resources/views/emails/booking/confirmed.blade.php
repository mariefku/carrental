@component('mail::message')

Selamat <strong> {{ $booking->nama }} </strong>, pemesanan anda berupa mobil <strong> {{ $booking->brand }}  {{ $booking->model }} </strong> berhasil dilakukan..
<br>
<br>

<hr>
Berikut adalah kode booking anda:
@component('mail::panel')
	<strong> {!! $kode_booking !!} </strong>
@endcomponent

<hr>
@component('mail::table')

|	Detail Booking				      |	  |		     									 |
| ----------------------------------- |:-:| -------------------------------------------- |
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