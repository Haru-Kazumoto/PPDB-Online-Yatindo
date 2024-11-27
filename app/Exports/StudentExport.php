<?php

namespace App\Exports;

use App\Models\RegistrationBatch;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths
{
    use Exportable;

    protected $batch_id;
    protected $index = 1;

    public function __construct($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    public function collection(): Collection
    {
        $batch = RegistrationBatch::where('id',$this->batch_id)->first();

        $dataToExport = Student::whereHas('studentInfo',function($query) use ($batch) {
            $query->where('batch_id',$batch->id);
        })
            ->with('studentAddress','studentInfo')
            ->get();

        return $dataToExport;
    }

    public function map($student): array
    {
        return [
            $this->index++,
            $student->fullname,
            $student->studentInfo['form_number'],
            $student->phone,
            $student->nisn,
            $student->gender,
            $student->religion,
            $student->birth_place,
            Carbon::parse($student->birth_date)->translatedFormat('d F Y'),
            $student->grade,
            $student->studentAddress['address'],
            $student->studentInfo['school_origin'],
            Carbon::parse($student->studentInfo['purchase_registration_date'])->translatedFormat('d F Y H:i:s'),
            Carbon::parse($student->studentInfo['purchase_registration_date'])->translatedFormat('d F Y H:i:s'),
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 5,  // Index
            'B' => 20, // Nama Siswa
            'C' => 15, // Nomor Formulir
            'D' => 15, // Nomor Telepon
            'E' => 10, // NISN
            'F' => 15, // Gender
            'G' => 15, // Agama
            'H' => 15, // Tempat Lahir
            'I' => 26, // Tanggal Lahir
            'J' => 10, // Jenjang
            'K' => 35, // Alamat
            'L' => 23, // Asal Sekolah
            'M' => 25, // Tanggal Pembelian
            'N' => 25, // Tanggal Pengembalian
        ];
    }

    /**
    * Define the headings for the Excel file
    */
    public function headings(): array
    {
        // Tentukan header tabel
        return [
            '#',
            'Nama Siswa',
            'Nomor Formulir',
            'Nomor Telepon',
            'NISN',
            'Gender',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenjang',
            'Alamat',
            'Asal Sekolah',
            'Tanggal Pembelian',
            'Tanggal Pengembalian'
        ];
    }
}
