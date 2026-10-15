<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $ana = Professional::create(['name' => 'Dra. Ana Costa', 'specialty' => 'Clínica Geral']);
        $bruno = Professional::create(['name' => 'Dr. Bruno Lima', 'specialty' => 'Cardiologia']);

        Appointment::insert([
            ['professional_id' => $ana->id, 'patient_name' => 'Mariana Alves', 'scheduled_at' => now()->setTime(9, 0), 'status' => 'confirmed', 'notes' => null, 'created_at' => now(), 'updated_at' => now()],
            ['professional_id' => $bruno->id, 'patient_name' => 'Rafael Nunes', 'scheduled_at' => now()->setTime(10, 30), 'status' => 'pending', 'notes' => 'Primeira consulta', 'created_at' => now(), 'updated_at' => now()],
            ['professional_id' => $ana->id, 'patient_name' => 'Sofia Martins', 'scheduled_at' => now()->setTime(14, 0), 'status' => 'cancelled', 'notes' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
