<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\BookingMember;
use Illuminate\Console\Scheduling\Schedule;

class UpdateExpiredBookingMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:expired-booking-member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status payment for expired data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        // Retrieve data that has expired
        $expiredData = BookingMember::where('expired_biometrik', '<=', $now)
            ->where('status_biometrik', 'pending')
            ->orWhere('status_biometrik', 'success')
            ->get();

        // status payment update becomes expired
        foreach ($expiredData as $data) {
            $data->update(['status_biometrik' => 'expired']);
        }

        $this->info('Expired status payment updated successfully.');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:expired-booking-member')->everyMinute();
    }
}
