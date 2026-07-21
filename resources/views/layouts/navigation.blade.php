<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center gap-2">
                    <img src="{{ asset('bendera.png') }}" alt="Logo" class="h-11 w-11 rounded-xl object-contain">
                    <span class="font-semibold text-slate-800 text-lg">Absensi<span class="text-teal-700">Ku</span></span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if (auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            Kelola Pengguna
                        </x-nav-link>
                        <x-nav-link :href="route('admin.attendance.index')" :active="request()->routeIs('admin.attendance.*')">
                            Rekap Absensi
                        </x-nav-link>
                        <x-nav-link :href="route('admin.leave.index')" :active="request()->routeIs('admin.leave.*')">
                            Persetujuan Izin
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.*')">
                            Absensi Saya
                        </x-nav-link>
                        <x-nav-link :href="route('leave.index')" :active="request()->routeIs('leave.*')">
                            Pengajuan Izin
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-slate-500 transition duration-150 ease-in-out hover:text-slate-700 focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-xs text-slate-500">{{ Auth::user()->isAdmin() ? 'Admin' : 'Pegawai' }}</span>
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-400 transition duration-150 ease-in-out hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if (auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Kelola Pengguna</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.attendance.index')" :active="request()->routeIs('admin.attendance.*')">Rekap Absensi</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.leave.index')" :active="request()->routeIs('admin.leave.*')">Persetujuan Izin</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.*')">Absensi Saya</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('leave.index')" :active="request()->routeIs('leave.*')">Pengajuan Izin</x-responsive-nav-link>
            @endif
        </div>

        <div class="border-t border-slate-200 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-slate-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>