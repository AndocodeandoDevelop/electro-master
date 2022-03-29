<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    private $mensaje = ['required' => 'El campo :attribute es obligatorio'];

    /**
     * Funcion que permite acceder a la vista administrador de las categorias
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categoriasAdmin(){
        return view('categorias.admin', ['categorias' => Categoria::all()]);
    }

    /**
     * Funcion que permite crear una categoria
     * @param Request $datos
     * Parametro 'nombre': Nombre de la categoria
     * Parametro 'descripcion': Descripcion de la categoria
     * Parametro 'slug': Slug de la categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function agregarCategoria(Request $datos){
        try{
            $validacion = Validator::make($datos->all(), [
                'nombre' => 'required',
                'descripcion' => 'required',
                'slug' => 'required',
            ], $this->mensaje);
            if ($validacion->fails()){
                Session::flash('faltanDatos', $validacion->errors()->first());
                return redirect()->back()->withErrors($validacion)->withInput();
            }
            $slug = Categoria::where('slug', $datos->slug)->first();
            if ($slug){
                Session::flash('slugExistente', 'El slug ya existe');
                return redirect()->route('categoria.admin.vista');
            }
            Categoria::create($datos->all());
            DB::commit();
            Session::flash('agregado', 'La categoria se ha agregado correctamente');
            return redirect()->route('categoria.admin.vista');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Ocurrio un error al agregar la categoria. Por favor Contacte al administrador');
            return redirect()->route('categoria.admin.vista');
        }
    }

    /**
     * Funcion que permite buscar la informaicon de una categoria para editarla en base al id
     * @param $id
     * @return false|string
     */
    public function buscarCategoria($id){
        try{
            $categoria = Categoria::find($id);
            if(!$categoria)
                return json_encode(['estatus' => 'sinCategoria', 'mensaje' => 'No se encontro la categoria']);

            return json_encode(['estatus' => 'encontrado', 'categoria' => $categoria]);
        }catch (\Exception $e){
            return json_encode(['estatus' => 'error', 'mensaje' => 'Ocurrio un error al buscar la categoria.
            Por favor Contacte al administrador']);
        }
    }

    /**
     * Funcion que permite editar la informacion de una categoria
     * Parametro 'idEditar': Id de la categoria a editar
     * Parametro 'nombreEditar': Nombre de la categoria
     * Parametro 'descripcionEditar': Descripcion de la categoria
     * Parametro 'slugEditar': Slug de la categoria
     * @param Request $datos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editarCategoria(Request $datos){
        try{
            $validacion = Validator::make($datos->all(), [
                'nombreEditar' => 'required',
                'descripcionEditar' => 'required',
                'slugEditar' => 'required',
            ], $this->mensaje);

            if ($validacion->fails()){
                Session::flash('faltanDatos', $validacion->errors()->first());
                return redirect()->back()->withErrors($validacion)->withInput();
            }

            $datos->request->add(['nombre' => $datos->nombreEditar, 'descripcion' => $datos->descripcionEditar,
                'slug' => $datos->slugEditar]);
            $categoria = Categoria::find($datos->idEditar);
            $categoria->fill($datos->all());
            $categoria->save();
            DB::commit();
            Session::flash('editado', 'La categoria se ha editado correctamente');
            return redirect()->route('categoria.admin.vista');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Ocurrio un error al editar la categoria. Por favor Contacte al administrador');
            return redirect()->route('categoria.admin.vista');
        }
    }

    /**
     * Funcion que permite eliminar una categoria en base al id
     * @param $id
     * @return false|string
     */
    public function eliminarCategoria($id){
        try{
            $categoria = Categoria::find($id);
            if(!$categoria)
                return json_encode(['estatus' => 'sinCategoria', 'mensaje' => 'No se encontro la categoria']);

            $categoria->delete();
            DB::commit();
            return json_encode(['estatus' => 'eliminado', 'mensaje' => 'La categoria se ha eliminado correctamente']);
        }catch (\Exception $e){
            DB::rollBack();
            return json_encode(['estatus' => 'error', 'mensaje' => 'Ocurrio un error al eliminar la Categoria.
            Por favor Contacte al administrador']);
        }
    }

}
