<?php

namespace App\Exports;

use App\Models\Liquidacion;
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

class LiquidacionesExport
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
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
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
        return Liquidacion::query()
            ->with('chofer','pagos')
            ->byChoferId($this->filters['chofer_id'] ?? null)
            ->byFormaPagoId($this->filters['forma_id'] ?? null)
            ->byDesde($this->filters['desde'] ?? null)
            ->byHasta($this->filters['hasta'] ?? null)
            ->get();
    }

    public function map($liquidacion): array
    {
        return [
            $liquidacion->id,
            $liquidacion->numero_interno,
            $liquidacion->fecha,
            $liquidacion->chofer->nombre,
            $liquidacion->total_liquidacion,
            $liquidacion->observaciones,
            $liquidacion->pagos->pluck('forma.descripcion')->implode(', '),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => '#,##0.00', // Precio real
        ];
    }
    public function headings(): array
    {
        return [
            [
                'Listado de liquidaciones'
            ],
            [
                '#',
                '# int',
                'Fecha',
                'Chofer',
                'Total',
                'Observaciones',
                'Formas de pago',
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
                $event->sheet->getDelegate()->mergeCells('B2:H2');
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
