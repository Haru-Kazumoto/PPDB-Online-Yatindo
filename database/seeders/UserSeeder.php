<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function() {
            $user = User::create([
                'username' => '1234567890',
                'password' => '123',
            ]);
    
            $student = Student::create([
                'fullname' => 'jiaw',
                'phone' => $user->username,
                'gender' => "LAKI_LAKI",
                'grade' => "SMK",
                'user_id' => $user->id,
            ]);
    
            StudentAddress::create([
                'address' => 'Bekasi jawa barat cimuning sono an dikit',
                'student_id' => $student->id,
            ]);

            StudentInfo::create([
                'school_origin' => "YATINDO",
                'student_id' => $student->id,
            ]);
        });
    }
}
