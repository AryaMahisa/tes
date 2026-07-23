<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private string $batasMasuk = '08:00:00';

    public function index(Request $request)
    {
        $riwayat = Attendance::where('user_id', $request->user()->id)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return response()->json($riwayat);
    }

    public function today(Request $request)
    {
        $today = Attendance::where('user_id', $request->user()->id)
            ->whereDate('tanggal', today())
            ->first();

        return response()->json([
            'data' => $today,
        ]);
    }

    public function checkIn(Request $request)
    {
        $existing = Attendance::where('user_id', $request->user()->id)
            ->whereDate('tanggal', today())
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah melakukan check-in hari ini.',
            ], 422);
        }

        $now = now();
        $status = $now->format('H:i:s') > $this->batasMasuk ? 'terlambat' : 'hadir';

        $attendance = Attendance::create([
            'user_id' => $request->user()->id,
            'tanggal' => today(),
            'jam_masuk' => $now,
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Check-in berhasil dicatat.',
            'data' => $attendance,
        ], 201);
    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->whereDate('tanggal', today())
            ->first();

        if (! $attendance) {
            return response()->json([
                'message' => 'Anda belum melakukan check-in hari ini.',
            ], 422);
        }

        if ($attendance->jam_keluar) {
            return response()->json([
                'message' => 'Anda sudah melakukan check-out hari ini.',
            ], 422);
        }

        $attendance->update(['jam_keluar' => now()]);

        return response()->json([
            'message' => 'Check-out berhasil dicatat.',
            'data' => $attendance,
        ]);
    }
}
