<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no usas created_at y updated_at

    protected $fillable = ['titulo', 'autor_id', 'editorial_id', 'ano_publicacion', 'isbn', 'cantidad', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_libro');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_libro');
    }

    
}

