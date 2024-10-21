<?php

namespace App\Http\Controllers;

use App\Models\RegistrationBatch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParticipantController extends Controller
{
    public function indexBatches() 
    {
        $batches = RegistrationBatch::withCount('students')->get();

        return Inertia::render('Admin/Participants/Participants', compact('batches'));
    }

    public function detailBatchesAndParticipants(RegistrationBatch $registrationBatch)
    {
        // Mengambil batch yang spesifik dan memuat daftar siswa beserta relasi ke payment dan address
        $registrationBatch->load([
            'students',                  // Memuat relasi 'students'
            'students.student.studentPayments',    // Memuat relasi 'studentPayment' dari 'students'
            'students.student.studentAddress'     // Memuat relasi 'studentAddress' dari 'students'
        ]);

        // Menghitung jumlah siswa
        $registrationBatch->loadCount('students');

        $registrationBatch->loadCount([
            'students as accepted_students_count' => function ($query) {
                $query->where('purchase_step_status', true);
            }
        ]);

        // Debugging untuk melihat data
        // dd($registrationBatch);

        return Inertia::render('Admin/Participants/ListParticipants', compact('registrationBatch'));
    }
}
