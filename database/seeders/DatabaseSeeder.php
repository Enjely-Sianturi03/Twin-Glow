<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            OperationalHoursSeeder::class,
<<<<<<< HEAD
=======
            BeautyArticlesSeeder::class,
>>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb
        ]);
    }
}
