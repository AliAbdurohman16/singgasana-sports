<?php

namespace App\Exports;

use App\Models\BookingDaily;
use App\Models\BookingMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use Carbon\Carbon;

class ReportExcel implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    protected $startDate;
    protected $endDate;
    protected $loginUser;
    protected $data = true;
    protected $totalSum = 0;

    public function __construct($startDate, $endDate, $loginUser)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->loginUser = $loginUser;
        $this->data = collect();
    }

    public function collection()
    {
        $dailyBookings = BookingDaily::where('status', 'success')
                            ->when($this->startDate, function ($query) {
                                $query->whereDate('datetime', '>=', $this->startDate);
                            })
                            ->when($this->endDate, function ($query) {
                                $query->whereDate('datetime', '<=', $this->endDate);
                            })
                            ->get();

        $this->data = $this->data->merge($dailyBookings);

        $memberBookings = BookingMember::where('status', 'success')
                            ->when($this->startDate, function ($query) {
                                $query->whereDate('datetime', '>=', $this->startDate);
                            })
                            ->when($this->endDate, function ($query) {
                                $query->whereDate('datetime', '<=', $this->endDate);
                            })
                            ->get();

        $this->data = $this->data->merge($memberBookings);

        return $this->data;
    }

    public function headings(): array
    {
        return [
            ['Laporan Data'],
            ['Nama Kasir : ' . $this->loginUser],
            ['Tanggal Export : ' . Carbon::now()->locale('id')->format('d-m-Y H:i:s')],
            [],
            ['NO', 'Cabang Olahraga', 'Tanggal Booking', 'Tipe Booking', 'Pesanan', 'Pembayaran', 'Total']
        ];
    }

    public function map($row): array
    {
        static $no = 1;

        $this->totalSum += $row->total;

        return [
            $no++,
            $row->service->name ?? '',
            date('d-m-Y H:i:s', strtotime($row->datetime)),
            isset($row->duration) ? $row->duration : $row->package ?? '',
            isset($row->information) ? $row->information : $row->school ?? '',
            'Transfer BCA',
            StringHelper::formatNumber($row->total),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:G2');
        $sheet->mergeCells('A3:G3');

        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A2:G2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A5:G5')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'D9EAD3'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);

        $highestRow = $sheet->getHighestRow();

        $sheet->setCellValue('F' . ($highestRow + 1), 'Total Keseluruhan');
        $sheet->setCellValue('G' . ($highestRow + 1), StringHelper::formatNumber($this->totalSum));

        $sheet->getStyle('F' . ($highestRow + 1) . ':G' . ($highestRow + 1))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A6:A' . $highestRow)->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A6:G' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

}