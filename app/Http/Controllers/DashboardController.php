<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalUsers = User::where('role', 'user')->count();
            $todayCount = Attendance::whereDate('tanggal', today())->count();
            $pendingLeave = LeaveRequest::where('status', 'pending')->count();
            $terlambatBulanIni = Attendance::where('status', 'terlambat')
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count();

            // Data grafik: jumlah kehadiran 7 hari terakhir
            $chartLabels = [];
            $chartData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $chartLabels[] = $date->translatedFormat('D, d M');
                $chartData[] = Attendance::whereDate('tanggal', $date)->count();
            }

            $recentLeave = LeaveRequest::with('user')
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.admin', compact(
                'totalUsers',
                'todayCount',
                'pendingLeave',
                'terlambatBulanIni',
                'chartLabels',
                'chartData',
                'recentLeave'
            ));
        }

        // Dashboard untuk role user
        $sudahAbsenHariIni = Attendance::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        $hadirBulanIni = Attendance::where('user_id', $user->id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();

        $izinBulanIni = LeaveRequest::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->whereMonth('tanggal_mulai', now()->month)
            ->count();

        $riwayatTerbaru = Attendance::where('user_id', $user->id)
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('dashboard.user', compact(
            'sudahAbsenHariIni',
            'hadirBulanIni',
            'izinBulanIni',
            'riwayatTerbaru'
        ));
    }
}
