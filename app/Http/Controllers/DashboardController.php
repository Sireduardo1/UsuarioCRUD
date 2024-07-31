<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mostrarEstadisticas(Request $request)
    {
        $categorias = Categoria::all();
        $autores = Autor::all();
        $editoriales = Editorial::all();
        $libros = Libro::with(['autor', 'editorial', 'categoria'])->get();
        // Añadiendo más estadísticas
        $totalLibros = $libros->count();
        $totalPrestamos = Prestamo::count();
        $librosDisponibles = $libros->where('disponibilidad', '>', 0)->count();
        $librosReservados = $libros->where('estado', 'reservado')->count();
        
        // Obtener usuarios relevantes (ejemplo: usuarios con más préstamos)
        $usuariosRelevantes = User::withCount('prestamos')->orderBy('prestamos_count', 'desc')->take(5)->get();

        return view('dashboard')->with([
            'categorias' => $categorias,
            'autores' => $autores,
            'editoriales' => $editoriales,
            'libros'=> $libros,
            'totalLibros' => $totalLibros,
            'totalPrestamos' => $totalPrestamos,
            'librosDisponibles' => $librosDisponibles,
            'librosReservados' => $librosReservados,
            'usuariosRelevantes' => $usuariosRelevantes
        ]);
    }
}
