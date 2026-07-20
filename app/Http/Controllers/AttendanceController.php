<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /** Batas waktu jam masuk sebelum dianggap terlambat */
    private string $batasMasuk = '08:00:00';

    public function index()
    {
        $today = Attendance::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->first();

        $riwayat = Attendance::where('user_id', Auth::id())
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('attendance.index', compact('today', 'riwayat'));
    }

    public function checkIn(Request $request)
    {
        $existing = Attendance::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        $now = now();
        $status = $now->format('H:i:s') > $this->batasMasuk ? 'terlambat' : 'hadir';

        Attendance::create([
            'user_id' => Auth::id(),
            'tanggal' => today(),
            'jam_masuk' => $now,
            'status' => $status,
        ]);

        return back()->with('success', 'Check-in berhasil dicatat pukul ' . $now->format('H:i'));
    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->first();

        if (! $attendance) {
            return back()->with('error', 'Anda belum melakukan check-in hari ini.');
        }

        if ($attendance->jam_keluar) {
            return back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $attendance->update(['jam_keluar' => now()]);

        return back()->with('success', 'Check-out berhasil dicatat pukul ' . now()->format('H:i'));
    }
}
