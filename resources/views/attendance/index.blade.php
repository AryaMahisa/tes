<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Absensi Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-lg bg-teal-50 border border-teal-200 px-4 py-3 text-sm text-teal-800">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="rounded-lg bg-rose-50 border border-rose-200 px-4 py-3 text-sm text-rose-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Check in/out card -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                        @if ($today)
                            <p class="mt-1 text-lg font-medium text-slate-800">
                                Masuk: {{ $today->jam_masuk?->format('H:i') ?? '-' }}
                                &nbsp;·&nbsp;
                                Keluar: {{ $today->jam_keluar?->format('H:i') ?? 'Belum check-out' }}
                            </p>
                            <span class="mt-1 inline-block rounded-full px-2 py-0.5 text-xs {{ $today->status === 'terlambat' ? 'bg-rose-100 text-rose-700' : 'bg-teal-100 text-teal-700' }}">
                                {{ ucfirst($today->status) }}
                            </span>
                        @else
                            <p class="mt-1 text-lg font-medium text-slate-400">Anda belum check-in hari ini</p>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        <form method="POST" action="{{ route('attendance.check-in') }}">
                            @csrf
                            <button type="submit" @disabled($today)
                                class="rounded-lg bg-teal-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-teal-800 disabled:cursor-not-allowed disabled:opacity-40">
                                Check-in
                            </button>
                        </form>
                        <form method="POST" action="{{ route('attendance.check-out') }}">
                            @csrf
                            <button type="submit" @disabled(!$today || $today->jam_keluar)
                                class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40">
                                Check-out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- History -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 font-medium text-slate-800">Riwayat Absensi</h3>
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
                            @forelse ($riwayat as $r)
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
                <div class="mt-4">
                    {{ $riwayat->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
