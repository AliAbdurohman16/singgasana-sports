<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingMember;
use App\Models\BookingDaily;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMonthlyMail;

class AutoExpiredController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Retrieve data that has expired daily
        $expiredDaily = BookingDaily::where('expired', '<=', $now)
            ->where('status', '!=', 'expired')
            ->get();

        // Status update becomes expired daily
        foreach ($expiredDaily as $daily) {
            $daily->update(['status' => 'expired']);
        }

        // Retrieve data that has expired member
        $expiredMember = BookingMember::where('expired', '<=', $now)
            ->where('status', '!=', 'expired')
            ->get();

        // Status update becomes expired member
        foreach ($expiredMember as $member) {
            $member->update(['status' => 'expired']);
        }
    }

    public function sendMonthInvoice()
    {
        // Send monthly invoice for School package at the end of the month
        if (Carbon::now()->endOfMonth()->isToday()) {

            $pendingBookings = BookingMember::where('status', 'pending')
                ->where('package', 'Sekolah')
                ->get();

            foreach ($pendingBookings as $booking) {
                try {
                    Mail::to($booking->user->email)->send(new InvoiceMonthlyMail($booking));
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo 'Today is not the end of the month. No invoices were sent.';
        }
    }
}
