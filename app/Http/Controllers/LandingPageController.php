<?php

namespace App\Http\Controllers;

use App\Models\RegistrationStep;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function show()
    {
        $step_smp = RegistrationStep::where('grade', 'SMP')->get();
        $step_smk = RegistrationStep::where('grade','SMK')->get();

        return Inertia::render('LandingPage', compact('step_smp','step_smk'));

    }
}
