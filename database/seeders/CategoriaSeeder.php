<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        foreach($this->categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
                'slug' => $categoria['slug'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public $categorias = array(
        array('id'=> 1, 'nombre' => 'Celulares', 'descripcion' => 'Celulares Mobiles', 'slug' => 'cel'),
        array('id'=> 2, 'nombre' => 'Laptops', 'descripcion' => 'Laptops', 'slug' => 'lap'),
        array('id'=> 3, 'nombre' => 'Tablets', 'descripcion' => 'Tablets', 'slug' => 'tab'),
        array('id'=> 4, 'nombre' => 'Televisores', 'descripcion' => 'Televisores', 'slug' => 'tel'),
        array('id'=> 5, 'nombre' => 'Videojuegos', 'descripcion' => 'Videojuegos', 'slug' => 'games'),
        array('id'=> 6, 'nombre' => 'Consolas', 'descripcion' => 'Consolas', 'slug' => 'con'),
        array('id'=> 7, 'nombre' => 'Audio', 'descripcion' => 'Audio', 'slug' => 'aud'),
        array('id'=> 8, 'nombre' => 'Video', 'descripcion' => 'Video', 'slug' => 'vid'),
        array('id'=> 9, 'nombre' => 'Cámaras', 'descripcion' => 'Cámaras', 'slug' => 'cam'),
    );
}
