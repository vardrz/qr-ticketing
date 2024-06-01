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
        // Mempercepat insert banyak data menggunaan chunk
        $dataToInsert = collect([]);
        $totalData = 1500;

        for ($i = 1; $i <= $totalData; $i++) {
            $dataToInsert->push([
                'code' => "INA-" . Str::padLeft($i, 4, '0')
            ]);
        }

        $dataChunks = $dataToInsert->chunk(500);

        foreach ($dataChunks as $chunk) {
            Barcode::insert($chunk->toArray());
        }
    }
}
