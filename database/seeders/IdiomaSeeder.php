<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $idiomas = [
            "Inglês",
            "Espanhol",
            "Francês",
            "Alemão",
            "Italiano",
            "Chinês",
            "Japonês",
            "Coreano",
            "Russo",
            "Árabe",
            "Português",
            "Hindi",
            "Bengali",
            "Urdu",
            "Turco",
            "Vietnamita",
            "Tailandês",
            "Grego",
            "Holandês",
            "Sueco",
            "Norueguês",
            "Dinamarquês",
            "Finlandês",
            "Polonês",
            "Tcheco",
            "Húngaro",
            "Romeno",
            "Hebraico",
            "Indonésio",
            "Malaio"
        ];


        foreach ($idiomas as $idioma) {
            Idioma::firstOrCreate([
                "nome" => $idioma
            ]);
        }
    }
}
