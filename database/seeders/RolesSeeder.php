<?php

namespace Database\Seeders;

use App\Models\UsuarioRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuarioRoles::create([
            'CodUsu' => 10,
            'CodRol' => 1,
            'EstUM' => 1,
            'RegUR' => '2020/12/12'
        ]);
    }
}
