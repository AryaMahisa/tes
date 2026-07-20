@php
    $user = $user ?? null;
@endphp

<div>
    <x-input-label for="name" value="Nama Lengkap" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user?->name)" required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div>
    <x-input-label for="email" value="Email" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user?->email)" required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div>
    <x-input-label for="phone" value="No. HP (opsional)" />
    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user?->phone)" />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>

<div>
    <x-input-label for="role" value="Role" />
    <select id="role" name="role" required class="mt-1 block w-full rounded-lg border-slate-300 focus:border-teal-600 focus:ring-teal-600">
        <option value="user" @selected(old('role', $user?->role) === 'user')>User (Pegawai)</option>
        <option value="admin" @selected(old('role', $user?->role) === 'admin')>Admin</option>
    </select>
    <x-input-error :messages="$errors->get('role')" class="mt-2" />
</div>

<div>
    <x-input-label for="password" :value="$user ? 'Password (kosongkan jika tidak diubah)' : 'Password'" />
    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :required="!$user" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
