<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $primaryKey = 'id'; // Clave primaria
    public $timestamps = false; // Desactiva las marcas de tiempo automáticas
    
    protected $fillable = ['nombre'];

    public function libros()
    {
        return $this->hasMany(Libro::class,'id');
    }
}
