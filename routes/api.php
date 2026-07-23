<?php

use App\Http\Controllers\Api\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Api\Admin\LeaveRequestController as AdminLeaveRequestController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaveRequestController;
use Illuminate\Support\Facades\Route;

// ==== Publik (tidak perlu token) ====
Route::post('/login', [AuthController::class, 'login']);

// ==== Perlu token (Sanctum) ====
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ---- Role: user ----
    Route::middleware('role:user')->group(function () {
        Route::get('/attendance', [AttendanceController::class, 'index']);
        Route::get('/attendance/today', [AttendanceController::class, 'today']);
        Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
        Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);

        Route::get('/leave-requests', [LeaveRequestController::class, 'index']);
        Route::post('/leave-requests', [LeaveRequestController::class, 'store']);
        Route::delete('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'destroy']);
    });

    // ---- Role: admin ----
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/attendance', [AdminAttendanceController::class, 'index']);

        Route::get('/leave-requests', [AdminLeaveRequestController::class, 'index']);
        Route::post('/leave-requests/{leaveRequest}/approve', [AdminLeaveRequestController::class, 'approve']);
        Route::post('/leave-requests/{leaveRequest}/reject', [AdminLeaveRequestController::class, 'reject']);
    });
});
