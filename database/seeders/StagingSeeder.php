<?php

namespace Database\Seeders;

use App\Models\Staging;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //TODO : change batch id to null in staging
    public function run(): void
    {
        $data = [
            //PEMBELIAN SMP SMK
            ['staging_name' => 'Pilih Gelombang PPDB', 'registration_type' => "PEMBELIAN", 'index' => 1, 'grade' => "SMK"],
            ['staging_name' => 'Pembelian formulir pendaftaran', 'registration_type' => "PEMBELIAN", 'index' => 2, 'grade' => "SMK"],
            ['staging_name' => 'Pilih Jurusan', 'registration_type' => "PEMBELIAN", 'index' => 3, 'grade' => "SMK"],
            ['staging_name' => 'Cetak Formulir', 'registration_type' => "PEMBELIAN", 'index' => 4, 'grade' => "SMK"],
            ['staging_name' => 'Pilih Gelombang PPDB', 'registration_type' => "PEMBELIAN", 'index' => 1, 'grade' => "SMP"],
            ['staging_name' => 'Pembelian formulir pendaftaran', 'registration_type' => "PEMBELIAN", 'index' => 2, 'grade' => "SMP"],
            ['staging_name' => 'Cetak Formulir', 'registration_type' => "PEMBELIAN", 'index' => 3, 'grade' => "SMP"],

            //PENGEMBALIAN SMP SMK
            ['staging_name' => 'Pilih Jalur PPDB', 'registration_type' => "PENGEMBALIAN", 'index' => 1, 'grade' => "SMK"],
            ['staging_name' => 'Transaksi Pengembalian', 'registration_type' => "PENGEMBALIAN", 'index' => 2, 'grade' => "SMK"],
            ['staging_name' => 'Isi biodata', 'registration_type' => "PENGEMBALIAN", 'index' => 3, 'grade' => "SMK"],
            ['staging_name' => 'Pilih jurusan tetap', 'registration_type' => "PENGEMBALIAN", 'index' => 4, 'grade' => "SMK"],
            ['staging_name' => 'Cetak Formulir', 'registration_type' => "PENGEMBALIAN", 'index' => 5, 'grade' => "SMK"],

            ['staging_name' => 'Pilih Jalur PPDB', 'registration_type' => "PENGEMBALIAN", 'index' => 1, 'grade' => "SMP"],
            ['staging_name' => 'Transaksi Pengembalian', 'registration_type' => "PENGEMBALIAN", 'index' => 2, 'grade' => "SMP"],
            ['staging_name' => 'Isi biodata', 'registration_type' => "PENGEMBALIAN", 'index' => 3, 'grade' => "SMP"],
            ['staging_name' => 'Cetak Formulir', 'registration_type' => "PENGEMBALIAN", 'index' => 4, 'grade' => "SMP"],
        ];

        foreach($data as $d) {
            Staging::create($d);
        }
    }
}

