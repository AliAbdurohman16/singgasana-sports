<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookingMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMonthlyMail;

class SendInvoiceEmails extends Command
{
    protected $signature = 'send:invoices';

    protected $description = 'Send monthly invoice emails for pending bookings with package Sekolah';

    public function handle()
    {
        if (Carbon::now()->endOfMonth()->isToday()) {
            $pendingBookings = BookingMember::where('status_payment', 'pending')
                ->where('package', 'Sekolah')
                ->get();

            foreach ($pendingBookings as $booking) {
                Mail::to($booking->user->email)->send(new InvoiceMonthlyMail($booking));
            }

            $this->info('Monthly invoices have been sent successfully.');
        } else {
            $this->info('Today is not the end of the month. No invoices were sent.');
        }
    }
}
