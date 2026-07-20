<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Persetujuan Izin / Sakit / Cuti
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-lg bg-teal-50 border border-teal-200 px-4 py-3 text-sm text-teal-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <form method="GET" class="mb-4">
                    <select name="status" onchange="this.form.submit()"
                        class="rounded-lg border-slate-300 text-sm focus:border-teal-600 focus:ring-teal-600">
                        <option value="">Semua Status</option>
                        <option value="pending" @selected(request('status') === 'pending')>Menunggu</option>
                        <option value="disetujui" @selected(request('status') === 'disetujui')>Disetujui</option>
                        <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
                    </select>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2 pr-4">Pegawai</th>
                                <th class="py-2 pr-4">Jenis</th>
                                <th class="py-2 pr-4">Periode</th>
                                <th class="py-2 pr-4">Alasan</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaveRequests as $leave)
                                <tr class="border-b border-slate-50 last:border-0 align-top">
                                    <td class="py-3 pr-4">{{ $leave->user->name }}</td>
                                    <td class="py-3 pr-4 capitalize">{{ $leave->jenis }}</td>
                                    <td class="py-3 pr-4">
                                        {{ $leave->tanggal_mulai->translatedFormat('d M') }} -
                                        {{ $leave->tanggal_selesai->translatedFormat('d M Y') }}
                                    </td>
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
                                    </td>
                                    <td class="py-3">
                                        @if ($leave->status === 'pending')
                                            <div class="flex gap-3">
                                                <form method="POST" action="{{ route('admin.leave.approve', $leave) }}">
                                                    @csrf
                                                    <button type="submit" class="font-medium text-teal-700 hover:underline">Setujui</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.leave.reject', $leave) }}" onsubmit="return confirm('Tolak pengajuan ini?')">
                                                    @csrf
                                                    <button type="submit" class="font-medium text-rose-600 hover:underline">Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-4 text-center text-slate-400">Tidak ada pengajuan.</td></tr>
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
