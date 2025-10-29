<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boat;

class BoatsTableSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan beberapa perahu
        Boat::create([
            'name' => 'Perahu 1',
            'code' => 'BT-001',
            'status' => 'available',
            'capacity' => 6,
            'notes' => 'Perahu standar untuk rafting',
        ]);

        Boat::create([
            'name' => 'Perahu 2',
            'code' => 'BT-002',
            'status' => 'available',
            'capacity' => 8,
            'notes' => 'Perahu besar untuk grup',
        ]);

        Boat::create([
            'name' => 'Perahu 3',
            'code' => 'BT-003',
            'status' => 'available',
            'capacity' => 4,
            'notes' => 'Perahu kecil untuk keluarga',
        ]);
    }
}