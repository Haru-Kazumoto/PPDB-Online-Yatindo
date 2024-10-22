<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'username' => 'jia',
        //     'password' => '123',
        //     'is_admin' => true,
        // ]);
        DB::transaction(function () {
            User::create([
                'username' => '12345',
                'password' => Hash::make('123'),
                'is_admin' => true,
                'fullname' => "Sekar Mayang Setya Utami"
            ]);

            // $student = Student::create([
            //     'fullname' => 'admin',
            //     'phone' => $user->username,
            //     'gender' => "LAKI_LAKI",
            //     'grade' => "SMK",
            //     'religion' => "islam",
            //     'user_id' => $user->id,
            // ]);

            // StudentAddress::create([
            //     'address' => 'Bekasi jawa barat cimuning sono an dikit',
            //     'student_id' => $student->id,
            // ]);

            // StudentInfo::create([
            //     'profile_picture' => "",
            //     'school_origin' => "YATINDO",
            //     'student_id' => $student->id,
            // ]);
        });
    }
}
