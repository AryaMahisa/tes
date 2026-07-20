<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Ajukan Izin / Sakit / Cuti
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('leave.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="jenis" value="Jenis Pengajuan" />
                        <select id="jenis" name="jenis" required
                            class="mt-1 block w-full rounded-lg border-slate-300 focus:border-teal-600 focus:ring-teal-600">
                            <option value="izin" @selected(old('jenis') === 'izin')>Izin</option>
                            <option value="sakit" @selected(old('jenis') === 'sakit')>Sakit</option>
                            <option value="cuti" @selected(old('jenis') === 'cuti')>Cuti</option>
                        </select>
                        <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                            <x-text-input id="tanggal_mulai" name="tanggal_mulai" type="date" class="mt-1 block w-full" :value="old('tanggal_mulai')" required />
                            <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                            <x-text-input id="tanggal_selesai" name="tanggal_selesai" type="date" class="mt-1 block w-full" :value="old('tanggal_selesai')" required />
                            <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="alasan" value="Alasan" />
                        <textarea id="alasan" name="alasan" rows="4" required
                            class="mt-1 block w-full rounded-lg border-slate-300 focus:border-teal-600 focus:ring-teal-600">{{ old('alasan') }}</textarea>
                        <x-input-error :messages="$errors->get('alasan')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="rounded-lg bg-teal-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-teal-800">
                            Kirim Pengajuan
                        </button>
                        <a href="{{ route('leave.index') }}" class="text-sm font-medium text-slate-500 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
