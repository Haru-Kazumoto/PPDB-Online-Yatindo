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

class PurchasingController extends Controller
{
    public function index()
    {
        $studentInfo = Auth::user()->student->studentInfo;
        $current = $studentInfo->current_step;
        $data = [];

        $batches_query = RegistrationBatch::where('type', 'PEMBELIAN');

        if ($current == 1) {
            $data = [
                'batches' => $batches_query->get(),
            ];
        } else if ($current == 2) {
            $data = [
                'batches' => $batches_query->where('id', $studentInfo->batch_id)->first(),
                'payments' => StudentPayments::where('student_id', $studentInfo->student->id)->get(),
            ];
        } else if ($current == 3 && Auth::user()->student->grade == 'SMK') {
            $data = [
                'batches' => $batches_query->where('id', $studentInfo->batch_id)->first()
            ];
        } else {
            $batches = $batches_query->where('id', $studentInfo->batch_id)->first();

            $jalur = RegistrationPath::where('id', $batches->registration_path_id)->first();

            $jurusan = StudentLogs::where('student_id', Auth::user()->student->id)->first();

            $data = [
                "jalur" => $jalur,
                "jurusan" => $jurusan
            ];
        }
        return Inertia::render('Student/PurchasingSteps/Index', compact('current', 'data'));
    }

    public function updateInfo(Request $request)
    {
        $student_info = Auth::user()->student->studentInfo;
        $students_in_batch = StudentInfo::where('batch_id', $request->batch_id)
            ->orderBy('purchase_registration_date', 'asc')
            ->get();

        // Hitung nomor urut siswa berikutnya
        $index = $students_in_batch->count() + 1; // Index dimulai dari 1 dan terus meningkat
        $year = Carbon::now()->year;
        $batch_code = $request->batch_code;
        $form_number = sprintf("%d-%s-%03d", $year, $batch_code, $index);

        if ($student_info->current_step == 1) {
            $student_info->update([
                'current_step' => $student_info->current_step + 1,
                'step_name' => 'PILIH GELOMBANG PPDB',
                'step_type' => $request->type,
                'batch_id' => $request->batch_id,
                'purchase_registration_date' => Carbon::now(),
                'form_number' => $form_number,
            ]);
        } else if ($student_info->current_step == 2) {
            $student_info->update([
                'current_step' => $student_info->current_step + 1,
                'step_name' => 'PEMBAYARAN FORMULIR',
            ]);
        } else if ($student_info->current_step == 3) {
            $student_info->update([
                'current_step' => $student_info->current_step + 1,
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
        } else if($student_info->current_step == 4) {
            $student_info->update([
                'current_step' => $student_info->current_step + 1,
                'step_name' => 'CETAK KARTU PEMBELIAN',
                'purchase_step_status' => true,
            ]);
        }

        return back()->with('success', 'Berhasil daftar');
    }

    public function addPayment(Request $request)
    {
        $payment = new StudentPayments();
        $payment->total = 0;
        $payment->payment_method = $request->payment_method;
        $payment->status = "PENDING";
        $payment->student_id = Auth::user()->student->id;
        $payment->batch_id = Auth::user()->student->studentInfo->batch_id;

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

    // public function showPurchase()
    // {
    //     return Inertia::render('Student/PurchasingSteps/Pay');
    // }

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
