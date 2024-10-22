<?php

namespace App\Http\Controllers;

use App\Models\RegistrationBatch;
use App\Models\RegistrationPath;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegistrationBatchController extends Controller
{
    public function index()
    {
        $batches = RegistrationBatch::all();

        return Inertia::render("Admin/Participants/Participants", compact('batches'));
    }

    public function create(RegistrationPath $registrationPath)
    {
        return Inertia::render('Admin/RegistrationBatch/CreateRegistrationBatch', compact('registrationPath'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_quota' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'grade' => 'required|string',
            'bank_name' => 'required|string',
            'bank_username' => 'required|string',
            'bank_number_account' => 'required|string',
            'batch_code' => 'required|string',
            'type' => 'required|string',
            'sub_type' => 'required|string',
            'registration_path_id' => 'required|exists:registration_paths,id',
        ]);

        DB::transaction(function () use ($request) {
            $path = RegistrationPath::where('id', $request->registration_path_id)->first();

            RegistrationBatch::create([
                'name' => $request->name,
                'max_quota' => $request->max_quota,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'bank_name' => $request->bank_name,
                'bank_username' => $request->bank_username,
                'bank_number_account' => $request->bank_number_account,
                'registration_price' => $request->registration_price,
                'registration_path_id' => $path->id,
                'type' => $path->type,
                'sub_type' => $request->sub_type,
                'batch_code' => $request->batch_code,
            ]);

        });

        return redirect()->route('registration-path.detail', $request->registration_path_id)->with('success', 'Gelombang berhasil dibuat.');
    }

    public function show(RegistrationBatch $registrationBatch)
    {
        return Inertia::render('RegistrationBatch/Show', [
            'registrationBatch' => $registrationBatch,
        ]);
    }



    public function edit(RegistrationBatch $registrationBatch)
    {
        $paths = RegistrationPath::all();
        return Inertia::render('RegistrationBatch/Edit', [
            'registrationBatch' => $registrationBatch,
            'paths' => $paths,
        ]);
    }

    public function update(Request $request, RegistrationBatch $registrationBatch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_quota' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'registration_paths_id' => 'required|exists:registration_paths,id',
        ]);

        DB::transaction(function () use ($request, $registrationBatch) {
            $registrationBatch->update([
                'name' => $request->name,
                'max_quota' => $request->max_quota,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'bank_name' => $request->bank_name,
                'bank_username' => $request->bank_username,
                'bank_number_account' => $request->bank_number_account,
                'registration_price' => $request->registration_price,
                'registration_paths_id' => $request->registration_paths_id,
            ]);
        });

        return redirect()->route('registration-batch.index')->with('success', 'Gelombang berhasil diperbarui.');
    }

    public function destroy(RegistrationBatch $registrationBatch)
    {
        DB::transaction(function () use ($registrationBatch) {
            $registrationBatch->delete();
        });

        return redirect()->route('registration-path.index')->with('success', 'Gelombang berhasil dihapus.');
    }
}
