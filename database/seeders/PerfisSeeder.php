<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curso = new Perfil();
        $curso->nome = 'Admin';
        $curso->save();
    
        $curso = new Perfil();
        $curso->nome = 'Empresa';
        $curso->save();

        $curso = new Perfil();
        $curso->nome = 'Estudante';
        $curso->save();
    }
}
