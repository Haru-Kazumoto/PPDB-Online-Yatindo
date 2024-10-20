<?php

namespace App\Http\Controllers;

use App\Models\RegistrationBatch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParticipantController extends Controller
{
    public function indexBatches() 
    {
        $batches = RegistrationBatch::all();

        return Inertia::render('Admin/Participants/Participants', compact('batches'));
    }

    public function detailBatchesAndParticipants(RegistrationBatch $registrationBatch)
    {
        return Inertia::render('Admin/Participants/ListParticipants', compact('registrationBatch'));
    }
}
