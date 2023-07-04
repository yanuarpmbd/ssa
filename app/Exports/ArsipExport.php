<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArsipExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        $records = $this->records;
        
        return $records;
    }
    /**
     * @return array
    */
    public function map($records) : array {
        if($records->status){
            $status = "Aktif";
        }
        else{
            $status = "Inaktif";
        }
        return [
            $records->jenisArsip->kode_arsip,
            $records->unitKerja->nama_unit_kerja,
            $records->nama_arsip,
            $records->jenisArsip->jenis_arsip,
            $records->rak->nama_rak,
            $records->dus->nama_dus,
            $records->tingkat_perkembangan,
            $status,
            $records->tahun,
            $records->deskripsi,
        ]; 
    }
    public function headings(): array
    {
        return [
            'Kode Arsip',
            'Unit Kerja',
            'Nama Arsip',
            'Jenis Arsip',
            'Rak',
            'Dus',
            'Tingkat Perkembangan',
            'Status',
            'Tahun',
            'Deskripsi',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('J')->getAlignment()->setWrapText(true);
    }
}
