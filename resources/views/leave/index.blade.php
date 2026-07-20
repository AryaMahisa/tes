<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                Pengajuan Izin / Sakit / Cuti
            </h2>
            <a href="{{ route('leave.create') }}" class="rounded-lg bg-teal-700 px-4 py-2 text-sm font-medium text-white hover:bg-teal-800">
                + Ajukan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-lg bg-teal-50 border border-teal-200 px-4 py-3 text-sm text-teal-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2 pr-4">Jenis</th>
                                <th class="py-2 pr-4">Mulai</th>
                                <th class="py-2 pr-4">Selesai</th>
                                <th class="py-2 pr-4">Alasan</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaveRequests as $leave)
                                <tr class="border-b border-slate-50 last:border-0 align-top">
                                    <td class="py-3 pr-4 capitalize">{{ $leave->jenis }}</td>
                                    <td class="py-3 pr-4">{{ $leave->tanggal_mulai->translatedFormat('d M Y') }}</td>
                                    <td class="py-3 pr-4">{{ $leave->tanggal_selesai->translatedFormat('d M Y') }}</td>
                                    <td class="py-3 pr-4 max-w-xs">{{ $leave->alasan }}</td>
                                    <td class="py-3 pr-4">
                                        @php
                                            $badge = match($leave->status) {
                                                'disetujui' => 'bg-teal-100 text-teal-700',
                                                'ditolak' => 'bg-rose-100 text-rose-700',
                                                default => 'bg-amber-100 text-amber-700',
                                            };
                                        @endphp
                                        <span class="rounded-full px-2 py-0.5 text-xs {{ $badge }}">{{ ucfirst($leave->status) }}</span>
                                        @if ($leave->status === 'ditolak' && $leave->catatan_admin)
                                            <p class="mt-1 text-xs text-slate-400">{{ $leave->catatan_admin }}</p>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($leave->status === 'pending')
                                            <form method="POST" action="{{ route('leave.destroy', $leave) }}" onsubmit="return confirm('Batalkan pengajuan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-rose-600 hover:underline">Batalkan</button>
                                            </form>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-4 text-center text-slate-400">Belum ada pengajuan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
