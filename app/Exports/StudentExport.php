<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection,WithHeadings
{
    use Exportable;

    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students;
    }
    

    /**
    * Define the headings for the Excel file
    */
    public function headings(): array
    {
        // Tentukan header tabel
        return [
            'Nama Siswa',
            'Nomor Telepon',
            'NISN',
            'Gender',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenjang',
            'Alamat',
            'Asal Sekolah',
            'Tanggal Mendaftar',
            'Nomor Formulir',
        ];
    }
}
