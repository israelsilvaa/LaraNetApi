<?php

namespace App\Services;

use App\Models\Vaga;
use App\Models\VagaCurso;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VagaService
{

    public function search(array $data): Vaga|Builder
    {
        return Vaga::orderBy('nome')
            ->when(isset($data['nome']) && $data['nome'], function ($query) use ($data) {
                $query->where('nome', 'like', '%' . $data['nome'] . '%');
            })
            ->when(isset($data['descricao']) && $data['descricao'], function ($query) use ($data) {
                $query->where('descricao', 'like', '%' . $data['descricao'] . '%');
            })
            ->when(isset($data['tipo_estagio']) && $data['tipo_estagio'], function ($query) use ($data) {
                $query->where('tipo_estagio', $data['tipo_estagio']);
            })
            ->when(isset($data['turno']) && $data['turno'], function ($query) use ($data) {
                $query->where('turno', $data['turno']);
            })
            ->when(isset($data['nome_empresa']) && $data['nome_empresa'], function ($query) use ($data) {
                $query->searchByEmpresaName($data['nome_empresa']);
            })
            ->when(isset($data['cursos']) && is_array($data['cursos']) && count($data['cursos']) > 0, function ($query) use ($data) {
                $query->whereHas('cursos', function ($query) use ($data) {
                    $query->whereIn('curso_id', $data['cursos']);
                });
            });
    }
    public function getVagasByEmpresa(int $empresaID): Vaga|Builder
    {

        $vagas = Vaga::where('usuario_empresa_id', $empresaID);

        return $vagas;
    }
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
