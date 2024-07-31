<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Libro;
use App\Models\Prestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PrestamoController extends Controller
{
    public function prestarLibro(Request $request)
    {
        try {
            // Validate incoming request
            $validator = Validator::make($request->all(), [
                'id_usuario' => 'required|integer|exists:usuarios,id',
                'id_libro' => 'required|integer|exists:libros,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 400);
            }

            $libro = Libro::findOrFail($request->id_libro);
            $total_libro = $libro->cantidad;

            $total_prestamo = Prestamo::where('id_usuario', $request->id_usuario)
                ->where('id_libro', $request->id_libro)
                ->where('estado', 'prestado')
                ->count();

            Log::info('Total de libros encontrados: ' . $total_libro);
            Log::info('Total de préstamos encontrados: ' . $total_prestamo);

            $existencias = $total_libro-$total_prestamo;

            if ($existencias > 0) {
                // Crear el préstamo si hay unidades disponibles
                $prestamo = Prestamo::firstOrCreate([
                    'id_usuario' => $request->id_usuario,
                    'id_libro' => $request->id_libro,
                    'estado' => 'prestado',
                    'fecha_prestamo' => now(),
                    'fecha_devolucion' => now()->addDays(14) // Ejemplo de fecha de devolución a 14 días
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Préstamo registrado correctamente',
                    'prestamo' => $prestamo
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay unidades disponibles para el préstamo',
                ], 400);
            }
        } catch (Exception $e) {

            return Response()->json(['message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
