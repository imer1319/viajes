<?php

namespace App\Exports;

use App\Models\Cliente;
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

class ClienteExport
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
        return Cliente::all();
    }
    public function map($cliente): array
    {
        return [
            $cliente->id,
            $cliente->razon_social,
            $cliente->domicilio,
            $cliente->cuit,
            $cliente->numero_ingreso_bruto,
            $cliente->condicionIva->codigo,
            $cliente->telefono,
            $cliente->celular,
            $cliente->provincia->nombre,
            $cliente->departamento->nombre,
            $cliente->localidad->nombre,
            $cliente->codigo_postal,
            $cliente->email,
            $cliente->contacto,
            $cliente->retencionGanancia->codigo,
            $cliente->retencionIngresoBruto->descripcion,
            $cliente->tipoDocumento->nombre,
            $cliente->numero_documento,
            $cliente->saldo,
            $cliente->estado == 1 ? 'ACTIVO': 'INACTIVO',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'T' => '#,##0.00',
        ];
    }
    public function headings(): array
    {
        return [
            [
                "Listado de clientes"
            ],
            [
                '#',
                'Razon social',
                'Domicilio',
                'CUIT',
                '# ingreso bruto',
                'Condicion IVA',
                'Telefono',
                'Celular',
                'Provincia',
                'Departamento',
                'Localidad',
                'Codigo postal',
                'Email',
                'Contacto',
                'Retencion de ganancia',
                'Retencion de ingreso bruto',
                'Tipo de documento',
                '# documento',
                'Saldo',
                'Estado',
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
                $event->sheet->getDelegate()->mergeCells('B2:U2');
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
