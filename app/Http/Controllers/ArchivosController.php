<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Mail\SuscripcionMail;
use App\Models\Producto;
use App\Models\Suscrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ArchivosController extends Controller
{

    public function enviarCorreo(Request $datos){
        if($datos->correo == null)
            return $this->retornarMensaje('correoVacio', 'Por favor ingrese un correo');

        $email = filter_var($datos->correo, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return $this->retornarMensaje('correoInvalido', 'El correo '.$datos->correo.' no es válido');

        if(Suscrito::where('correo', $email)->first() != null)
            return $this->retornarMensaje('correoExistente', 'El correo '.$datos->correo.' ya está suscrito');

        Mail::to('esqueleto144@gmail.com')->send(new SuscripcionMail());

        Suscrito::create($datos->all());
        return $this->retornarMensaje('correoEnviado', 'Correo '. $datos->correo.' suscrito (este puede estar en su carpeta de Spam)');
    }

    /**
     * Genera una variable de sesion con un mensaje y redirige a la vista en la que se encontraba
     * @param $nombre
     * @param $mensaje
     * @return \Illuminate\Http\RedirectResponse
     */
    function retornarMensaje($nombre, $mensaje){
        Session::flash($nombre, $mensaje);
        return redirect()->back();
    }

    /**
     * Para el uso de PDF se usa DOM PDF de LARAVEL (composer require barryvdh/laravel-dompdf)
     * Mas Informacion en https://styde.net/genera-pdfs-en-laravel-con-el-componente-dompdf/
     */

    /**
     * Funcion que genera el archivo PDF
     * @return mixed
     */
    function generarPDF(){
        $pdf = PDF::loadView('PDF.pdfProductos', ['productos' => Producto::all()]);
        $pdf->setPaper('A4', 'landscape'); //Hacer Horizontal la hoja (Comentar par ahacerla vertical)
        return $pdf;
    }

    /**
     * Funcion que Muestra el archivo PDF
     * @return mixed
     */
    public function verPDF(){
        $pdf = $this->generarPDF();
        return $pdf->stream('Productos.PDF');
    }

    /**
     * Funcion que descarga el archivo PDF
     * @return mixed
     */
    public function descargarPDF(){
        $pdf = $this->generarPDF();
        return $pdf->download('Productos.PDF');
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
