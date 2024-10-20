<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationStepParam;
use App\Models\RegistrationStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegistrationStepController extends Controller
{
    public function index()
    {
        $steps_smk = RegistrationStep::where('grade','SMK')->get();
        $steps_smp = RegistrationStep::where('grade', 'SMP')->get();

        return Inertia::render('Admin/RegistrationStep/RegistrationSteps',compact('steps_smk','steps_smp'));
    }

    public function create()
    {
        return Inertia::render('Admin/RegistrationStep/CreateRegistrationStep');
    }

    public function store(RegistrationStepParam $param)
    {
        $validatedData = $param->validated();

        DB::transaction(function() use ($validatedData){
            RegistrationStep::create($validatedData);
        });

        return redirect()->route('registration-step.index')->with('success', 'Pembuatan alur berhasil!');
    }

    public function edit(RegistrationStep $registrationStep) 
    {
        return Inertia::render('Admin/RegistrationStep/EditRegistrationStep', compact('registrationStep'));
    }

    public function update(RegistrationStepParam $param, RegistrationStep $registrationStep)
    {
        $validatedData = $param->validated();

        DB::transaction(function() use ($validatedData, $registrationStep) {
            $registrationStep->update($validatedData);
        });

        return redirect()->route('registration-step.index')->with('success', 'Berhasil memperbarui!');
    }

    public function destroy(RegistrationStep $registrationStep) 
    {
        $registrationStep->delete();

        return redirect()->route('registration-step.index')->with('success', 'Berhasil dihapus!');
    }
}
