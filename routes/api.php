<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta para obtener todas las categorías
Route::get('/get-category', [CategoriaController::class, 'show']);

// Ruta para crear una nueva categoría
Route::post('/add-category', [CategoriaController::class, 'add']);
