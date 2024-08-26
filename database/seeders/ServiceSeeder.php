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
            'slug' => 'swimming-pool',
        ]);

        Service::create( [
            'name' => 'Basket',
            'slug' => 'basket',
            'field_counts' => 1,
        ]);

        Service::create([
            'name' => 'Badminton',
            'slug' => 'badminton',
            'field_counts' => 4,
        ]);

        Service::create([
            'name' => 'Tenis',
            'slug' => 'tenis',
            'field_counts' => 2,
        ]);

        Service::create([
            'name' => 'Tenis Meja',
            'slug' => 'tenis-meja',
            'field_counts' => 3,
        ]);

        Service::create([
            'name' => 'Squash',
            'slug' => 'squash',
            'field_counts' => 2,
        ]);

        Service::create([
            'name' => 'Fitness',
            'slug' => 'fitness',
        ]);

        // Service::create([
        //     'name' => 'Aerobic',
        //     'slug' => 'aerobic',
        // ]);
    }
}
