<?php

namespace App\Services;

use App\Models\Vaga;
use App\Models\VagaCurso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VagaService
{
    public function save(array $data, int $userID): Model|Vaga
    {
        return DB::transaction(function () use ($data, $userID) {
            // Criação da vaga
            $vaga = Vaga::create([
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'tipo_estagio' => $data['tipo_estagio'],
                'turno' => $data['turno'],
                'valor' => $data['valor'] ?? null,
                'usuario_empresa_id' => $userID,
            ]);

            // Relacionamento com cursos
            $this->syncCursos($vaga, $data['cursos']);

            return $vaga->load('cursos');
        });
    }

    public function update(array $data, Vaga $vaga): Model|Vaga
    {
        return DB::transaction(function () use ($data, $vaga) {
            // Atualização da vaga
            $vaga->update([
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'tipo_estagio' => $data['tipo_estagio'],
                'turno' => $data['turno'],
                'valor' => $data['valor'] ?? null,
            ]);

            // Atualizar relacionamento com cursos
            if (isset($data['cursos']) && !empty($data['cursos'])) {
                $this->syncCursos($vaga, $data['cursos']);
            }

            return $vaga->load('cursos');
        });
    }

    private function syncCursos(Vaga $vaga, array $cursos): void
    {
        // Sincroniza os cursos da vaga, removendo os antigos e inserindo os novos
        $vaga->cursos()->sync($cursos);
    }
}
