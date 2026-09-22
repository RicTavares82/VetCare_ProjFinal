<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Service::updateOrCreate(
            ['name' => 'Consulta de rotina'],
            [
                'description' => 'Consulta geral para avaliação do estado de saúde do animal.',
                'price' => 30.00,
                'active' => true,
            ]
        );

        Service::updateOrCreate(
            ['name' => 'Vacinação'],
            [
                'description' => 'Administração de vacinas adequadas à espécie e idade do animal.',
                'price' => 25.00,
                'active' => true,
            ]
        );

        Service::updateOrCreate(
            ['name' => 'Cuidados gerais'],
            [
                'description' => 'Serviços complementares de saúde e bem-estar animal.',
                'price' => 20.00,
                'active' => true,
            ]
        );

    }
}
