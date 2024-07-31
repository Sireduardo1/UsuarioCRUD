<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Libro;
use App\Models\Prestamo;
use Exception;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function reservarLibro(Request $request)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|integer|exists:usuarios,id',
                'id_libro' => 'required|integer|exists:libros,id'
            ]);

            $buscar_reserva = Reserva::where('id_usuario', $request->id_usuario)
                ->where('id_libro', $request->id_libro)
                ->where('estado_reserva', 'pendiente')
                ->first();

            if ($buscar_reserva) {
                return response()->json(['message' => 'El usuario ya tiene una reserva pendiente de ese libro'], 400);
            }

            $crear_reserva = Reserva::create([
                'id_usuario' => $request->id_usuario,
                'id_libro' => $request->id_libro,
                'fecha_reserva'=> now(),
                'fecha_confirm_reserva' => null,
                'estado_reserva' => 'pendiente'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reservado correctamente',
                'reserva' => $crear_reserva
            ], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
