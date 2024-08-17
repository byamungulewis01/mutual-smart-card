<?php

namespace Database\Seeders;

use App\Models\MutualCategory;
use App\Models\Setting;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'UWAYEZU Violette',
            'email' => 'uwaviolette@gmail.com',
            'phone' => '0788667776',
            'role' => 'admin',
            'password' => 'password',
        ]);
        Setting::create([
            'name' => 'payment',
            'value' => false,
        ]);

        MutualCategory::create([
            'name' => 'A',
            'amount' => 1200,
        ]);
        MutualCategory::create([
            'name' => 'B',
            'amount' => 9000,
        ]);
        MutualCategory::create([
            'name' => 'C',
            'amount' => 6000,
        ]);
        MutualCategory::create([
            'name' => 'D',
            'amount' => 3000,
        ]);
    }
}
