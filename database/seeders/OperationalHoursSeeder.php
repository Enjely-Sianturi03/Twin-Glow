<?php

namespace Database\Seeders;

use App\Models\OperationalHours;
use Illuminate\Database\Seeder;

class OperationalHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operationalHours = [
            [
                'day' => 'Senin',
                'open_time' => '09:00',
                'close_time' => '19:00',
                'is_open' => true
            ],
            [
                'day' => 'Selasa',
                'open_time' => '09:00',
                'close_time' => '19:00',
                'is_open' => true
            ],
            [
                'day' => 'Rabu',
                'open_time' => '09:00',
                'close_time' => '19:00',
                'is_open' => true
            ],
            [
                'day' => 'Kamis',
                'open_time' => '09:00',
                'close_time' => '19:00',
                'is_open' => true
            ],
            [
                'day' => 'Jumat',
                'open_time' => '09:00',
                'close_time' => '19:00',
                'is_open' => true
            ],
            [
                'day' => 'Sabtu',
                'open_time' => '09:00',
                'close_time' => '18:00',
                'is_open' => true
            ],
            [
                'day' => 'Minggu',
                'open_time' => '10:00',
                'close_time' => '16:00',
                'is_open' => true
            ]
        ];

        foreach ($operationalHours as $hours) {
            OperationalHours::create($hours);
        }
    }
} 