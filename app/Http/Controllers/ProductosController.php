<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function productosVista(){
        $productos = Producto::all();
        return view('productos.inicio', ['productos' => $productos]);
    }
}
