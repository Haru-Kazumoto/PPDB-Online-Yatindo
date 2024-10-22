<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    // protected $students;

    // public function __construct($students)
    // {   
    //     $this->students = $students;
    // }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Pilih hanya field-field tertentu yang akan diekspor
        return Student::with('studentInfo','studentAddress')->get();
    }

    public function map($student): array
    {
        // dd($student);
        return [
            $student->fullname,
            $student->phone,
            $student->nisn,
            $student->gender,
            $student->religion,
            $student->birth_place,
            $student->birth_date,
            $student->grade,
            $student->studentAddress->address,
            $student->studentInfo->school_origin,
            $student->studentInfo->purchase_registration_date,
            $student->studentInfo->form_number
        ];
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
