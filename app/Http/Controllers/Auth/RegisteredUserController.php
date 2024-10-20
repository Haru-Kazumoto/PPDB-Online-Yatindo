<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    // public function showRegisterView(): Response
    // {
    //     $roles = Role::all();
    //     return Inertia::render('Auth/Register', [
    //         'roles' => $roles
    //     ]);
    // }

    public function showRegisterSmp()
    {
        return Inertia::render('Auth/RegisterSMP');
    }

    public function showRegisterSmk()
    {
        return Inertia::render('Auth/RegisterSMK');
    }

    /**
     * Creating a new user from superadmin
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => 'required|string',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id'
        ]);

        DB::beginTransaction();

        try {

            User::create([
                'fullname' => $request->input('fullname'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'role_id' => $request->input('role_id')
            ]);
            DB::commit();

            return redirect(route('login', absolute: false))->with('success', 'New user has registered');
        } catch(\Exception $e) {
            DB::rollback();

            return back()->with('failed', $e->getMessage());
        }
    }
}