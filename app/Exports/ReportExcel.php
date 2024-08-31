<?php

namespace App\Exports;

use App\Models\BookingDaily;
use App\Models\BookingMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Helpers\StringHelper;
use Carbon\Carbon;

class ReportExcel implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    protected $startDate;
    protected $endDate;
    protected $loginUser;
    protected $data;
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
        $dailyBookings = BookingDaily::with('bookingDailyDetails')
                            ->where('status_payment', 'success')
                            ->when($this->startDate, function ($query) {
                                $query->where('created_at', '>=', $this->startDate);
                            })
                            ->when($this->endDate, function ($query) {
                                $query->where('created_at', '<=', $this->endDate);
                            })
                            ->get();

        $this->data = $this->data->merge($dailyBookings);

        $memberBookings = BookingMember::with('booking_schools')
                            ->where('status_payment', 'success')
                            ->when($this->startDate, function ($query) {
                                $query->where('created_at', '>=', $this->startDate);
                            })
                            ->when($this->endDate, function ($query) {
                                $query->where('created_at', '<=', $this->endDate);
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
            ['NO', 'Kode Booking', 'Cabang Olahraga', 'Tipe Booking', 'Paket', 'Member', 'Qty', 'Pembayaran', 'Subtotal', 'ppn', 'Total']
        ];
    }

    public function map($row): array
    {
        static $no = 1;

        $this->totalSum += $row->total;

        if ($row instanceof BookingDaily) {
            $data = [];

            foreach ($row->bookingDailyDetails as $detail) {
                $booking_id = $detail->booking_daily_id ?? '';
                $kategori = $detail->kategori ?? '';
                $qty = $detail->qty ?? 1;
                $roomy = $detail->roomy ?? '';

                $data[] = [
                    $no++,
                    $booking_id,
                    $row->service->name ?? '',
                    $kategori,
                    $roomy,
                    $row->member ?? '',
                    $qty,
                    $row->payment_method,
                    StringHelper::formatCurrency($row->subtotal),
                    StringHelper::formatCurrency($row->ppn),
                    StringHelper::formatCurrency($row->total),
                ];
            }

            return $data;
        } else {
            $total = $row->total != 0.00 ? $row->total : $row->total_for_school;

            return [
                [
                    $no++,
                    $row->id ?? '',
                    $row->service->name ?? '',
                    $row->category ?? '',
                    $row->package ?? '',
                    $row->member ?? '',
                    $row->qty ?? 1,
                    $row->payment_method,
                    StringHelper::formatCurrency($row->subtotal),
                    StringHelper::formatCurrency($row->ppn),
                    StringHelper::formatCurrency($total),
                ]
            ];
        }
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:K1');
        $sheet->mergeCells('A2:K2');
        $sheet->mergeCells('A3:K3');

        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A2:K2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:K3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A5:K5')->applyFromArray([
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
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);

        $highestRow = $sheet->getHighestRow();

        $sheet->setCellValue('J' . ($highestRow + 1), 'Total Keseluruhan');
        $sheet->setCellValue('K' . ($highestRow + 1), StringHelper::formatCurrency($this->totalSum));

        $sheet->getStyle('J' . ($highestRow + 1) . ':K' . ($highestRow + 1))->applyFromArray([
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

        $sheet->getStyle('A6:K' . $highestRow)->applyFromArray([
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