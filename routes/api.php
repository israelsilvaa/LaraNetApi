<?php

use App\Http\Controllers\AuthEmpresaController;
use App\Http\Controllers\AuthEstudanteController;
use App\Http\Controllers\RegisterUsuarioEmpresa;
use App\Http\Controllers\RegisterUsuarioEstudante;
use App\Http\Controllers\VagaController;
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


Route::group(['middleware' => 'api'], function ($router) {

    Route::post('estudante/registrar', RegisterUsuarioEstudante::class)->name('auth.estudante.register');
    Route::post('empresa/registrar', RegisterUsuarioEmpresa::class)->name('auth.empresa.register');
    Route::group(['prefix' => 'auth'], function ($router) {

        Route::group(['prefix' => 'estudante'], function ($router) {

            Route::post('login', [AuthEstudanteController::class, 'login'])->name('auth.estudante.login');

            Route::group(['middleware' => 'auth:estudante'], function ($router) {

                Route::get('me', [AuthEstudanteController::class, 'me'])->name('auth.estudante.me');
                Route::post('logout', [AuthEstudanteController::class, 'logout'])->name('auth.estudante.logout');
            });
        });
        Route::group(['prefix' => 'empresa'], function ($router) {

            Route::post('login', [AuthEmpresaController::class, 'login'])->name('auth.empresa.login');
            Route::group(['middleware' => 'auth:empresa'], function ($router) {

                Route::get('me', [AuthEmpresaController::class, 'me'])->name('auth.empresa.me');
                Route::post('logout', [AuthEmpresaController::class, 'logout'])->name('auth.empresa.logout');
            });
        });
    });

    Route::group(['prefix' => 'empresa', 'middleware' => 'auth:empresa'], function ($router) {

        Route::group(['prefix' => 'vaga'], function ($router) {
            Route::get('/minhas-vagas', [VagaController::class, 'showVagasByEmpresaAuth'])->name('vaga.minhas-vagas');
            Route::post('', [VagaController::class, 'store'])->name('vaga.store');
            Route::put('/{vaga}', [VagaController::class, 'update'])->name('vaga.update');
            Route::delete('/{vaga}', [VagaController::class, 'destroy'])->name('vaga.destroy');
        });

    });

    Route::group(['prefix' => 'estudante', 'middleware' => 'auth:estudante'], function ($router) {

        Route::group(['prefix' => 'vaga'], function ($router) {
            Route::get('/inscrever/{vaga}', [VagaController::class, 'inscreverEstudanteVaga'])->name('vaga.inscrever');
            
        });

    });
    Route::group(['prefix' => 'vaga'], function ($router) {
        Route::get('', [VagaController::class, 'index'])->name('vaga.index');
        Route::get('/{vaga}', [VagaController::class, 'show'])->name('vaga.show');



    });


});
