<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ValidationBookingSchoolMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $qrPath = public_path('qr_codes/' . $this->data->qr);
        
        return $this->markdown('emails.validation.school')
                    ->subject('Validasi Booking Sekolah')
                    ->attach($qrPath, [
                        'as' => 'QR_Code.png',
                        'mime' => 'image/png',
                    ]);
    }
}
