<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceDaily;

class PriceDailySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceDaily::create([
            'service_id' => 3,
            'category' => 'Umum',
            'morning' => 45000.00,
            'afternoon' => 50000.00,
        ]);

        PriceDaily::create([
            'service_id' => 3,
            'category' => 'Penghuni',
            'morning' => 40000.00,
            'afternoon' => 45000.00,
        ]);

        PriceDaily::create([
            'service_id' => 2,
            'category' => 'Umum',
            'morning' => 135000.00,
            'afternoon' => 165000.00,
        ]);

        PriceDaily::create([
            'service_id' => 2,
            'category' => 'Penghuni',
            'morning' => 115000.00,
            'afternoon' => 140000.00,
        ]);

        PriceDaily::create([
            'service_id' => 6,
            'category' => 'Umum',
            'price' => 45000.00,
        ]);

        PriceDaily::create([
            'service_id' => 6,
            'category' => 'Penghuni',
            'price' => 40000.00,
        ]);

        PriceDaily::create([
            'service_id' => 4,
            'category' => 'Umum',
            'morning' => 70000.00,
            'afternoon' => 80000.00,
        ]);

        PriceDaily::create([
            'service_id' => 4,
            'category' => 'Penghuni',
            'morning' => 60000.00,
            'afternoon' => 70000.00,
        ]);

        PriceDaily::create([
            'service_id' => 5,
            'category' => 'Umum',
            'price' => 35000.00,
        ]);

        PriceDaily::create([
            'service_id' => 5,
            'category' => 'Penghuni',
            'price' => 30000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Renang',
            'package' => 'Dewasa',
            'weekday' => 50000.00,
            'weekend' => 40000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Renang',
            'package' => 'Anak',
            'weekday' => 40000.00,
            'weekend' => 50000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Renang',
            'package' => 'Pengantar',
            'weekday' => 20000.00,
            'weekend' => 20000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Renang',
            'package' => 'Tiket Buku (15 Lembar)',
            'weekday' => 550000.00,
            'weekend' => 550000.00,
        ]);

        PriceDaily::create([
            'service_id' => 7,
            'category' => 'Retail Paket 1',
            'package' => 'Fitness, Whirlpool, Steam',
            'price' => 125000.00,
        ]);

        PriceDaily::create([
            'service_id' => 7,
            'category' => 'Retail Paket 2',
            'package' => 'Fitness, Whirlpool, Steam & Swimming',
            'price' => 150000.00,
        ]);
    }
}
