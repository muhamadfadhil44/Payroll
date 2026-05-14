<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'login'])->name('login');

Route::post('/action/login', [AuthController::class, 'actionLogin'])
    ->name('action.login');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['role:admin'])->group(function () {

    Route::get('/admin', function () {
        $users = \App\Models\User::count();
        $employees = \App\Models\Employee::count();
        $positions = \App\Models\Position::count();
        $payrolls = \App\Models\Payroll::count();
        $attendances = \App\Models\Attendance::count();

        return view('admin.index', compact('users', 'employees', 'positions', 'payrolls', 'attendances'));
    });

    Route::get('/position', function () {
        return view('admin.position');
    });

    Route::get('/employee', function () {
        return view('admin.pegawai');
    });

    Route::get('/user', function () {
        return view('admin.pengguna');
    });

    Route::get('/payroll', function () {
        return view('admin.payroll');
    });

    Route::get('/admin/attendance', function () {
        return view('admin.attendance');
    });
});

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['role:user'])->group(function () {

    Route::get('/attendance', function () {
        return view('user.kehadiran');
    });

});