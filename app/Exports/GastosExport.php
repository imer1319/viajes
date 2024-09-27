<?php

namespace App\Exports;

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

class GastosExport
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
        return GastoChofer::with('proveedor', 'flota', 'chofer','tipoGastos')
            ->byChoferId($this->filters['chofer_id'] ?? null)
            ->byFlotaId($this->filters['flota_id'] ?? null)
            ->bySaldo($this->filters['saldo'] ?? null)
            ->byDesde($this->filters['desde'] ?? null)
            ->byHasta($this->filters['hasta'] ?? null)
            ->byTipoGastoId($this->filters['tipo_gasto_id'] ?? null)
            ->get();
    }

    public function map($gasto): array
    {
        $tipos = $gasto->tipoGastos->map(function ($tipo) {
            return $tipo->descripcion;
        })->implode(', ');
        return [
            $gasto->id,
            $gasto->numero_interno,
            $gasto->fecha,
            $gasto->proveedor->razon_social,
            $gasto->importe,
            $gasto->saldo,
            $gasto->chofer->nombre,
            $gasto->flota->nombre,
            $gasto->detalle,
            $tipos ?: '',
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
                'Listado de gastos del chofer'
            ],
            [
                '#',
                '# int',
                'Fecha',
                'Proveedor',
                'Importe',
                'Saldo',
                'Chofer',
                'Flota',
                'Detalle',
                'Tipos gasto',
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
                $event->sheet->getDelegate()->mergeCells('B2:K2');
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
