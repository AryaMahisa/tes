<?php

use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\LeaveRequestController as AdminLeaveRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==== Rute untuk role: user ====
    Route::middleware('role:user')->group(function () {
        Route::get('/absensi', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/absensi/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('/absensi/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.check-out');

        Route::get('/pengajuan-izin', [LeaveRequestController::class, 'index'])->name('leave.index');
        Route::get('/pengajuan-izin/buat', [LeaveRequestController::class, 'create'])->name('leave.create');
        Route::post('/pengajuan-izin', [LeaveRequestController::class, 'store'])->name('leave.store');
        Route::delete('/pengajuan-izin/{leaveRequest}', [LeaveRequestController::class, 'destroy'])->name('leave.destroy');
    });

    // ==== Rute untuk role: admin ====
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);

        Route::get('/absensi', [AdminAttendanceController::class, 'index'])->name('attendance.index');

        Route::get('/pengajuan-izin', [AdminLeaveRequestController::class, 'index'])->name('leave.index');
        Route::post('/pengajuan-izin/{leaveRequest}/setujui', [AdminLeaveRequestController::class, 'approve'])->name('leave.approve');
        Route::post('/pengajuan-izin/{leaveRequest}/tolak', [AdminLeaveRequestController::class, 'reject'])->name('leave.reject');
    });
});

require __DIR__.'/auth.php';
