<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductosController extends Controller
{
    private $mensaje = ['required' => 'El campo :attribute es obligatorio'];

    /**
     * Funcion que permite acceder a la vista administrador de los Productos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function productosAdmin(){
        return view('productos.admin', ['productos' => Producto::all(), 'categorias' => Categoria::all()]);
    }

    /**
     * Funcion que permite crear un producto
     * @param Request $datos
     * Parametro 'nombre': Nombre del Producto
     * Parametro 'descripcion': Descripcion del Producto
     * Parametro 'precio_compra': Precio de Compra del Producto
     * Parametro 'precio_venta': Precio de Venta del Producto
     * Parametro 'precio_oferta': Precio de Oferta del Producto
     * Parametro 'categoria_id': Categoria del Producto
     * Parametro 'cantidad': Cantidad del Producto
     * Parametro 'foto': Foto del Producto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function agregarProducto(Request $datos){
        try{
            $validacion = Validator::make($datos->all(), [
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio_compra' => 'required',
                'precio_venta' => 'required',
                'categoria_id' => 'required',
                'cantidad' => 'required',
                'foto' => 'required'
            ], $this->mensaje);
            if ($validacion->fails()){
                Session::flash('faltanDatos', $validacion->errors()->first());
                return redirect()->back()->withErrors($validacion)->withInput();
            }
            $carpeta = $this->carpetaProductos();

            $extension = $datos->file('foto')->getClientOriginalExtension();
            if($this->comprobarExtensiones($extension) == 0){
                Session::flash('extensionNoValida', 'La extensión del archivo no es válida. Por favor ingrese una foto con extensión .jpg, .jpeg, .png, .gif o webp');
                return redirect()->route('producto.admin.vista');
            }
            do{
                $nombreImagen = Str::random(10).date('_dmYHis');
            }while(Producto::where('nombre_img', $nombreImagen)->count() >= 1);
            $datos->file('foto')->move(public_path($carpeta.'/'), $nombreImagen.'.'.$extension);

            $datos->request->add(['nombre_img' => $nombreImagen, 'ruta_img' => $carpeta.'/'.$nombreImagen.'.'.$extension]);
            Producto::create($datos->all());
            DB::commit();
            Session::flash('agregado', 'El producto se ha agregado correctamente');
            return redirect()->route('producto.admin.vista');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Ocurrio un error al agregar el Producto. Por favor Contacte al administrador');
            return redirect()->route('producto.admin.vista');
        }
    }

    /**
     * Funcion que permite buscar la informaicon de un producto para editarla en base al id
     * @param $id
     * @return false|string
     */
    public function buscarProducto($id){
        try{
            $producto = Producto::find($id);
            if(!$producto)
                return json_encode(['estatus' => 'sinProducto', 'mensaje' => 'No se encontro el Producto']);

            return json_encode(['estatus' => 'encontrado', 'producto' => $producto]);
        }catch (\Exception $e){
            return json_encode(['estatus' => 'error', 'mensaje' => 'Ocurrio un error al buscar el Producto.
            Por favor Contacte al administrador']);
        }
    }

    /**
     * Funcion que permite editar la informacion de un producto
     * @param Request $datos
     * Parametro 'nombreEditar': Nombre del Producto
     * Parametro 'descripcionEditar': Descripcion del Producto
     * Parametro 'precio_compraEditar': Precio de Compra del Producto
     * Parametro 'precio_ventaEditar': Precio de Venta del Producto
     * Parametro 'precio_ofertaEditar': Precio de Oferta del Producto
     * Parametro 'categoria_idEditar': Categoria del Producto
     * Parametro 'cantidadEditar': Cantidad del Producto
     * Parametro 'fotoEditar': Foto del Producto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editarProducto(Request $datos){
        try{
            $validacion = Validator::make($datos->all(), [
                'nombreEditar' => 'required',
                'descripcionEditar' => 'required',
                'precio_compraEditar' => 'required',
                'precio_ventaEditar' => 'required',
                'categoria_idEditar' => 'required',
                'cantidadEditar' => 'required',
            ], $this->mensaje);
            if ($validacion->fails()){
                Session::flash('faltanDatos', $validacion->errors()->first());
                return redirect()->back()->withErrors($validacion)->withInput();
            }

            $producto = Producto::find($datos->idEditar);
            if(is_null($producto)){
                Session::flash('sinProducto', 'No se encontro el Producto con el id '.$datos->idEditar.'. Por favor intente de nuevo');
                return redirect()->route('producto.admin.vista');
            }

            if($datos->fotoEditar != null){
                $carpeta = $this->carpetaProductos();

                $extension = $datos->file('fotoEditar')->getClientOriginalExtension();
                if($this->comprobarExtensiones($extension) == 0){
                    Session::flash('extensionNoValida', 'La extensión del archivo no es válida. Por favor ingrese una foto con extensión .jpg, .jpeg, .png, .gif o webp');
                    return redirect()->route('producto.admin.vista');
                }
                do{
                    $nombreImagen = Str::random(10).date('_dmYHis');
                }while(Producto::where('nombre_img', $nombreImagen)->count() >= 1);
                $datos->file('fotoEditar')->move(public_path($carpeta.'/'), $nombreImagen.'.'.$extension);
                $datos->request->add(['nombre_img' => $nombreImagen, 'ruta_img' => $carpeta.'/'.$nombreImagen.'.'.$extension]);

                unlink(public_path($producto->ruta_img));
            }
            $datos->request->add(['nombre' => $datos->nombreEditar, 'descripcion' => $datos->descripcionEditar,
                'precio_compra' => $datos->precio_compraEditar, 'precio_venta' => $datos->precio_ventaEditar,
                'precio_oferta' => $datos->precio_ofertaEditar, 'categoria_id' => $datos->categoria_idEditar,
                'cantidad' => $datos->cantidadEditar]);
            $producto->fill($datos->all());
            $producto->save();
            DB::commit();
            Session::flash('editado', 'El producto se ha editado correctamente');
            return redirect()->route('producto.admin.vista');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Ocurrio un error al agregar el Producto. Por favor Contacte al administrador');
            return redirect()->route('producto.admin.vista');
        }
    }

    /**
     * Funcion que permite eliminar un producto en base al id
     * @param $id
     * @return false|string
     */
    public function eliminarProducto($id){
        try{
            $producto = Producto::find($id);
            if(!$producto)
                return json_encode(['estatus' => 'sinProducto', 'mensaje' => 'No se encontro el Producto']);

            if(file_exists(public_path($producto->ruta_img))){
                unlink(public_path($producto->ruta_img));
            }
            $producto->delete();
            DB::commit();
            return json_encode(['estatus' => 'eliminado', 'mensaje' => 'La categoria se ha eliminado correctamente']);
        }catch (\Exception $e){
            DB::rollBack();
            return json_encode(['estatus' => 'error', 'mensaje' => 'Ocurrio un error al eliminar el Producto.
            Por favor Contacte al administrador']);
        }
    }

    /**
     * Funcion que crea la carpeta producto en caso de que no exista (para las imagenes)
     * @return string
     */
    function carpetaProductos(){
        $carpeta = '/assets/productos';
        if (!file_exists(public_path($carpeta)))
            mkdir(public_path($carpeta), 0777);
        return $carpeta;
    }

    /**
     * Funcion que comprueba que el archvio ingresado sea de tipo imagen
     * @param $extension
     * @return int
     */
    function comprobarExtensiones($extension){
        $extensiones = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        foreach($extensiones as $ext){
            if ($extension == $ext)
                return 1;
        }
        return 0;
    }

}
