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
        ]);

        Service::create([
            'name' => 'Badminton',
            'slug' => 'badminton',
        ]);

        Service::create([
            'name' => 'Tenis',
            'slug' => 'tenis',
        ]);

        Service::create([
            'name' => 'Tenis Meja',
            'slug' => 'tenis-meja',
        ]);

        Service::create([
            'name' => 'Squash',
            'slug' => 'squash',
        ]);

        // Service::create([
        //     'name' => 'Fitness',
        //     'slug' => 'fitness',
        // ]);

        // Service::create([
        //     'name' => 'Aerobic',
        //     'slug' => 'aerobic',
        // ]);
    }
}
