<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return redirect()->route('produtos.index');
});

Route::get('/cadastro', [UsuarioController::class, 'create'])->name('cadastro.create');
Route::post('/cadastro', [UsuarioController::class, 'store'])->name('cadastro.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::resource('produtos', ProdutoController::class)->except(['index', 'show']);

    Route::resource('categorias', CategoriaController::class)->except(['show']);

    Route::get('/alternar-tema', [TemaController::class, 'alternar'])->name('tema.alternar');

    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::delete('/perfil', [PerfilController::class, 'destroy'])->name('perfil.destroy');
});
