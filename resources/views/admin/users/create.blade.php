<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Tambah Pengguna
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
                    @csrf
                    @include('admin.users._form')

                    <div class="flex items-center gap-3">
                        <button type="submit" class="rounded-lg bg-teal-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-teal-800">
                            Simpan
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-slate-500 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
