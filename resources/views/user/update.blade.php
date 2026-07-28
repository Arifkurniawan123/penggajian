<x-layouts::app :title="$title">
    <div class="max-w-xl space-y-6">

        <div>
            <flux:heading size="xl">Edit User</flux:heading>
            <flux:text class="mt-1">Ubah data user. Kosongkan password kalau tidak ingin menggantinya.</flux:text>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>Nama</flux:label>
                <flux:input name="name" value="{{ old('name', $user->name) }}" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input type="email" name="email" value="{{ old('email', $user->email) }}" />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>Password Baru</flux:label>
                <flux:input type="password" name="password" placeholder="Kosongkan jika tidak diubah" />
                <flux:description>Isi hanya jika ingin mengganti password.</flux:description>
                <flux:error name="password" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan Perubahan
                </flux:button>
                <flux:button href="{{ route('user.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>