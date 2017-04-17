<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking,$kode_booking)
    {
        $this->booking = $booking;
        $this->kode_booking = $kode_booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Information '.$this->kode_booking)
                    ->markdown('emails.booking.confirmed')
                    ->with('booking',$this->booking)
                    ->with('kode_booking',$this->kode_booking);
    }
}
