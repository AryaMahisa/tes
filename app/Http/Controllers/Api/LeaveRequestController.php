<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $leaveRequests = LeaveRequest::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json($leaveRequests);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => ['required', 'in:izin,sakit,cuti'],
            'tanggal_mulai' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'alasan' => ['required', 'string', 'max:1000'],
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'pending';

        $leave = LeaveRequest::create($validated);

        return response()->json([
            'message' => 'Pengajuan berhasil dikirim.',
            'data' => $leave,
        ], 201);
    }

    public function destroy(Request $request, LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === $request->user()->id, 403);
        abort_unless($leaveRequest->status === 'pending', 422, 'Pengajuan yang sudah diproses tidak dapat dihapus.');

        $leaveRequest->delete();

        return response()->json([
            'message' => 'Pengajuan dibatalkan.',
        ]);
    }
}
