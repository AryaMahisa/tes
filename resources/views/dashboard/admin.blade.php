<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Stat cards -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Total Pegawai</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">{{ $totalUsers }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Absen Hari Ini</p>
                    <p class="mt-2 text-3xl font-semibold text-teal-700">{{ $todayCount }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Izin/Cuti Menunggu</p>
                    <p class="mt-2 text-3xl font-semibold text-amber-600">{{ $pendingLeave }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Terlambat Bulan Ini</p>
                    <p class="mt-2 text-3xl font-semibold text-rose-600">{{ $terlambatBulanIni }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Chart -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
                    <h3 class="mb-4 font-medium text-slate-800">Kehadiran 7 Hari Terakhir</h3>
                    <canvas id="attendanceChart" height="120"></canvas>
                </div>

                <!-- Pending leave list -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="mb-4 font-medium text-slate-800">Pengajuan Izin Terbaru</h3>
                    @forelse ($recentLeave as $leave)
                        <div class="mb-3 border-b border-slate-100 pb-3 last:mb-0 last:border-0 last:pb-0">
                            <p class="text-sm font-medium text-slate-700">{{ $leave->user->name }}</p>
                            <p class="text-xs text-slate-500">{{ ucfirst($leave->jenis) }} · {{ $leave->tanggal_mulai->translatedFormat('d M Y') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Tidak ada pengajuan yang menunggu.</p>
                    @endforelse
                    <a href="{{ route('admin.leave.index') }}" class="mt-2 inline-block text-sm font-medium text-teal-700 hover:underline">Lihat semua &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script>
        const ctx = document.getElementById('attendanceChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Absen',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: '#0f766e',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
    @endpush
</x-app-layout>
