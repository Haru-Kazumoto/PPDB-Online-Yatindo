<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationPathParam;
use App\Models\RegistrationPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegistrationPathController extends Controller
{
    public function index() 
    {
        $registrationPaths = RegistrationPath::all();

        return Inertia::render('Admin/RegistrationPath/RegistrationPath', compact('registrationPaths'));
    }

    public function show(RegistrationPath $registrationPath)
    {
        $registrationPath->load('registrationBatches');
        $batchCount = $registrationPath->registrationBatches->count();

        return Inertia::render('Admin/RegistrationPath/DetailRegistrationPath', compact('registrationPath', 'batchCount'));
    }

    public function create()
    {
        return Inertia::render('Admin/RegistrationPath/CreateRegistrationPath');
    }

    public function store(RegistrationPathParam $param)
    {
        $validatedData = $param->validated();

        DB::transaction(function() use ($validatedData) {
            RegistrationPath::create($validatedData);
        });

        return redirect()->route('registration-path.index')->with('success', 'Berhasil membuat jalur!');
    }

    public function edit(RegistrationPath $registrationPath)
    {
        return Inertia::render('Admin/RegistrationPath/EditRegistrationPath', compact('registrationPath'));
    }

    public function update(RegistrationPathParam $param, RegistrationPath $registrationPath)
    {
        $validatedData = $param->validated();

        DB::transaction(function() use ($validatedData, $registrationPath) {
            $registrationPath->update($validatedData);
        });

        return redirect()->route('registration-path.index')->with('success', 'Berhasil memperbarui jalur!');
    }

    public function destroy(RegistrationPath $registrationPath)
    {
        $registrationPath->delete();

        return redirect()->route('registration-path.index')->with('success', 'Berhasil menghapus jalur!');
    }
}
