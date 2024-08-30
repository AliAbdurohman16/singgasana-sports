<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\BookingDaily;
use Illuminate\Console\Scheduling\Schedule;

class UpdateExpiredBookingDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:expired-booking-daily';

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
        $expiredData = BookingDaily::where('expired_biometrik', '<=', $now)
            ->where('status_payment', '!=', 'expired')
            ->get();

        // status payment update becomes expired
        foreach ($expiredData as $data) {
            $data->update(['status_payment' => 'expired']);
        }

        $this->info('Expired status payment updated successfully.');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:expired-booking-daily')->everyMinute();
    }
}
