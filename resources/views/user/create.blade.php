<x-layouts::app :title="$title">
    <div class="max-w-xl space-y-6">

        <div>
            <flux:heading size="xl">Tambah User</flux:heading>
            <flux:text class="mt-1">Buat akun baru untuk login ke sistem.</flux:text>
        </div>

        <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
            @csrf

            <flux:field>
                <flux:label>Nama</flux:label>
                <flux:input name="name" value="{{ old('name') }}" placeholder="Nama lengkap" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>Password</flux:label>
                <flux:input type="password" name="password" placeholder="Minimal 8 karakter" />
                <flux:error name="password" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan
                </flux:button>
                <flux:button href="{{ route('user.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>