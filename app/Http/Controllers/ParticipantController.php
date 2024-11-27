<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\RegistrationBatch;
use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\StudentPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ParticipantController extends Controller
{
    public function indexBatches() 
    {
        $batches = RegistrationBatch::withCount('students')->where('type','PEMBELIAN')->get();
        $return_batches = RegistrationBatch::withCount('returnStudents')->where('type','PENGEMBALIAN')->get();

        return Inertia::render('Admin/Participants/Participants', compact('batches','return_batches'));
    }

    public function detailBatchesAndParticipants(Request $request, RegistrationBatch $registrationBatch)
    {
        // Mengambil batch yang spesifik dan memuat daftar siswa beserta relasi ke payment dan address
        $registrationBatch->load([
            'students',                  // Memuat relasi 'students'
            'students.student.studentPayments',    // Memuat relasi 'studentPayment' dari 'students'
            'students.student.studentAddress',     // Memuat relasi 'studentAddress' dari 'students'
            'students.student.user'
        ]);

        // Ambil siswa berdasarkan batch dengan paginasi dan pencarian
        $studentsQuery = $registrationBatch->students()
            ->with('student.studentPayments', 'student.studentAddress', 'student.user'); // Memuat relasi yang diperlukan
        // dd($studentsQuery->get());

        // Pencarian berdasarkan nama siswa
        if ($request->filled('search_name')) {
            $studentsQuery->whereHas('student.studentInfo', function ($query) use ($request) {
                $query->where('fullname', 'like', "%{$request->search_name}%");
            });
        }

        // Melakukan paginasi pada query siswa
        $students = $studentsQuery->paginate(20);

        // Menghitung jumlah siswa
        $registrationBatch->loadCount('students');

        $registrationBatch->loadCount([
            'students as accepted_students_count' => function ($query) {
                $query->where('purchase_step_status', true);
            }
        ]);

        // dd($registrationBatch,$students);

        return Inertia::render('Admin/Participants/ListParticipants', [
            'registrationBatch' => $registrationBatch,
            'students' => $students,
            'search_name' => $request->search_name, // Mengirimkan nilai pencarian kembali ke frontend
        ]);
    }

    public function detailReturnBatchesAndParticipants(Request $request,RegistrationBatch $registrationBatch)
    {
        // Mengambil batch yang spesifik dan memuat daftar siswa beserta relasi ke payment dan address
        $registrationBatch->load([
            'returnStudents',                  // Memuat relasi 'students'
            'returnStudents.student.studentPayments',    // Memuat relasi 'studentPayment' dari 'students'
            'returnStudents.student.studentAddress',     // Memuat relasi 'studentAddress' dari 'students'
            'returnStudents.student.user'
        ]);

        // Ambil siswa berdasarkan batch dengan paginasi dan pencarian
        $studentsQuery = $registrationBatch->returnStudents()
            ->with('student.studentPayments', 'student.studentAddress', 'student.user'); // Memuat relasi yang diperlukan
        // dd($studentsQuery->get());

        // Pencarian berdasarkan nama siswa
        if ($request->filled('search_name')) {
            $studentsQuery->whereHas('student.studentInfo', function ($query) use ($request) {
                $query->where('fullname', 'like', "%{$request->search_name}%");
            });
        }

        // Melakukan paginasi pada query siswa
        $students = $studentsQuery->paginate(20);

        // Menghitung jumlah siswa
        $registrationBatch->loadCount('students');

        $registrationBatch->loadCount([
            'students as accepted_students_count' => function ($query) {
                $query->where('purchase_step_status', true);
            }
        ]);

        // dd($registrationBatch,$students);

        return Inertia::render('Admin/Participants/ListReturnParticipants', [
            'registrationBatch' => $registrationBatch,
            'students' => $students,
            'search_name' => $request->search_name, // Mengirimkan nilai pencarian kembali ke frontend
        ]);
    }

    public function exportPurchaseParticipant($batch_id) 
    {
        $batch = RegistrationBatch::where('id', $batch_id)->first();
        $batch_name = Str::lower(Str::replace(' ', '_', $batch->name));

        // Pass data student ke dalam StudentExport dan download sebagai Excel
        return Excel::download(new StudentExport($batch->id), 'data_siswa'.$batch_name.'.xlsx');
    }

    public function showParticipant(Student $student)
    {
        $student->load('studentInfo','studentAddress');
        $payment = StudentPayments::where('student_id', $student->id)
            ->where('batch_id', $student->studentInfo->batch_id)
            ->first();
         // Periksa apakah payment tidak null
        $paymentImage = $payment && $payment->payment_image ? asset('storage/' . $payment->payment_image) : null;

        // Gambar Kartu Keluarga dan Kartu Kelahiran
        $familyCardImage = $student->family_card ? asset('storage/' . $student->family_card) : null;
        $birthCardImage = $student->birth_card ? asset('storage/' . $student->birth_card) : null;

        // Gambar profil
        $profilePictureUrl = $student->studentInfo->profile_picture 
            ? asset('storage/' . $student->studentInfo->profile_picture)
            : null;

        return Inertia::render('Admin/Participants/DetailParticipants',[
            'student' => $student,
            'profilePictureUrl' => $profilePictureUrl,
            'payment' => $payment,
            'familyCardImage' => $familyCardImage,
            'birthCardImage' => $birthCardImage,
            'payment_image' => $paymentImage,
        ]);
    }

    public function showReturnParticipant(Student $student)
    {
        $student->load('studentInfo','studentAddress');
        $payment = StudentPayments::where('student_id', $student->id)
            ->where('batch_id', $student->studentInfo->return_batch_id)
            ->first();
        $paymentImage = $payment->payment_image ? asset('storage/'.$payment->payment_image) : null;
        $familyCardImage = $student->family_card ? asset('storage/'.$student->family_card) : null;
        $birthCardImage = $student->birth_card ? asset('storage/'.$student->birth_card) : null;
        $profilePictureUrl = $student->studentInfo->profile_picture 
            ? asset('storage/' . $student->studentInfo->profile_picture)
            : null;

        return Inertia::render('Admin/Participants/DetailParticipants',[
            'student' => $student,
            'profilePictureUrl' => $profilePictureUrl,
            'payment' => $payment,
            'familyCardImage' => $familyCardImage,
            'birthCardImage' => $birthCardImage,
            'payment_image' => $paymentImage,
        ]);
    }

    public function confirmPayment(StudentPayments $studentPayments) 
    {
        DB::transaction(function() use ($studentPayments) {
            $studentPayments->update([
                'status' => 'ACCEPTED',
            ]);
        });

        return back()->with('payment', $studentPayments)->with('success', 'Berhasil terkonfirmasi');
    }

    public function removeStudentFromBatch(Student $student,RegistrationBatch $registrationBatch)
    {
        DB::transaction(function () use ($student, $registrationBatch) {
            // Temukan siswa yang akan dihapus
            $studentToRemove = StudentInfo::where('id', $student->id)->first();

            if ($studentToRemove) {
                // Ambil indeks siswa yang dihapus
                $formNumberToRemove = $studentToRemove->form_number;
                $oldIndex = intval(substr($formNumberToRemove, -3)); // Ambil 3 digit terakhir dari form_number
                $batch_code = substr($formNumberToRemove, 5, 2); // Ambil batch_code dari form_number
                $year = substr($formNumberToRemove, 0, 4); // Ambil tahun dari form_number

                // Hapus siswa
                $studentToRemove->delete();

                // Ambil siswa lain di batch yang sama, yang memiliki index lebih besar
                $studentsInBatch = StudentInfo::where('batch_id', $registrationBatch->id)
                    ->where('id', '!=', $student->id) // Ambil semua siswa kecuali yang dihapus
                    ->orderBy('purchase_registration_date', 'asc')
                    ->get();

                // Update form_number untuk siswa yang tersisa
                foreach ($studentsInBatch as $studentBatch) {
                    $currentIndex = intval(substr($studentBatch->form_number, -3)); // Ambil index saat ini

                    // Jika index lebih besar dari index yang dihapus, kurangi 1
                    if ($currentIndex > $oldIndex) {
                        $newIndex = $currentIndex - 1;
                        $newFormNumber = sprintf("%s-%s-%03d", $year, $batch_code, $newIndex);

                        // Update form_number siswa
                        $studentBatch->update([
                            'form_number' => $newFormNumber,
                        ]);
                    }
                }
            }
        });

        return back()->with('success', 'Siswa berhasil dihapus dan indeks diperbarui.');
    }

}
