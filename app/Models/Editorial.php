<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'editoriales'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $primaryKey = 'id'; // Clave primaria
    public $timestamps = false; // Desactiva las marcas de tiempo automáticas
    
    protected $fillable = ['nombre'];

    public function libros()
    {
        return $this->hasMany(Libro::class,'id');
    }
}
