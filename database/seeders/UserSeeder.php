<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@vetcare.pt'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );

        $admin->syncRoles(['admin']);


        $ana = User::updateOrCreate(
            ['email' => 'ana@email.pt'],
            [
                'name' => 'Ana Silva',
                'password' => Hash::make('password'),
            ]
        );

        $ana->syncRoles(['user']);


        $joao = User::updateOrCreate(
            ['email' => 'joao@email.pt'],
            [
                'name' => 'João Santos',
                'password' => Hash::make('password'),
            ]
        );

        $joao->syncRoles(['user']);


        $maria = User::updateOrCreate(
            ['email' => 'maria@email.pt'],
            [
                'name' => 'Maria Costa',
                'password' => Hash::make('password'),
            ]
        );

        $maria->syncRoles(['user']);
    }
}
