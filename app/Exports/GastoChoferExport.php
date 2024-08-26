<?php

namespace App\Exports;

use App\Models\Chofer;
use App\Models\GastoChofer;
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

class GastoChoferExport
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
    protected $chofer;

    public function __construct(Chofer $chofer)
    {
        $this->chofer = $chofer;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2    => ['font' => ['bold' => true]],
            3    => ['font' => ['bold' => true]],
        ];
    }
    public function collection()
    {
        return GastoChofer::where('chofer_id', $this->chofer->id)->with('proveedor', 'flota', 'chofer')->get();
    }
    
    public function map($gasto): array
    {
        return [
            $gasto->id,
            $gasto->numero_interno,
            $gasto->fecha,
            $gasto->proveedor->razon_social,
            $gasto->importe,
            $gasto->saldo,
            $gasto->flota->nombre,
            $gasto->detalle,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => '#,##0.00',
            'G' => '#,##0.00',
        ];
    }
    public function headings(): array
    {
        return [
            [
                "Listado de gastos del chofer: " . $this->chofer->nombre
            ],
            [
                '#',
                '# interno',
                'Fecha',
                'Proveedor',
                'Importe',
                'Saldo',
                'Flota',
                'Detalle',
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
                $event->sheet->getDelegate()->mergeCells('B2:I2');
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
