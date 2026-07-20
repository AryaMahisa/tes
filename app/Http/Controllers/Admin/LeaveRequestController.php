<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $leaveRequests = LeaveRequest::with('user')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.leave.index', compact('leaveRequests'));
    }

    public function approve(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'disetujui',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function reject(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:1000'],
        ]);

        $leaveRequest->update([
            'status' => 'ditolak',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'catatan_admin' => $validated['catatan_admin'] ?? null,
        ]);

        return back()->with('success', 'Pengajuan ditolak.');
    }
}
