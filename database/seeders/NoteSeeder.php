<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\User;
use App\Models\Appointment;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::where('email', 'admin@vetcare.pt')->firstOrFail();

        $max = Pet::where('name', 'Max')->firstOrFail();

        $consulta = Appointment::where('pet_id', $max->id)
            ->where('appointment_date', '2026-09-12 10:00:00')
            ->firstOrFail();

        // Nota associada ao animal
        $max->notes()->updateOrCreate(
            [
                'user_id' => $admin->id,
                'body' => 'Animal em bom estado geral. Recomenda-se controlo de peso.',
            ]
        );

        // Nota associada a uma consulta
        $consulta->notes()->updateOrCreate(
            [
                'user_id' => $admin->id,
                'body' => 'Consulta realizada sem complicações.',
            ]
        );
    }
}
