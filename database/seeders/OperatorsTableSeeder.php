<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Operator;

class OperatorsTableSeeder extends Seeder
{
    public function run()
    {
        // Cari semua user dengan role boatman
        $boatmen = User::where('role', 'boatman')->get();
        
        foreach ($boatmen as $boatman) {
            // Periksa apakah sudah ada operator untuk boatman ini
            $existingOperator = Operator::where('user_id', $boatman->id)->first();
            
            if (!$existingOperator) {
                // Buat operator baru jika belum ada
                Operator::create([
                    'user_id' => $boatman->id,
                    'nama' => $boatman->name,
                    'telepon' => $boatman->phone ?? '0812345678',
                    'status_aktif' => true,
                    'max_tugas_per_hari' => 5,
                ]);
            }
        }
    }
}