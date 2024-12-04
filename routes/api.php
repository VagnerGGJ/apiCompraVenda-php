<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Rotas para usuario
Route::group(['prefix' => 'usuario'], function () {
    Route::get('/', [UsuarioController::class, 'index']);
    Route::get('search', [UsuarioController::class, 'search']);
    Route::post('/', [UsuarioController::class, 'store']);
    Route::get('{id}', [UsuarioController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [UsuarioController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [UsuarioController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para forma de pagamento
Route::group(['prefix' => 'formapagamento'], function () {
    Route::get('/', [FormaPagamentoController::class, 'index']);
    Route::get('search', [FormaPagamentoController::class, 'search']);
    Route::post('/', [FormaPagamentoController::class, 'store']);
    Route::get('{id}', [FormaPagamentoController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [FormaPagamentoController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [FormaPagamentoController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para produto
Route::group(['prefix' => 'produto'], function () {
    Route::get('/', [ProdutoController::class, 'index']);
    Route::get('search', [ProdutoController::class, 'search']);
    Route::post('/', [ProdutoController::class, 'store']);
    Route::get('{id}', [ProdutoController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [ProdutoController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [ProdutoController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para cliente
Route::group(['prefix' => 'cliente'], function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::get('search', [ClienteController::class, 'search']);
    Route::post('/', [ClienteController::class, 'store']);
    Route::get('{id}', [ClienteController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [ClienteController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [ClienteController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para fornecedor
Route::group(['prefix' => 'fornecedor'], function () {
    Route::get('/', [FornecedorController::class, 'index']);
    Route::get('search', [FornecedorController::class, 'search']);
    Route::post('/', [FornecedorController::class, 'store']);
    Route::get('{id}', [FornecedorController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [FornecedorController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [FornecedorController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para venda
Route::group(['prefix' => 'venda'], function () {
    Route::get('/', [VendaController::class, 'index']);
    Route::get('search', [VendaController::class, 'search']);
    Route::post('/', [VendaController::class, 'store']);
    Route::get('{id}', [VendaController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [VendaController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [VendaController::class, 'destroy'])->where('id', '[\d+]+');
});

//Rotas para compra
Route::group(['prefix' => 'compra'], function () {
    Route::get('/', [CompraController::class, 'index']);
    Route::get('search', [CompraController::class, 'search']);
    Route::post('/', [CompraController::class, 'store']);
    Route::get('{id}', [CompraController::class, 'show'])->where('id', '[\d+]+');
    Route::patch('{id}', [CompraController::class, 'update'])->where('id', '[\d+]+');
    Route::delete('{id}', [CompraController::class, 'destroy'])->where('id', '[\d+]+');
});

