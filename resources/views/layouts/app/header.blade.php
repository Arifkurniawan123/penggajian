<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="building-office-2" :href="route('departement.index')" :current="request()->routeIs('departement.*')" wire:navigate>
                    {{ __('Departemen') }}
                </flux:navbar.item>
                <flux:navbar.item icon="briefcase" :href="route('jabatan.index')" :current="request()->routeIs('jabatan.*')" wire:navigate>
                    {{ __('Jabatan') }}
                </flux:navbar.item>
                <flux:navbar.item icon="users" :href="route('karyawan.index')" :current="request()->routeIs('karyawan.*')" wire:navigate>
                    {{ __('Karyawan') }}
                </flux:navbar.item>
                <flux:navbar.item icon="banknotes" :href="route('penggajian.index')" :current="request()->routeIs('penggajian.*')" wire:navigate>
                    {{ __('Penggajian') }}
                </flux:navbar.item>
                <flux:navbar.item icon="user" :href="route('user.index')" :current="request()->routeIs('user.*')" wire:navigate>
                    {{ __('User') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
            </flux:navbar>

            @auth
                <!-- User Menu (Hanya Logout) -->
                <flux:dropdown position="bottom" align="end">
                    <flux:button class="h-10 w-10 rounded-full border-0! bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300 dark:hover:bg-zinc-600">
                        <span class="font-medium text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </flux:button>

                    <flux:menu>
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>

                        <flux:menu.separator />

                        <!-- HANYA LOGOUT -->
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
                <flux:navbar.item icon="arrow-right-end-on-rectangle" :href="route('login')" wire:navigate>
                    {{ __('Login') }}
                </flux:navbar.item>
            @endguest
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
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

            <flux:sidebar.nav>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:sidebar.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer text-red-500"
                        >
                            {{ __('Log out') }}
                        </flux:sidebar.item>
                    </form>
                @endauth
            </flux:sidebar.nav>
        </flux:sidebar>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>