<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceMember;

class PriceMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceMember::create([
            'service_id' => 3,
            'category' => 'Umum',
            'two_hours_morning' => 560000.00,
            'three_hours_morning' => 840000.00,
            'two_hours_afternoon' => 560000.00,
            'four_hours_afternoon' => 1280000.00,
        ]);

        PriceMember::create([
            'service_id' => 3,
            'category' => 'Penghuni',
            'two_hours_morning' => 460000.00,
            'three_hours_morning' => 690000.00,
            'two_hours_afternoon' => 540000.00,
            'four_hours_afternoon' => 1080000.00,
        ]);

        PriceMember::create([
            'service_id' => 2,
            'category' => 'Umum',
            'two_hours_morning' => 1850000.00,
            'three_hours_morning' => 2780000.00,
            'two_hours_afternoon' => 2110000.00,
            'four_hours_afternoon' => 4220000.00,
        ]);

        PriceMember::create([
            'service_id' => 2,
            'category' => 'Penghuni',
            'two_hours_morning' => 1550000.00,
            'three_hours_morning' => 2320000.00,
            'two_hours_afternoon' => 1800000.00,
            'four_hours_afternoon' => 3600000.00,
        ]);

        PriceMember::create([
            'service_id' => 6,
            'category' => 'Umum',
            'one_hours' => 306000.00,
        ]);

        PriceMember::create([
            'service_id' => 6,
            'category' => 'Penghuni',
            'one_hours' => 270000.00,
        ]);

        PriceMember::create([
            'service_id' => 4,
            'category' => 'Umum',
            'two_hours_morning' => 960000.00,
            'three_hours_morning' => 1100000.00,
            'three_hours_afternoon' => 1650000.00,
        ]);

        PriceMember::create([
            'service_id' => 4,
            'category' => 'Penghuni',
            'two_hours_morning' => 800000.00,
            'three_hours_morning' => 950000.00,
            'three_hours_afternoon' => 1425000.00,
        ]);

        PriceMember::create([
            'service_id' => 5,
            'category' => 'Penghuni',
            'two_hours' => 425000.00,
            'three_hours' => 635000.00,
            'ten_hours' => 250000.00,
            'twelve_hours' => 300000.00,
            'fifteen_hours' => 330000.00,
        ]);

        PriceMember::create([
            'service_id' => 5,
            'category' => 'Penghuni',
            'two_hours' => 370000.00,
            'three_hours' => 555000.00,
            'ten_hours' => 250000.00,
            'twelve_hours' => 300000.00,
            'fifteen_hours' => 330000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Personal',
            'category' => 'Umum',
            'two_months' => 800000.00,
            'six_months' => 2100000.00,
            'twelve_months' => 3660000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Personal',
            'category' => 'Penghuni',
            'two_months' => 640000.00,
            'six_months' => 1680000.00,
            'twelve_months' => 3660000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Couple',
            'category' => 'Umum',
            'two_months' => 1280000.00,
            'six_months' => 3360000.00,
            'twelve_months' => 5880000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Couple',
            'category' => 'Penghuni',
            'two_months' => 1020000.00,
            'six_months' => 2700000.00,
            'twelve_months' => 4710000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Triple',
            'category' => 'Umum',
            'two_months' => 1800000.00,
            'six_months' => 4590000.00,
            'twelve_months' => 7920000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Triple',
            'category' => 'Penghuni',
            'two_months' => 1440000.00,
            'six_months' => 690000.00,
            'twelve_months' => 6300000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Family',
            'category' => 'Umum',
            'two_months' => 2100000.00,
            'six_months' => 5100000.00,
            'twelve_months' => 8880000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Family',
            'category' => 'Penghuni',
            'two_months' => 1680000.00,
            'six_months' => 4080000.00,
            'twelve_months' => 7110000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'student',
            'category' => 'Pelajar',
            'two_months' => 525000.00,
            'six_months' => 1410000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Swimming Club',
            'category' => 'Sekolah Olahraga',
            'package_a' => 525000.00,
            'package_b' => 1410000.00,
            'package_c' => 2310000.00,
            'package_d' => 3210000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Community',
            'category' => 'Perusahaan',
            'two_months' => 3000000.00,
            'two_months_ten_people' => 5600000.00,
            'six_months' => 7650000.00,
            'six_months_ten_people' => 14400000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Corporate',
            'category' => 'Perusahaan',
            'two_months' => 2750000.00,
            'two_months_ten_people' => 5100000.00,
            'six_months' => 7050000.00,
            'six_months_ten_people' => 13200000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Corporate',
            'category' => 'Ikawarna',
            'two_months' => 1750000.00,
            'two_months_ten_people' => 3500000.00,
            'six_months' => 4500000.00,
            'six_months_ten_people' => 9000000.00,
        ]);

        PriceMember::create([
            'service_id' => 1,
            'member' => 'Pelatih Renang',
            'category' => 'Pelatih',
            'member_coach_club_two_months' => 2750000.00,
            'member_coach_club_two_months_plus_fitness' => 5100000.00,
        ]);
    }
}
