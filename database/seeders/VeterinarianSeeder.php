<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veterinarian;

class VeterinarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Veterinarian::updateOrCreate(
            ['email' => 'pedro@vetcare.pt'],
            [
                'name' => 'Pedro Martins',
                'phone' => '912345670',
                'active' => true,
            ]
        );

        Veterinarian::updateOrCreate(
            ['email' => 'sofia@vetcare.pt'],
            [
                'name' => 'Sofia Costa',
                'phone' => '912345671',
                'active' => true,
            ]
        );
    }
}
