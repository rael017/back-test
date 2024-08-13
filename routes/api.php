<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstrategiaWMSController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('estrategia-wms')->group(function () {
    // Rota para criar uma nova estratégia
    Route::post('/', [EstrategiaWMSController::class, 'store']);

    // Rota para buscar a prioridade de uma estratégia com base em hora e minuto
    Route::get('/{cdEstrategia}/{dsHora}-{dsMinuto}/prioridade', [EstrategiaWMSController::class, 'getPrioridade']);

    // Rota para buscar todas as estratégias com um nível de prioridade específico
    Route::get('/prioridade/{nrPrioridade}', [EstrategiaWMSController::class, 'getByPrioridade']);

    // Rota para retornar todas as estratégias cadastradas
    Route::get('/all', [EstrategiaWMSController::class, 'getAll']);

    // Rota para buscar todos os horários e prioridades de uma estratégia específica
    Route::get('/{cdEstrategia}/horarios', [EstrategiaWMSController::class, 'getHorariosPorEstrategia']);

     // Rota para atualizar uma estratégia WMS existente
    Route::put('/{cdEstrategia}', [EstrategiaWMSController::class, 'update']);

    // Rota para deletar uma estratégia WMS existente
    Route::delete('/{cdEstrategia}', [EstrategiaWMSController::class, 'destroy']);
});