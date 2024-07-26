<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curso = new Curso();
        $curso->curso = 'Licenciatura Integrada em Ciências, Matemática e Linguagens';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
        
        $curso = new Curso();
        $curso->curso = 'Matemática';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
        
        $curso = new Curso();
        $curso->curso = 'Biologia';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
        
        $curso = new Curso();
        $curso->curso = 'Letras-Português ';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
                
        $curso = new Curso();
        $curso->curso = 'Química';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();

        $curso = new Curso();
        $curso->curso = 'Física';
        $curso->modalidade = 'Licenciatura';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
        
        $curso = new Curso();
        $curso->curso = 'Sistemas De Informação';
        $curso->modalidade = 'Bacharel';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
   
        $curso->save();
        $curso = new Curso();
        $curso->curso = 'Ciência da computação';
        $curso->modalidade = 'Bacharel';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
   
        $curso = new Curso();
        $curso->curso = 'Engenharia da computação';
        $curso->modalidade = 'Bacharel';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
   
        $curso = new Curso();
        $curso->curso = 'Analise e desenvolvimento de sistemas';
        $curso->modalidade = 'Tecnólogo';
        $curso->regimeOferta = 'Extensivo';
        $curso->turno = 'A Distância';
        $curso->save();
        

    }
}
