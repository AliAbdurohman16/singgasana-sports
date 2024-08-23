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
    protected $description = 'Update status for expired data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        // Retrieve data that has expired
        $expiredData = BookingMember::where('expired', '<=', $now)
            ->where('status', '!=', 'expired')
            ->get();

        // Status update becomes expired
        foreach ($expiredData as $data) {
            $data->update(['status' => 'expired']);
        }

        $this->info('Expired status updated successfully.');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:expired-booking-member')->everyMinute();
    }
}
