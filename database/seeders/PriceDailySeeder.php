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
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SD Bintang Mulia',
            'weekday' => 18000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SMP Bintang Mulia',
            'weekday' => 28000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SMA Bintang Mulia',
            'weekday' => 28000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'TK BPK Penabur Singgasana',
            'weekday' => 17000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SD BPK Penabur Singgasana',
            'weekday' => 17000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SMP BPK Penabur Singgasana',
            'weekday' => 17000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SMA BPK Penabur Singgasana',
            'weekday' => 17000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'TK Harapan Kasih',
            'weekday' => 21000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SD Harapan Kasih',
            'weekday' => 21000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SMP Harapan Kasih',
            'weekday' => 27000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'SD Kalam Kudus',
            'weekday' => 18000.00,
        ]);

        PriceDaily::create([
            'service_id' => 1,
            'category' => 'Sekolah',
            'package' => 'Starbright',
            'weekday' => 17000.00,
        ]);
    }
}
