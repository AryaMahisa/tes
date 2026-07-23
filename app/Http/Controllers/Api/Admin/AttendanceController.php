<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->date('tanggal') ?? today();

        $attendances = Attendance::with('user:id,name,email')
            ->whereDate('tanggal', $tanggal)
            ->when($request->user_id, fn ($q) => $q->where('user_id', $request->user_id))
            ->orderBy('jam_masuk')
            ->paginate(15);

        $rekap = [
            'hadir' => Attendance::whereDate('tanggal', $tanggal)->where('status', 'hadir')->count(),
            'terlambat' => Attendance::whereDate('tanggal', $tanggal)->where('status', 'terlambat')->count(),
            'total_user' => User::where('role', 'user')->count(),
        ];
        $rekap['alpha'] = max($rekap['total_user'] - $rekap['hadir'] - $rekap['terlambat'], 0);

        return response()->json([
            'tanggal' => $tanggal->toDateString(),
            'rekap' => $rekap,
            'data' => $attendances,
        ]);
    }
}
