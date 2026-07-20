<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@absensi.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $users = collect(['Andi Pratama', 'Budi Santoso', 'Citra Lestari', 'Dewi Anggraini'])
            ->map(fn ($name, $i) => User::create([
                'name' => $name,
                'email' => 'user' . ($i + 1) . '@absensi.test',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]));

        // Contoh data absensi 5 hari terakhir untuk setiap user
        foreach ($users as $user) {
            for ($i = 5; $i >= 1; $i--) {
                $tanggal = now()->subDays($i);
                if ($tanggal->isWeekend()) {
                    continue;
                }
                Attendance::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam_masuk' => $tanggal->copy()->setTime(7, rand(45, 59)),
                    'jam_keluar' => $tanggal->copy()->setTime(16, rand(0, 30)),
                    'status' => rand(0, 4) === 0 ? 'terlambat' : 'hadir',
                ]);
            }
        }

        // Contoh pengajuan izin
        LeaveRequest::create([
            'user_id' => $users[0]->id,
            'jenis' => 'sakit',
            'tanggal_mulai' => now()->addDay()->toDateString(),
            'tanggal_selesai' => now()->addDays(2)->toDateString(),
            'alasan' => 'Demam dan perlu istirahat sesuai anjuran dokter.',
            'status' => 'pending',
        ]);
    }
}
