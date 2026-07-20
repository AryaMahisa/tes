<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                Kelola Pengguna
            </h2>
            <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-teal-700 px-4 py-2 text-sm font-medium text-white hover:bg-teal-800">
                + Tambah Pengguna
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
                <form method="GET" class="mb-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                        class="w-full max-w-sm rounded-lg border-slate-300 text-sm focus:border-teal-600 focus:ring-teal-600">
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2 pr-4">Nama</th>
                                <th class="py-2 pr-4">Email</th>
                                <th class="py-2 pr-4">No. HP</th>
                                <th class="py-2 pr-4">Role</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-slate-50 last:border-0">
                                    <td class="py-3 pr-4">{{ $user->name }}</td>
                                    <td class="py-3 pr-4">{{ $user->email }}</td>
                                    <td class="py-3 pr-4">{{ $user->phone ?? '-' }}</td>
                                    <td class="py-3 pr-4">
                                        <span class="rounded-full px-2 py-0.5 text-xs {{ $user->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex gap-3">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-teal-700 hover:underline">Edit</a>
                                            @if ($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-rose-600 hover:underline">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-4 text-center text-slate-400">Tidak ada data pengguna.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
