<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Species;


class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Species::updateOrCreate(
            ['name' => 'Cão']
        );

        Species::updateOrCreate(
            ['name' => 'Gato']
        );

        Species::updateOrCreate(
            ['name' => 'Coelho']
        );
    }
}
