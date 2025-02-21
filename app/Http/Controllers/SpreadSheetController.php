<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SpreadSheetController extends Controller
{
    public function export() 
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        
        // Get active sheet
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Laravel')
            ->setLastModifiedBy('Laravel')
            ->setTitle('Daftar Judul Skripsi')
            ->setSubject('Daftar Judul Skripsi')
            ->setDescription('Daftar Judul Skripsi dan Pembimbing');
            
        // Add header
        $sheet->setCellValue('A1', 'DAFTAR JUDUL SKRIPSI');
        $sheet->mergeCells('A1:F1');
        
        // Style the header
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Add table headers
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Mahasiswa');
        $sheet->setCellValue('C3', 'Judul Skripsi');
        $sheet->setCellValue('D3', 'Dosen Pembimbing 1');
        $sheet->setCellValue('E3', 'Dosen Pembimbing 2');
        $sheet->setCellValue('F3', 'Tanggal Disetujui');
        
        // Style the table headers
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'E2EFDA',
                ],
            ],
        ];
        
        $sheet->getStyle('A3:F3')->applyFromArray($headerStyle);
        
        // Get data from database
        $juduls = Judul::with(['user', 'dospem1', 'dospem2'])->get();
        
        // Add data to sheet
        $row = 4;
        foreach ($juduls as $index => $judul) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $judul->user->name);
            $sheet->setCellValue('C' . $row, $judul->judul);
            $sheet->setCellValue('D' . $row, $judul->dospem1->name);
            $sheet->setCellValue('E' . $row, $judul->dospem2->name);
            $sheet->setCellValue('F' . $row, date('d-m-Y', strtotime($judul->tanggal_disetujui)));
            
            // Style data rows
            $sheet->getStyle('A'.$row.':F'.$row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            
            // Center align the number and date columns
            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            $row++;
        }
        
        // Auto size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Set row height
        $sheet->getRowDimension('1')->setRowHeight(30);
        $sheet->getRowDimension('3')->setRowHeight(20);
        
        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        
        // Set header for download
        $filename = 'Daftar_Judul_Skripsi_'.date('Y-m-d_H-i-s').'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save to output
        $writer->save('php://output');
    }

}
