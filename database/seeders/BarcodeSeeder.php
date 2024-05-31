<?php

namespace Database\Seeders;

use App\Models\Barcode;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1500; $i++) {
            Barcode::factory()->create([
                'code' => "INA-" . Str::padLeft($i + 1, 4, '0')
            ]);
        }
    }
}
