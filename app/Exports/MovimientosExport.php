<?php

namespace App\Exports;

use App\Models\Movimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class MovimientosExport
extends DefaultValueBinder
implements
    WithColumnFormatting,
    FromCollection,
    WithHeadings,
    WithCustomStartCell,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithEvents,
    WithCustomValueBinder
{
    public function styles(Worksheet $sheet)
    {
        return [
            2    => ['font' => ['bold' => true]],
            3    => ['font' => ['bold' => true]],
        ];
    }
  
    public function collection()
    {
        return Movimiento::with('cliente', 'chofer', 'flota', 'tipoViaje')->get();
    }

    public function map($movimiento): array
    {
        return [
            $movimiento->id,
            $movimiento->numero_interno,
            $movimiento->fecha,
            $movimiento->cliente->razon_social,
            $movimiento->tipoViaje->descripcion,
            $movimiento->detalle,
            $movimiento->numero_factura_1 . "-" . $movimiento->numero_factura_2,
            $movimiento->precio_real,
            $movimiento->iva,
            $movimiento->total,
            $movimiento->saldo_total,
            $movimiento->flota->nombre,
            $movimiento->chofer->nombre,
            $movimiento->precio_chofer,
            $movimiento->porcentaje_pago,
            $movimiento->comision_chofer,
            $movimiento->saldo_comision_chofer,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => '#,##0.00', // Precio real
            'J' => '#,##0.00', // IVA
            'K' => '#,##0.00', // Total
            'L' => '#,##0.00', // Saldo total
            'O' => '#,##0.00', // Precio chofer
            'Q' => '#,##0.00', // Comision Chofer
            'R' => '#,##0.00', // Saldo del chofer
        ];
    }
    public function headings(): array
    {
        return [
            [
                'Listado de movimientos'
            ],
            [
                '#',
                '# interno',
                'Fecha',
                'Cliente',
                'Tipo de viaje',
                'Detalle',
                'Numero de factura',
                'Precio real',
                'IVA',
                'Total',
                'Saldo total',
                'Flota',
                'Chofer',
                'Precio Chofer',
                '%',
                'Comision Chofer',
                'Saldo del chofer',
            ]
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('B2:R2');
                $event->sheet->getDelegate()->getStyle('B2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
