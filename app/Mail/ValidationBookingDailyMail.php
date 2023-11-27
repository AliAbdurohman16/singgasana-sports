<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ValidationBookingDailyMail extends Mailable
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
        $pdfFileName = 'qr_' . time() . '.pdf';

        // Generate QR code PDF with white background
        QrCode::size(300)
            ->format('pdf')
            ->backgroundColor(255, 255, 255) // Putih
            ->margin(20)
            ->generate($this->data->qr, $qrPath . '/' . $pdfFileName);

        // Attach the PDF to the email
        $pdfContent = Storage::get('qr_codes/' . $pdfFileName);

        return $this->markdown('emails.validation.daily')
                    ->subject('Validasi Booking Harian')
                    ->attachData($pdfContent, $pdfFileName, [
                        'mime' => 'application/pdf',
                    ]);
    }
}
