<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Dashboard Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Status Hari Ini</p>
                    @if ($sudahAbsenHariIni)
                        <p class="mt-2 text-2xl font-semibold {{ $sudahAbsenHariIni->status === 'terlambat' ? 'text-rose-600' : 'text-teal-700' }}">
                            {{ ucfirst($sudahAbsenHariIni->status) }}
                        </p>
                    @else
                        <p class="mt-2 text-2xl font-semibold text-slate-400">Belum Absen</p>
                    @endif
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Hadir Bulan Ini</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">{{ $hadirBulanIni }} hari</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Izin/Cuti Disetujui</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">{{ $izinBulanIni }}</p>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium text-slate-800">Riwayat Absensi Terbaru</h3>
                    <a href="{{ route('attendance.index') }}" class="text-sm font-medium text-teal-700 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2 pr-4">Tanggal</th>
                                <th class="py-2 pr-4">Masuk</th>
                                <th class="py-2 pr-4">Keluar</th>
                                <th class="py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayatTerbaru as $r)
                                <tr class="border-b border-slate-50 last:border-0">
                                    <td class="py-2 pr-4">{{ $r->tanggal->translatedFormat('d M Y') }}</td>
                                    <td class="py-2 pr-4">{{ $r->jam_masuk?->format('H:i') ?? '-' }}</td>
                                    <td class="py-2 pr-4">{{ $r->jam_keluar?->format('H:i') ?? '-' }}</td>
                                    <td class="py-2">
                                        <span class="rounded-full px-2 py-0.5 text-xs {{ $r->status === 'terlambat' ? 'bg-rose-100 text-rose-700' : 'bg-teal-100 text-teal-700' }}">
                                            {{ ucfirst($r->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-4 text-center text-slate-400">Belum ada riwayat absensi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
