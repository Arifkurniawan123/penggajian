<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">

        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header class="flex items-center justify-between">
                <flux:heading class="!font-bold text-lg">Penggajian</flux:heading>
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="building-office-2" :href="route('departement.index')" :current="request()->routeIs('departement.*')" wire:navigate>
                        {{ __('Departemen') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="briefcase" :href="route('jabatan.index')" :current="request()->routeIs('jabatan.*')" wire:navigate>
                        {{ __('Jabatan') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="users" :href="route('karyawan.index')" :current="request()->routeIs('karyawan.*')" wire:navigate>
                        {{ __('Karyawan') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="banknotes" :href="route('penggajian.index')" :current="request()->routeIs('penggajian.*')" wire:navigate>
                        {{ __('Penggajian') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="user" :href="route('user.index')" :current="request()->routeIs('user.*')" wire:navigate>
                        {{ __('User') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            {{-- Footer / user menu, tanpa flux:sidebar.footer & flux:sidebar.profile (tidak tersedia di project ini) --}}
            <div class="p-2 border-t border-zinc-200 dark:border-zinc-700">
                @auth
                    <flux:dropdown position="top" align="start" class="w-full">
                        <flux:button variant="ghost" class="w-full justify-start gap-2">
                            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-700 text-xs font-medium">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="flex-1 text-start truncate">{{ auth()->user()->name }}</span>
                        </flux:button>

                        <flux:menu>
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="strtoupper(substr(auth()->user()->name, 0, 1))"
                                />
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>

                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item
                                    as="button"
                                    type="submit"
                                    icon="arrow-right-start-on-rectangle"
                                    class="w-full cursor-pointer"
                                    data-test="logout-button"
                                >
                                    {{ __('Log out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                @endauth

                @guest
                    <flux:sidebar.item icon="arrow-right-end-on-rectangle" :href="route('login')" wire:navigate>
                        {{ __('Login') }}
                    </flux:sidebar.item>
                @endguest
            </div>
        </flux:sidebar>

        <!-- Mobile top bar (toggle sidebar di layar kecil) -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Dipakai untuk tombol Hapus di semua halaman index (departemen, jabatan, karyawan, penggajian, user)
            function confirmDelete(url) {
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            // Dipakai untuk tombol Simpan di form Create/Update (opsional, kalau mau ada konfirmasi sebelum submit)
            function confirmSave(event) {
                event.preventDefault();
                const form = event.target;
                Swal.fire({
                    title: 'Simpan data ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>

        @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: @json(session('error')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            </script>
        @endif
    </body>
</html>