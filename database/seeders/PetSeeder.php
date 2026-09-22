<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\User;
use App\Models\Species;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ana = User::where('email', 'ana@email.pt')->firstOrFail();
        $joao = User::where('email', 'joao@email.pt')->firstOrFail();
        $maria = User::where('email', 'maria@email.pt')->firstOrFail();

        $cao = Species::where('name', 'Cão')->firstOrFail();
        $gato = Species::where('name', 'Gato')->firstOrFail();
        $coelho = Species::where('name', 'Coelho')->firstOrFail();

        Pet::updateOrCreate(
            [
                'name' => 'Max',
                'user_id' => $ana->id,
            ],
            [
                'species_id' => $cao->id,
                'birth_date' => '2021-03-12',
                'weight' => 24.50,
                'sex' => 'Macho',
                'description' => 'Animal sociável. Sem alergias conhecidas.',
                'active' => true,
            ]
        );

        Pet::updateOrCreate(
            [
                'name' => 'Luna',
                'user_id' => $joao->id,
            ],
            [
                'species_id' => $gato->id,
                'birth_date' => '2022-08-07',
                'weight' => null,
                'sex' => null,
                'description' => null,
                'active' => true,
            ]
        );

        Pet::updateOrCreate(
            [
                'name' => 'Tobias',
                'user_id' => $maria->id,
            ],
            [
                'species_id' => $coelho->id,
                'birth_date' => '2024-01-15',
                'weight' => null,
                'sex' => null,
                'description' => null,
                'active' => false,
            ]
        );
    }
}
