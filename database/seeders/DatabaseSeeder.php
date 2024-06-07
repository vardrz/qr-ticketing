<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebConfig;
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
            BarcodeSeeder::class,
        ]);

        WebConfig::create(['maintenance' => 'no']);

        User::factory()->create([
            'name' => 'Fadil',
            'email' => 'test@example.com',
            'password' => 'agsa2024'
        ]);
        User::factory()->create([
            'name' => 'Farid',
            'email' => 'fatkhurrozakf@gmail.com',
            'password' => 'agsa2024'
        ]);
        User::factory()->create([
            'name' => 'BEM STMIK WP',
            'email' => 'sekrebemstmikwp@example.com',
            'password' => 'bemstmikwp2024'
        ]);
    }
}
