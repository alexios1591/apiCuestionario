<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ClientExcelExport implements FromCollection, WithHeadings, WithMapping, 
    ShouldAutoSize, WithStyles, WithTitle, WithEvents
{
    protected $clientes;
    protected $generatedAt;

    public function __construct($clientes)
    {
        $this->clientes = $clientes;
        $this->generatedAt = now()->format('d/m/Y H:i:s');
    }

    public function title(): string
    {
        return 'Reporte de Clientes';
    }

    public function collection()
    {
        return collect($this->clientes);
    }

    public function headings(): array
    {
        return [
            ['REPORTE DE CLIENTES'],
            ['Generado el: ' . $this->generatedAt],
            [],
            [
                'N°',
                'Código',
                'Nombres',
                'Apellido Paterno',
                'Apellido Materno', 
                'Email',
                'DNI',
                'Fecha Nacimiento',
                'Celular',
                'Localidad',
                'Fecha Registro',
                'Encuestado'
            ]
        ];
    }

    public function map($cliente): array
    {
        return [
            $cliente['index'],
            $cliente['CodClie'],
            $cliente['NomClie'],
            $cliente['AppClie'],
            $cliente['ApmClie'],
            $cliente['EmaClie'],
            $cliente['DniClie'],
            $cliente['FnaClie'],
            $cliente['CelClie'],
            $cliente['localidad'],
            $cliente['RegClie'],
            $cliente['encuestado'] ? 'Sí' : 'No'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '2C3E50']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],

            2 => [
                'font' => ['italic' => true, 'color' => ['rgb' => '7F8C8D']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],

            4 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '34495E']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:K1');
                $event->sheet->mergeCells('A2:K2');

                $event->sheet->getStyle('A4:K4')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THICK,
                            'color' => ['rgb' => '2C3E50']
                        ]
                    ]
                ]);

                $event->sheet->getStyle('I5:I'.(count($this->clientes) + 5))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            }
        ];
    }
}