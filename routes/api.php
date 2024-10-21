<?php

use App\Http\Controllers\AuthEmpresaController;
use App\Http\Controllers\AuthEstudanteController;
use App\Http\Controllers\ConquistaEstudanteController;
use App\Http\Controllers\CurriculoEstudanteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FormacaoAcademicaController;
use App\Http\Controllers\HabilidadeEstudanteController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\IdiomaEstudanteController;
use App\Http\Controllers\RegisterUsuarioEmpresa;
use App\Http\Controllers\RegisterUsuarioEstudante;
use App\Http\Controllers\UpdateUsuarioEstudanteController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\VagaEstudanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'api'], function ($router): void {

    Route::post('estudante/registrar', RegisterUsuarioEstudante::class)->name('auth.estudante.register');
    Route::post('empresa/registrar', RegisterUsuarioEmpresa::class)->name('auth.empresa.register');
    Route::group(['prefix' => 'auth'], function ($router): void {

        Route::group(['prefix' => 'estudante'], function ($router): void {

            Route::post('login', [AuthEstudanteController::class, 'login'])->name('auth.estudante.login');

            Route::group(['middleware' => 'auth:estudante'], function ($router) {

                Route::get('me', [AuthEstudanteController::class, 'me'])->name('auth.estudante.me');
                Route::post('logout', [AuthEstudanteController::class, 'logout'])->name('auth.estudante.logout');
            });
        });
        Route::group(['prefix' => 'empresa'], function ($router): void {

            Route::post('login', [AuthEmpresaController::class, 'login'])->name('auth.empresa.login');
            Route::group(['middleware' => 'auth:empresa'], function ($router) {

                Route::get('me', [AuthEmpresaController::class, 'me'])->name('auth.empresa.me');
                Route::post('logout', [AuthEmpresaController::class, 'logout'])->name('auth.empresa.logout');
            });
        });
    });

    Route::group(['prefix' => 'empresa', 'middleware' => 'auth:empresa'], function ($router) {

        Route::group(['prefix' => 'vaga'], function ($router): void {
            Route::get('/minhas-vagas', [VagaController::class, 'showVagasByEmpresaAuth'])->name('vaga.minhas-vagas');
            Route::post('', [VagaController::class, 'store'])->name('vaga.store');
            Route::put('/{vaga}', [VagaController::class, 'update'])->name('vaga.update');
            Route::delete('/{vaga}', [VagaController::class, 'destroy'])->name('vaga.destroy');
        });

    });

    Route::group(['prefix' => 'estudante', 'middleware' => 'auth:estudante'], function ($router) {

        Route::group(['prefix' => 'vaga'], function ($router): void {
            Route::get('/minhas-vagas', [VagaEstudanteController::class, 'showVagasByEstudanteAuth'])->name('vaga.minhas-vagas');
            Route::get('/inscrever/{vaga}', [VagaEstudanteController::class, 'inscreverEstudanteVaga'])->name('vaga.inscrever');
            Route::get('/remover-inscricao/{vaga}', [VagaEstudanteController::class, 'removerInscricao'])->name('vaga.remover-inscricao');
        });
        Route::group(['prefix' => 'formacao-academica'], function ($router) {
            Route::get('minhas-formacoes', [FormacaoAcademicaController::class, 'getByEstudanteAutenticado'])->name('formacao-academica.minhas-formacoes');
            Route::post('', [FormacaoAcademicaController::class, 'store'])->name('formacao-academica.store');
            Route::put('/{formacaoAcademica}', [FormacaoAcademicaController::class, 'update'])->name('formacao-academica.update');
            Route::delete('/{formacaoAcademica}', [FormacaoAcademicaController::class, 'destroy'])->name('formacao-academica.destroy');

        });

        Route::group(['prefix' => 'idioma'], function ($router): void {
            Route::get('meus-idiomas', [IdiomaEstudanteController::class, 'showByEstudanteAutenticado'])->name('idioma.meus-idiomas');


            Route::post('', [IdiomaEstudanteController::class, 'store'])->name('idioma.store');
            Route::put('/{idiomaEstudante}', [IdiomaEstudanteController::class, 'update'])->name('idioma.update');
            Route::delete('/{idiomaEstudante}', [IdiomaEstudanteController::class, 'destroy'])->name('idioma.destroy');


        });

        Route::group(['prefix' => 'conquista'], function ($router): void {

            Route::get('minhas-conquistas', [ConquistaEstudanteController::class, 'showByEstudanteAutenticado'])->name('conquista.meus-conquistas');
            Route::post('', [ConquistaEstudanteController::class, 'store'])->name('conquista.store');
            Route::put('/{conquistaEstudante}', [ConquistaEstudanteController::class, 'update'])->name('conquista.update');
            Route::delete('/{conquistaEstudante}', [ConquistaEstudanteController::class, 'destroy'])->name('conquista.destroy');

        });

        Route::group(['prefix' => 'habilidade'], function ($router): void {

            Route::get('minhas-habilidades', [HabilidadeEstudanteController::class, 'showByEstudanteAutenticado'])->name('habilidade.meus-conquistas');
            Route::post('', [HabilidadeEstudanteController::class, 'store'])->name('habilidade.store');
            Route::put('/{habilidadeEstudante}', [HabilidadeEstudanteController::class, 'update'])->name('habilidade.update');
            Route::delete('/{habilidadeEstudante}', [HabilidadeEstudanteController::class, 'destroy'])->name('habilidade.destroy');

        });

        Route::group(['prefix' => 'curriculo'], function ($router): void {

            Route::get('meu-curriculo', [CurriculoEstudanteController::class, 'showByEstudanteAutenticado'])->name('curriculo.meu-curriculo');
            Route::post('', [CurriculoEstudanteController::class, 'store'])->name('curriculo.store');
            Route::put('', [CurriculoEstudanteController::class, 'update'])->name('curriculo.update');
            Route::delete('', [CurriculoEstudanteController::class, 'destroy'])->name('curriculo.destroy');

        });

        Route::put('meus-dados', [UpdateUsuarioEstudanteController::class])->name('estudante.update');


    });
    Route::group(['prefix' => 'vaga'], function ($router) {
        Route::get('', [VagaController::class, 'index'])->name('vaga.index');
        Route::get('/{vaga}', [VagaController::class, 'show'])->name('vaga.show');

    });

    Route::get('/idiomas', IdiomaController::class)->name('idiomas.index');
    Route::get('/cursos', CursoController::class)->name('cursos.index');
});
