<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Swimming Pool',
            'price_daily' => 50000.00,
            'price_member' => 150000.00,
        ]);

        Service::create( [
            'name' => 'Basket',
            'price_daily' => 85000.00,
            'price_member' => 185000.00,
        ]);

        Service::create([
            'name' => 'Badminton',
            'price_daily' => 35000.00,
            'price_member' => 135000.00,
        ]);

        Service::create([
            'name' => 'Tenis',
            'price_daily' => 40000.00,
            'price_member' => 140000.00,
        ]);

        Service::create([
            'name' => 'Tenis Meja',
            'price_daily' => 30000.00,
            'price_member' => 130000.00,
        ]);

        Service::create([
            'name' => 'Squash',
            'price_daily' => 45000.00,
            'price_member' => 145000.00,
        ]);

        Service::create([
            'name' => 'Fitness',
            'price_daily' => 55000.00,
            'price_member' => 155000.00,
        ]);

        Service::create([
            'name' => 'Aerobic',
            'price_daily' => 60000.00,
            'price_member' => 160000.00,
        ]);
    }
}
