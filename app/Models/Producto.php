<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'precio_oferta',
        'categoria_id',
        'cantidad',
        'nombre_img',
        'ruta_img',
    ];

    /*Relacion uno a uno */
    public function categoria(){
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }
}
