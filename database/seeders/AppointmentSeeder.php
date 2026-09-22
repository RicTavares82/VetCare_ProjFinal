<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Veterinarian;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $max = Pet::where('name', 'Max')->firstOrFail();

        $pedro = Veterinarian::where('email', 'pedro@vetcare.pt')->firstOrFail();
        $sofia = Veterinarian::where('email', 'sofia@vetcare.pt')->firstOrFail();

        $consultaRotina = Service::where('name', 'Consulta de rotina')->firstOrFail();
        $vacinacao = Service::where('name', 'Vacinação')->firstOrFail();

        $consulta1 = Appointment::updateOrCreate(
            [
                'pet_id' => $max->id,
                'appointment_date' => '2026-09-12 10:00:00',
            ],
            [
                'veterinarian_id' => $pedro->id,
                'reason' => 'Consulta de rotina',
                'status' => 'Realizada',
            ]
        );

        $consulta2 = Appointment::updateOrCreate(
            [
                'pet_id' => $max->id,
                'appointment_date' => '2026-11-20 15:00:00',
            ],
            [
                'veterinarian_id' => $sofia->id,
                'reason' => 'Vacinação',
                'status' => 'Agendada',
            ]
        );

        $consulta1->services()->sync([
            $consultaRotina->id,
        ]);

        $consulta2->services()->sync([
            $vacinacao->id,
        ]);

    }
}
