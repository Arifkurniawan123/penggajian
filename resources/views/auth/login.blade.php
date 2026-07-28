<x-layouts::auth.simple :title="$title ?? 'Login'">
    <div class="flex flex-col gap-6">

        <div class="flex flex-col items-center gap-2 text-center">
            <flux:heading size="xl">Sistem Penggajian</flux:heading>
            <flux:text class="text-zinc-500">Login untuk mengakses sistem</flux:text>
        </div>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">
                {{ session('success') }}
            </flux:callout>
        @endif

        @if ($errors->any())
            <flux:callout variant="danger" icon="exclamation-circle">
                {{ $errors->first() }}
            </flux:callout>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input
                    type="email"
                    name="email"
                    id="email"
                    icon="envelope"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
            </flux:field>

            <flux:field>
                <flux:label>Password</flux:label>
                <flux:input
                    type="password"
                    name="password"
                    id="password"
                    icon="lock-closed"
                    placeholder="Masukkan password"
                    required
                />
            </flux:field>

            <flux:button type="submit" variant="primary" class="w-full" icon="arrow-right-end-on-rectangle">
                Login
            </flux:button>
        </form>


    </div>
</x-layouts::auth.simple>