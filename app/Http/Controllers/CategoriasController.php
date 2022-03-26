<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function categoriasVista(){
        $categorias = Categoria::all();
        return view('categorias.inicio', ['categorias' => $categorias]);
    }
}
