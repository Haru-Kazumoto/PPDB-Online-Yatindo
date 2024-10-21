<?php

namespace App\Http\Controllers;

use App\Models\RegistrationBatch;
use App\Models\RegistrationPath;
use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\StudentLogs;
use App\Models\StudentPayments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReturningController extends Controller
{
    public function index()
    {
        $studentInfo = Auth::user()->student->studentInfo;
        $current = $studentInfo->returning_current_step;
        $data = [];

        $batches_query = RegistrationBatch::where('type', 'PENGEMBALIAN');

        if ($current == 1) {
            $data = [
                'batches' => $batches_query->get(),
            ];
        } else if ($current == 2) {
            $data = [
                'batches' => $batches_query->where('id', $studentInfo->return_batch_id)->first(),
                'payments' => StudentPayments::where('student_id', $studentInfo->student->id)
                    ->where('batch_id', $studentInfo->return_batch_id)
                    ->get(),
            ];
        } else if ($current == 3 && Auth::user()->student->grade == 'SMK') {
            $data = [
                'batches' => $batches_query->where('id', $studentInfo->return_batch_id)->first()
            ];
        } else {
            $batches = $batches_query->where('id', $studentInfo->return_batch_id)->first();

            // Tambahkan pengecekan apakah $batches null
            if ($batches) {
                $jalur = RegistrationPath::where('id', $batches->registration_path_id)->first();
            } else {
                $jalur = null; // Atau tangani sesuai logika bisnis Anda
            }

            $jurusan = StudentLogs::where('student_id', Auth::user()->student->id)->first();

            $data = [
                "jalur" => $jalur,
                "jurusan" => $jurusan
            ];
        }
        
        return Inertia::render('Student/ReturningSteps/Index', compact('current', 'data'));
    }

    public function updateInfo(Request $request)
    {
        $student_info = Auth::user()->student->studentInfo;

        $batch_code = $request->batch_code;

        $current_form_number = $student_info->form_number;
        $current_batch_code = substr($current_form_number, 5, 2);

        if ($student_info->returning_current_step == 1) {
            
            // Cek apakah batch_code baru berbeda dari batch_code saat ini
            if ($batch_code !== $current_batch_code) {
                // Buat form number baru dengan batch code yang diperbarui, tetap menjaga tahun dan nomor urut
                $year = substr($current_form_number, 0, 4); // Ambil 4 digit tahun
                $index = substr($current_form_number, -3); // Ambil 3 digit nomor urut terakhir

                // Susun kembali form_number dengan batch code baru
                $new_form_number = sprintf("%d-%s-%03d", $year, $batch_code, $index);
                
                $student_info->update([
                    'returning_current_step' => $student_info->returning_current_step + 1,
                    'returning_step_name' => 'PILIH GELOMBANG PENGEMBALIAN',
                    'returning_step_type' => $request->type,
                    'return_batch_id' => $request->batch_id,
                    'purchase_registration_date' => Carbon::now(),
                    'form_number' => $new_form_number,  // Hanya update jika batch_code berubah
                ]);
            } else {
                // Jika batch_code tidak berubah, update step dan lainnya tanpa mengubah form_number
                $student_info->update([
                    'returning_current_step' => $student_info->returning_current_step + 1,
                    'step_name' => 'PILIH GELOMBANG PENGEMBALIAN',
                    'step_type' => $request->type,
                    'return_batch_id' => $request->batch_id,
                    'purchase_registration_date' => Carbon::now(),
                    // form_number tidak diupdate
                ]);
            }
        } else if ($student_info->returning_current_step == 2) {
            $student_info->update([
                'returning_current_step' => $student_info->returning_current_step + 1,
                'step_name' => 'PEMBAYARAN FORMULIR PENGEMBALIAN',
            ]);
        } else if ($student_info->returning_current_step == 3) {
            $student = Auth::user()->student;
            

            $dataVerified = $request->validate([
                'nisn' => 'required|string',
                'phone' => 'required|string',
                'fullname' => 'required|string',
                'surname' => 'required|string',
                'gender' => 'required|string',
                'religion' => 'required|string',
                'birth_place' => 'required|string',
                'birth_date' => 'required|string',
                'address' => 'required|string',
                'province' => 'required|string',
                'city' => 'required|string',
                'district' => 'required|string',
                'sub_district' => 'required|string',
                'postal_code' => 'required|string',
                'school_origin' => 'required|string',
                'father_name' => 'required|string',
                'father_phone' => 'required|string',
                'father_jobs' => 'required|string',
                'father_address' => 'required|string',
                'mother_name' => 'required|string',
                'mother_phone' => 'required|string',
                'mother_jobs' => 'required|string',
                'mother_address' => 'required|string',
            ]);


            DB::transaction(function() use ($student, $dataVerified, $student_info) {
                // Update data student dengan menggunakan data dari $dataVerified
                $student->update([
                    'nisn' => $dataVerified['nisn'],
                    'phone' => $dataVerified['phone'],
                    'fullname' => $dataVerified['fullname'],
                    'surname' => $dataVerified['surname'],
                    'gender' => $dataVerified['gender'],
                    'religion' => $dataVerified['religion'],
                    'birth_place' => $dataVerified['birth_place'],
                    'birth_date' => $dataVerified['birth_date'],
                ]);
            
                // Update alamat
                $student->studentAddress->update([
                    'address' => $dataVerified['address'],
                    'province' => $dataVerified['province'],
                    'city' => $dataVerified['city'],
                    'district' => $dataVerified['district'], 
                    'sub_district' => $dataVerified['sub_district'],
                    'postal_code' => $dataVerified['postal_code'],
                ]);
            
                // Update info sekolah
                $student->studentInfo->update([
                    'school_origin' => $dataVerified['school_origin'],
                ]);
            
                // Update info orang tua
                $student->update([
                    'father_name' => $dataVerified['father_name'],
                    'father_phone' => $dataVerified['father_phone'],
                    'father_jobs' => $dataVerified['father_jobs'],
                    'father_address' => $dataVerified['father_address'],
                    'mother_name' => $dataVerified['mother_name'],
                    'mother_phone' => $dataVerified['mother_phone'],
                    'mother_jobs' => $dataVerified['mother_jobs'],
                    'mother_address' => $dataVerified['mother_address'],
                ]);

                $student_info->update([
                    'returning_current_step' => $student_info->returning_current_step + 1,
                    'step_name' => 'PENGISIAN BIODATA FORMULIR',
                ]);
            });


        } else if ($student_info->returning_current_step == 4) {
            $student_info->update([
                'returning_current_step' => $student_info->returning_current_step + 1,
                'step_name' => 'PEMILIHAN JURUSAN',
            ]);

            StudentLogs::create([
                'status' => 0,
                'major_estimation' => $request->major_estimation,
                'major_fix' => $request->major_fix,
                'remark' => '',
                'registration_type' => '',
                'student_id' => Auth::user()->student->id,
                'batch_id' => $student_info->batch_id,
                'staging_id' => 1,
            ]);
        } else if($student_info->returning_current_step == 5) {
            $student_info->update([
                'step_name' => 'CETAK KARTU PESERTA',
                'returning_current_step' => $student_info->returning_current_step + 1,
                'returning_step_status' => true,
            ]);
        }

        return back()->with('success', 'Berhasil daftar');
    }

    public function addPayment(Request $request)
    {
        $payment = new StudentPayments();
        $payment->total = 0;
        $payment->payment_method = $request->payment_method;
        $payment->status = 1;
        $payment->student_id = Auth::user()->student->id;
        $payment->batch_id = Auth::user()->student->studentInfo->return_batch_id;

        if ($request->hasFile('payment_image')) {
            $image = $request->file('payment_image');
            $imageName = $this->generateRandomString() . '.' . $image->getClientOriginalExtension();
            // original image
            $imagePath = 'images/payment/' . $imageName;
            $image->storeAs('', $imagePath, 'public');

            $payment->payment_image = $imagePath;
        }

        $payment->save();

        return back()->with('success', 'Berhasil menambahkan pembayaran');
    }

    public function addProfile(Request $request)
    {
        // Misalkan Anda mendapatkan student_id dari request
        $student_info = StudentInfo::where('student_id', Auth::user()->student->studentInfo->id)->first();

        // Jika tidak ada data yang ditemukan, Anda dapat menangani error
        if (!$student_info) {
            return back()->with('error', 'Student info not found.');
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = $this->generateRandomString() . '.' . $image->getClientOriginalExtension();
            // original image
            $imagePath = 'images/student_photos/' . $imageName;
            $image->storeAs('', $imagePath, 'public');

            $student_info->profile_picture = $imagePath; // Update foto profil
        }

        $student_info->save(); // Simpan perubahan

        return back()->with('success', 'Berhasil menambahkan foto');
    }

    public function addFamilyCard(Request $request)
    {
        // Mencari student berdasarkan auth user
        $student = Auth::user()->student; // Dapatkan student dari auth user

        // Jika tidak ada student yang ditemukan, tangani error
        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Memeriksa apakah ada file gambar yang diupload
        if ($request->hasFile('family_card_image')) {
            $image = $request->file('family_card_image');
            $imageName = $this->generateRandomString() . '.' . $image->getClientOriginalExtension();
            // Path gambar
            $imagePath = 'images/family_cards/' . $imageName;
            $image->storeAs('', $imagePath, 'public');

            // Update gambar profil siswa
            $student->family_card = $imagePath;
        }

        // Simpan perubahan
        $student->save();

        return back()->with('success', 'Berhasil menambahkan kartu keluarga');
    }

    public function addBirthCertificate(Request $request)
    {
        // Mencari student berdasarkan auth user
        $student = Auth::user()->student; // Dapatkan student dari auth user

        // Jika tidak ada student yang ditemukan, tangani error
        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Memeriksa apakah ada file gambar yang diupload
        if ($request->hasFile('birth_certificate_image')) {
            $image = $request->file('birth_certificate_image');
            $imageName = $this->generateRandomString() . '.' . $image->getClientOriginalExtension();
            // Path gambar
            $imagePath = 'images/birth_certificates/' . $imageName;
            $image->storeAs('', $imagePath, 'public');

            // Update gambar profil siswa
            $student->birth_card = $imagePath;
        }

        // Simpan perubahan
        $student->save();

        return back()->with('success', 'Berhasil menambahkan akte kelahiran');
    }



    private function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

}
