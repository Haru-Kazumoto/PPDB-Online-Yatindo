<?php

namespace App\Exports;

use App\Models\RegistrationBatch;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

// ,WithHeadings
class StudentExport implements FromCollection
{
    use Exportable;

    protected $batch_id;

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
    

    /**
    * Define the headings for the Excel file
    */
    // public function headings(): array
    // {
    //     // Tentukan header tabel
    //     return [
    //         'Nama Siswa',
    //         'Nomor Telepon',
    //         'NISN',
    //         'Gender',
    //         'Agama',
    //         'Tempat Lahir',
    //         'Tanggal Lahir',
    //         'Jenjang',
    //         'Alamat',
    //         'Asal Sekolah',
    //         'Tanggal Mendaftar',
    //         'Nomor Formulir',
    //     ];
    // }
}
