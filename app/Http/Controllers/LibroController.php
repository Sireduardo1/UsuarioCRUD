<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Editorial;
use App\Models\Categoria;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LibroController extends Controller
{

    public function mostrarLibros(Request $request)
    {
        $get_categorias = Categoria::all();
        $get_autores = Autor::all();
        $get_editoriales = Editorial::all();
        $get_libros = Libro::with(['autor', 'editorial', 'categoria'])->get();  // Cargar las relaciones
        return view('libros')->with(['categorias' => $get_categorias, 'autores' => $get_autores, 'editoriales' => $get_editoriales, 'libros'=> $get_libros]);
    }

    public function guardarLibro(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string',
                'autor' => 'nullable|string',
                'editorial' => 'nullable|string',
                'ano_publicacion' => 'required|date',
                'isbn' => 'required|integer',
                'cantidad' => 'required|integer',
                'categoria' => 'nullable|string',
            ]);

            if ($request->filled('categoria')) {
                try {
                    $categoria = new Categoria();
                    $categoria->nombre_categoria = $request->categoria;
                    $categoria->save();
                    $categoria_id = $categoria->id;
                } catch (Exception $e) {
                    Log::error('Error al guardar la categoria: ' . $e->getMessage());
                    throw new Exception('Error al agregar nueva categoria: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar una categoría o crear una nueva.');
            }

            if ($request->filled('autor')) {
                try {
                    $autor = new Autor();
                    $autor->nombre = $request->autor;
                    $autor->save();
                    $autor_id = $autor->id;
                } catch (Exception $e) {
                    Log::error('Error al guardar el autor: ' . $e->getMessage());
                    throw new Exception('Error al agregar nuevo autor: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar un autor o crear uno nuevo.');
            }

            if ($request->filled('editorial')) {
                try {
                    $editorial = new Editorial();
                    $editorial->nombre = $request->editorial;
                    $editorial->save();
                    $editorial_id = $editorial->id;
                } catch (Exception $e) {
                    Log::error('Error al guardar la editorial: ' . $e->getMessage());
                    throw new Exception('Error al agregar nueva editorial: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar una editorial o crear uno nuevo.');
            }

            // Crear y guardar el nuevo libro
            $libro = new Libro();
            $libro->titulo = $request->titulo;
            $libro->autor_id = $autor_id;
            $libro->editorial_id = $editorial_id;
            $libro->ano_publicacion = $request->ano_publicacion;
            $libro->isbn = $request->isbn;
            $libro->cantidad = $request->cantidad;
            $libro->categoria_id = $categoria_id;
            $libro->save();

            return Response()->json(['message' => 'Libro guardado exitosamente']);
        } catch (Exception $e) {
            Log::error('Error al guardar el libro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar el libro: ' . $e->getMessage()], 500);
        }
    }

    public function actualizarLibro(Request $request)
    {
        try {
            // Validar los datos de la solicitud
            $request->validate([
                'id'=>'required|numeric',
                'tituloedit' => 'required|string',
                'autoredit' => 'nullable|string',
                'editorialedit' => 'nullable|string',
                'ano_publicacionedit' => 'required|date',
                'isbnedit' => 'required|integer',
                'cantidadedit' => 'required|integer',
                'categoriaedit' => 'nullable|string',
            ]);

            // Buscar el libro por ID
            $libro = Libro::findOrFail($request->id);

            // Manejar la categoría
            if ($request->filled('categoriaedit')) {
                try {
                    $categoria = Categoria::firstOrCreate(
                        ['nombre_categoria' => $request->categoriaedit]
                    );
                    $categoria_id = $categoria->id;
                } catch (Exception $e) {
                    Log::error('Error al actualizar la categoría: ' . $e->getMessage());
                    throw new Exception('Error al agregar nueva categoría: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar una categoría o crear una nueva.');
            }

            // Manejar el autor
            if ($request->filled('autoredit')) {
                try {
                    $autor = Autor::firstOrCreate(
                        ['nombre' => $request->autoredit]
                    );
                    $autor_id = $autor->id;
                } catch (Exception $e) {
                    Log::error('Error al actualizar el autor: ' . $e->getMessage());
                    throw new Exception('Error al agregar nuevo autor: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar un autor o crear uno nuevo.');
            }

            // Manejar la editorial
            if ($request->filled('editorialedit')) {
                try {
                    $editorial = Editorial::firstOrCreate(
                        ['nombre' => $request->editorialedit]
                    );
                    $editorial_id = $editorial->id;
                } catch (Exception $e) {
                    Log::error('Error al actualizar la editorial: ' . $e->getMessage());
                    throw new Exception('Error al agregar nueva editorial: ' . $e->getMessage());
                }
            } else {
                throw new Exception('Debe proporcionar una editorial o crear una nueva.');
            }

            // Actualizar los campos del libro
            $libro->titulo = $request->tituloedit;
            $libro->autor_id = $autor_id;
            $libro->editorial_id = $editorial_id;
            $libro->ano_publicacion = $request->ano_publicacionedit;
            $libro->isbn = $request->isbnedit;
            $libro->cantidad = $request->cantidadedit;
            $libro->categoria_id = $categoria_id;
            $libro->save();

            return response()->json(['message' => 'Libro actualizado exitosamente']);
        } catch (Exception $e) {
            Log::error('Error al actualizar el libro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el libro: ' . $e->getMessage()], 500);
        }
    }

    public function eliminarLibro(Request $request){
        try{
            $request->validate([
                'id_delete'=>'required|integer|exists:libros,id'
            ]);

            $libro = Libro::findOrFail($request->id_delete);

            $libro->delete();

            return Response()->json(['message'=>'Libro eliminado exitosamente'],200);
        }catch(ModelNotFoundException $e){
            return Response()->json(['message'=>'El libro buscado no se encuentra'],404);
        }catch(Exception $e){
            return Response()->json(['message'=>'Error al eliminar el libro: '.$e->getMessage()], 500);
        }
    }
}
