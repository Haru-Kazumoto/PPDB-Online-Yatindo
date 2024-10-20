<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function showAdminDashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function showStudentDashboard()
    {
        return Inertia::render('Student/Dashboard');
    }
}
