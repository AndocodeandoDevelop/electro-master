<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductosExport implements FromCollection, WithMapping, WithHeadings, WithTitle, WithCustomStartCell,
    WithColumnWidths, WithStyles, WithEvents
{

    private $columnas;
    /**
     * Funcion que Obtiene los datos para el excel
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function collection(){
        $productos = Producto::all();
        $this->columnas = 'B1:I'.($productos->count() + 2);
        return $productos;
    }

    /**
     * Funcion que permite modificar los datos a insertar en el excel
     * @param mixed $row
     * @return array
     */
    public function map($row): array{
        return [
            $row->id,
            $row->nombre,
            $row->precio_compra,
            $row->precio_venta,
            ($row->precio_oferta != null) ? $row->precio_oferta : 'Sin Oferta',
            $row->categoria->nombre,
            $row->cantidad,
            date('d-m-Y', strtotime($row->created_at)),
        ];
    }

    /**
     * Establece los encabezados para el excel
     * @return \string[][]
     */
    public function headings(): array{
        return [
            ['Productos Registrados'],
            [
                'ID',
                'Nombre',
                'Precio Compra',
                'Precio Venta',
                'Precio Oferta',
                'Categoria',
                'Cantidad',
                'Fecha de Creacion'
            ]
        ];
    }

    /**
     * Establece el nombre de la Hoja
     * @return string
     */
    public function title(): string{
        return "Productos";
    }

    /**
     * Establece en que celda empezara el contenido del excel
     * @return string
     */
    public function startCell(): string{
        return 'B1';
    }

    /**
     * Establece un tamaño espeficico para las celdas
     * @return array
     */
    public function columnWidths(): array{
        return [
            'A' => 3.9,
            'B' => 3.9,
            'C' => 30,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 18.9,
            'H' => 15.15,
            'I' => 19,
        ];
    }

    /**
     * Coloca en Negritas y texto centrado las celdas seleccionadas
     * @param Worksheet $sheet
     * @return \bool[][][]
     */
    public function styles(Worksheet $sheet){
        return [
            'B1:I1' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],],
            'B2:I2' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'B:I' => ['alignment' => ['horizontal' => 'center']],
        ];
    }

    /**
     * Estilos de la hoja
     *
     * $event 1 Combina y cambia el color de la celda principal (Amarilla)
     * $event 2 Establece los margenes de excel
     * @return \Closure[]
     */
    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setMergeCells(['B1:I1'])->getStyle('B1:I1')->
                getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D10024']]);
                $event->sheet->getStyle($this->columnas)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
