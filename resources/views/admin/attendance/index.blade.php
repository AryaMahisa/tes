<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Rekap Absensi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Summary cards -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Hadir</p>
                    <p class="mt-2 text-3xl font-semibold text-teal-700">{{ $rekap['hadir'] }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Terlambat</p>
                    <p class="mt-2 text-3xl font-semibold text-amber-600">{{ $rekap['terlambat'] }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Belum Absen (Alpha)</p>
                    <p class="mt-2 text-3xl font-semibold text-rose-600">{{ $rekap['alpha'] }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Total Pegawai</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">{{ $rekap['total_user'] }}</p>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <form method="GET" class="mb-4 flex flex-wrap items-end gap-3">
                    <div>
                        <label class="block text-xs text-slate-500 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}"
                            class="rounded-lg border-slate-300 text-sm focus:border-teal-600 focus:ring-teal-600">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-500 mb-1">Pegawai</label>
                        <select name="user_id" class="rounded-lg border-slate-300 text-sm focus:border-teal-600 focus:ring-teal-600">
                            <option value="">Semua Pegawai</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(request('user_id') == $u->id)>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="rounded-lg bg-teal-700 px-4 py-2 text-sm font-medium text-white hover:bg-teal-800">
                        Filter
                    </button>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2 pr-4">Nama</th>
                                <th class="py-2 pr-4">Tanggal</th>
                                <th class="py-2 pr-4">Masuk</th>
                                <th class="py-2 pr-4">Keluar</th>
                                <th class="py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $a)
                                <tr class="border-b border-slate-50 last:border-0">
                                    <td class="py-3 pr-4">{{ $a->user->name }}</td>
                                    <td class="py-3 pr-4">{{ $a->tanggal->translatedFormat('d M Y') }}</td>
                                    <td class="py-3 pr-4">{{ $a->jam_masuk?->format('H:i') ?? '-' }}</td>
                                    <td class="py-3 pr-4">{{ $a->jam_keluar?->format('H:i') ?? '-' }}</td>
                                    <td class="py-3">
                                        <span class="rounded-full px-2 py-0.5 text-xs {{ $a->status === 'terlambat' ? 'bg-rose-100 text-rose-700' : 'bg-teal-100 text-teal-700' }}">
                                            {{ ucfirst($a->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-4 text-center text-slate-400">Tidak ada data absensi pada tanggal ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
