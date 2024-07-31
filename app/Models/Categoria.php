<?php

// app/Models/Categoria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = false; // Desactiva las marcas de tiempo automáticas

    protected $fillable = [
        'nombre_categoria',
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'id');
    }
}

