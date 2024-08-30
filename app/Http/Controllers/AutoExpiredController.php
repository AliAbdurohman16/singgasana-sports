<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingMember;
use App\Models\BookingDaily;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentBookingDailyExpiredMail;
use App\Mail\PaymentBookingMemberExpiredMail;
use App\Mail\InvoiceMonthlyMail;

class AutoExpiredController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Retrieve data that has expired biometrik daily
        $expiredBiometrikDaily = BookingDaily::where('expired_biometrik', '<=', $now)
            ->where('status_biometrik', 'pending')
            ->orWhere('status_biometrik', 'success')
            ->get();

        // Status update becomes expired biometrik daily
        foreach ($expiredBiometrikDaily as $daily) {
            $daily->update(['status_biometrik' => 'expired']);
        }

        // Retrieve data that has expired payment daily
        $expiredPaymentDaily = BookingDaily::where('expired_payment', '<=', $now)
            ->where('status_payment', 'pending')
            ->get();

        // Status update becomes expired payment daily
        foreach ($expiredPaymentDaily as $daily) {
            $daily->update([
                'status_biometrik' => 'expired',
                'status_payment' => 'expired'
            ]);

            Mail::to($daily->email)->send(new PaymentBookingDailyExpiredMail($daily));
        }

        // Retrieve data that has expired member
        $expiredMember = BookingMember::where('expired_biometrik', '<=', $now)
            ->where('status_biometrik', 'pending')
            ->orWhere('status_biometrik', 'success')
            ->get();

        // Status update becomes expired member
        foreach ($expiredMember as $member) {
            $member->update(['status_biometrik' => 'expired']);
        }

        // Retrieve data that has expired payment member
        $expiredPaymentMember = BookingMember::where('expired_payment', '<=', $now)
            ->where('status_payment', 'pending')
            ->get();

        // Status update becomes expired payment member
        foreach ($expiredPaymentMember as $member) {
            $member->update([
                'status_biometrik' => 'expired',
                'status_payment' => 'expired'
            ]);
            
            Mail::to($member->user->email)->send(new PaymentBookingMemberExpiredMail($member));
        }

        // Retrieve data that has expired school
        $expiredSchool = BookingMember::where('expired_biometrik', '<=', $now)
            ->where('package', 'Sekolah')
            ->where('status_biometrik', 'pending')
            ->orWhere('status_biometrik', 'success')
            ->get();

        // Status update becomes expired school
        foreach ($expiredSchool as $school) {
            $school->update(['status_biometrik' => 'expired']);
        }
    }

    public function sendMonthInvoice()
    {
        // Send monthly invoice for School package at the end of the month
        if (Carbon::now()->endOfMonth()->isToday()) {

            $pendingBookings = BookingMember::where('status_payment', 'pending')
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
