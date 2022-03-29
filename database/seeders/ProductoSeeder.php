<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $carpeta = public_path('/assets/productos');
        if(!file_exists($carpeta))
            mkdir($carpeta, 0777);
        else{
            if(!$dh = @opendir($carpeta)) return;
            while (false !== ($current = readdir($dh))) {
                if($current != '.' && $current != '..') {
                    echo 'Se ha borrado el archivo '.$carpeta.'/'.$current.'<br/>';
                    if (!@unlink($carpeta.'/'.$current))
                        deleteDirectory($carpeta.'/'.$current);
                }
            }
            closedir($dh);
            @rmdir($carpeta);

            mkdir($carpeta, 0777);
        }

        foreach($this->productos as $producto) {
            DB::table('productos')->insert([
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'precio_compra' => $producto['precio_compra'],
                'precio_venta' => $producto['precio_venta'],
                'precio_oferta' => $producto['precio_oferta'],
                'categoria_id' => $producto['categoria_id'],
                'cantidad' => $producto['cantidad'],
                'nombre_img' => $producto['nombre_img'],
                'ruta_img' => $producto['ruta_img'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            copy(public_path('/assets/seeder_fotos').'/'.$producto['nombre_img'].'.png', public_path($producto['ruta_img']));
        }
    }

    public $productos = array(
        array('nombre' => 'Celular Samsung A11', 'descripcion' => 'Celular Marca Samsung con memoria RAM de 4 GB permite que
        tu smartphone funcione de manera fluida y sin demoras al realizar distintas tareas, jugar o navegar. Máxima
        habilitar el teléfono en un toque, o el reconocimiento facial que permite un desbloqueo hasta un 30% más rápido.',
            'precio_compra' => 1500.00, 'precio_venta' => 2799.99, 'precio_oferta' => 2499.99, 'categoria_id' => '1',
            'cantidad' => 10, 'nombre_img' => 'KASC9I0KKA_26032022173909', 'ruta_img' => '/assets/productos/KASC9I0KKA_26032022173909.png'),
        array('nombre' => 'Celular Motorola M4', 'descripcion' => 'Celular Marca Motorola con memoria RAM de 3 GB permite que
        tu smartphone funcione de manera fluida y sin demoras al realizar distintas tareas, jugar o navegar. Máxima
        seguridad para que solo tú puedas acceder al equipo. Podrás elegir entre el sensor de huella dactilar para
        habilitar el teléfono en un toque, o el reconocimiento facial que permite un desbloqueo hasta un 40% más rápido.',
            'precio_compra' => 1200.00, 'precio_venta' => 2299.99, 'precio_oferta' => 1899.99, 'categoria_id' => '1',
            'cantidad' => 8, 'nombre_img' => 'uLX6drxVvT_26032022174309', 'ruta_img' => '/assets/productos/uLX6drxVvT_26032022174309.png'),
        array('nombre' => 'Celular Xiaomi X21', 'descripcion' => 'Celular Marca Xiaomi con memoria RAM de 6 GB permite que
        tu smartphone funcione de manera fluida y sin demoras al realizar distintas tareas, jugar o navegar. Máxima
        seguridad para que solo tú puedas acceder al equipo. Podrás elegir entre el sensor de huella dactilar para
        habilitar el teléfono en un toque, o el reconocimiento facial que permite un desbloqueo hasta un 35% más rápido.',
            'precio_compra' => 1000.00, 'precio_venta' => 1899.99, 'precio_oferta' => 1599.99, 'categoria_id' => '1',
            'cantidad' => 12, 'nombre_img' => 'M2w9g046Ew_26032022174314', 'ruta_img' => '/assets/productos/M2w9g046Ew_26032022174314.png'),
        array('nombre' => 'Laptop HP Note Book A15', 'descripcion' => 'La laptop Asus X515JA es una solución tanto para
        trabajar y estudiar como para entretenerte. Al ser portátil, el escritorio dejará de ser tu único espacio de
        uso para abrirte las puertas a otros ambientes ya sea en tu casa o en la oficina.',
            'precio_compra' => 7000.00, 'precio_venta' => 15999.99, 'precio_oferta' => 12999.99, 'categoria_id' => '2',
            'cantidad' => 5, 'nombre_img' => 'TwNHkKB7xv_26032022174826', 'ruta_img' => '/assets/productos/TwNHkKB7xv_26032022174826.png'),
        array('nombre' => 'Laptop Asus X515JA', 'descripcion' => 'La laptop HP Note Book A15 es una solución tanto para
        trabajar y estudiar como para entretenerte. Al ser portátil, el escritorio dejará de ser tu único espacio de uso
        para abrirte las puertas a otros ambientes ya sea en tu casa o en la oficina.',
            'precio_compra' => 5000.00, 'precio_venta' => 8999.99, 'precio_oferta' => null, 'categoria_id' => '2',
            'cantidad' => 15, 'nombre_img' => '7wajOQhDUr_26032022174946', 'ruta_img' => '/assets/productos/7wajOQhDUr_26032022174946.png'),
    );

}
