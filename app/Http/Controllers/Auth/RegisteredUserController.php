<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentInfo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
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
    public function register(Request $request)
    {
        $dataValidated = $request->validate([
            'phone' => "required|string",
            'fullname' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string',
            'school_origin' => 'required|string',
            'password' => "required|string",
            'grade' => 'required|string',
        ]);

        DB::transaction(function() use ($dataValidated){
            $userCreated = User::create([
                'username' => $dataValidated['phone'],
                'password' => $dataValidated['password'],
            ]);

            $studentCreated = Student::create([
                'user_id' => $userCreated->id,
                'fullname' => $dataValidated['fullname'],
                'phone' => $dataValidated['phone'],
                'gender' => $dataValidated['gender'],
                'grade' => $dataValidated['grade'],
            ]);

            StudentAddress::create([
                'address' => $dataValidated['address'],
                'student_id' => $studentCreated->id,
            ]);

            StudentInfo::create([
                'school_origin' => $dataValidated['school_origin'],
                'student_id' => $studentCreated->id,
            ]);
        });

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silahkan login');
    }

    public function changePassword(Request $request,$user_id)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user_id,
            'password' => 'required|string'
        ],[
            'username.required' => "Username harus diisi",
            'username.unique' => "Username telah dipakai",
            'password.required' => "Password harus diisi",
        ]);

        $user = User::where('id', $user_id)->first();

        DB::transaction(function() use ($request,$user) {
            // Update username jika ada perubahan
            if ($request->username !== $user->username) {
                $user->username = $request->username;
            }

            // Update password
            $user->password = Hash::make($request->password);

            // Simpan perubahan ke database
            $user->save();
        });

        return back()->with('success','Berhasil mengganti informasi akun siswa');
    }
}