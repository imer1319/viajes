<?php

namespace App\Exports;

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
use App\Models\Recibo;

class ReciboExport
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

    public function collection()
    {
        return Recibo::query()
            ->with('cliente')
            ->byClienteId($this->filters['cliente_id'] ?? null)
            ->byFormaPagoId($this->filters['forma_id'] ?? null)
            ->byDesde($this->filters['desde'] ?? null)
            ->byHasta($this->filters['hasta'] ?? null)
            ->get();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2    => ['font' => ['bold' => true]],
            3    => ['font' => ['bold' => true]],
        ];
    }

    public function map($recibo): array
    {
        return [
            $recibo->numero_interno,
            $recibo->fecha,
            $recibo->total_recibo,
            $recibo->observaciones,
            $recibo->cliente->razon_social,
            $recibo->pagos->pluck('forma.descripcion')->implode(', '),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0.00',
        ];
    }
    public function headings(): array
    {
        return [
            [
                'Listado de Recibos'
            ],
            [
                '# interno',
                'Fecha',
                'Total recibo',
                'Observaciones ',
                'Cliente',
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
                $event->sheet->getDelegate()->mergeCells('B2:F2');
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
