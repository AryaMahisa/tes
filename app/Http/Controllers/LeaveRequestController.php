<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('leave.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('leave.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => ['required', 'in:izin,sakit,cuti'],
            'tanggal_mulai' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'alasan' => ['required', 'string', 'max:1000'],
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('leave.index')->with('success', 'Pengajuan berhasil dikirim, menunggu persetujuan admin.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === Auth::id(), 403);
        abort_unless($leaveRequest->status === 'pending', 403, 'Pengajuan yang sudah diproses tidak dapat dihapus.');

        $leaveRequest->delete();

        return back()->with('success', 'Pengajuan dibatalkan.');
    }
}
