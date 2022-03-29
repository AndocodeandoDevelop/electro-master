<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Mail\SuscripcionMail;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ArchivosController extends Controller
{
    /**
     * Para el uso de PDF se usa DOM PDF de LARAVEL (composer require barryvdh/laravel-dompdf)
     * Mas Informacion en https://styde.net/genera-pdfs-en-laravel-con-el-componente-dompdf/
     */

    /**
     * Funcion que genera el archivo PDF
     * @return mixed
     */
    function generarPDF(){
        $pdf = PDF::loadView('productos.pdfProductos', ['productos' => Producto::all()]);
        $pdf->setPaper('A4', 'landscape'); //Hacer Horizontal la hoja (Comentar par ahacerla vertical)
        return $pdf;
    }

    /**
     * Funcion que Muestra el archivo PDF
     * @return mixed
     */
    public function verPDF(){
        $pdf = $this->generarPDF();
        return $pdf->stream('Productos.pdf');
    }

    /**
     * Funcion que descarga el archivo PDF
     * @return mixed
     */
    public function descargarPDF(){
        $pdf = $this->generarPDF();
        return $pdf->download('Productos.pdf');
    }

    /**
     * Para el uso de Excel se usa Excel de Maatwebsite ( composer require maatwebsite/excel:*)
     * Mas Informacion en https://docs.laravel-excel.com/3.1/getting-started/installation.html
     */

    public function descargarExcel(){
        return Excel::download(new ProductosExport(), 'productos.xlsx');
    }

    public function map($row): array{
        $elementos = [];
        foreach ($row->ventasProductos as $productos) {
            $return = [
                date_format($row->created_at, 'd-m-Y'),
                $row->id,
                $row->apertura->sucursal->nombre,
                $row->usuario->name,
                isset($productos->producto->nombre) == true ? $productos->producto->nombre : 'No se encontro el producto (puede que haya sido borrado)',
                number_format($productos->cantidad * $productos->venta, 2),
            ];
            array_push($elementos, $return);
        }
        return $elementos;
    }
}
