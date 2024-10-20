<?php

namespace App\Http\Controllers;

use App\Models\RegistrationBatch;
use App\Models\StudentInfo;
use App\Models\StudentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PurchasingController extends Controller
{
    public function index()
    {
        $batches = RegistrationBatch::where('type', 'PEMBELIAN')->get();

        return Inertia::render('Student/PurchasingSteps/Purchasing', compact('batches'));
    }

    public function purchaseForm(Request $request) 
    {
        $student_info = Auth::user()->student->studentInfo;

        $student_info->update([
            'current_step' => $student_info->current_step + 1,
            'step_name' => 'PILIH GELOMBANG PPDB',
            'step_type' => $request->input('type'),
            'batch_id' => $request->input('batch_id'),
        ]);

        return redirect()->route('purchasing.purchase')->with('success', 'Berhasil daftar');
    }

    public function showPurchase()
    {
        return Inertia::render('Student/PurchasingSteps/Pay');
    }

}
