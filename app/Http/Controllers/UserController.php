<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function mostrarUsers(Request $request)
    {

        $get_users = User::all();  
        return view('Usuario')->with(['users' => $get_users]);
    }

    public function guardarUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'nullable|string',
                'password' => 'required|string',
                'created_at' => 'required|date',
                'updated_at' => 'required|date',
                'tipo_usuario' => 'nullable|string',
            ]);

           

            // Crear y guardar el nuevo Usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->created_at = $request->created_at;
            $user->updated_at = $request->updated_at;
            $user->tipo_usuario = $request->tipo_usuario;
            $user->save();

            return Response()->json(['message' => 'Usuario guardado exitosamente']);
        } catch (Exception $e) {
            Log::error('Error al guardar el Usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar el Usuario: ' . $e->getMessage()], 500);
        }
    }

    public function actualizarUser(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'id' => 'required|integer|exists:users,id',
                'nameedit' => 'required|string',
                'emailedit' => 'required|string|email',
                'tipo_usuarioedit' => 'nullable|string'
            ]);
    
            // Log the request data for debugging
            Log::info('Request data: ', $request->all());
    
            // Find the user by ID
            $user = User::findOrFail($request->id);
    
            // Update user fields
            $user->name = $request->nameedit;
            $user->email = $request->emailedit;
            $user->tipo_usuario = $request->tipo_usuarioedit;
    
            // Save the user, while handling unique constraint violations
            $user->save();
    
            return response()->json(['message' => 'Usuario actualizado exitosamente']);
        } catch (QueryException $e) {
            // Check if the error is due to a unique constraint violation
            if ($e->getCode() == '23505') {
                return response()->json(['error' => 'El correo electrónico ya está en uso.'], 409);
            } else {
                Log::error('Error al actualizar el usuario: ' . $e->getMessage());
                return response()->json(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
            }
        } catch (Exception $e) {
            Log::error('Error al actualizar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
        }
    }

    public function eliminarUser(Request $request){
        try{
            $request->validate([
                'id_delete'=>'required|integer|exists:users,id'
            ]);

            $user = User::findOrFail($request->id_delete);

            $user->delete();

            return Response()->json(['message'=>'Usuario eliminado exitosamente'],200);
        }catch(ModelNotFoundException $e){
            return Response()->json(['message'=>'El Usuario buscado no se encuentra'],404);
        }catch(Exception $e){
            return Response()->json(['message'=>'Error al eliminar el usuario: '.$e->getMessage()], 500);
        }
    }
}
