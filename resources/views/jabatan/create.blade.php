<x-layouts::app :title="$title">
    <div class="max-w-xl space-y-6">

        <div>
            <flux:heading size="xl">Tambah Jabatan</flux:heading>
            <flux:text class="mt-1">Isi nama jabatan baru.</flux:text>
        </div>

        <form action="{{ route('jabatan.store') }}" method="POST" class="space-y-4">
            @csrf

            <flux:field>
                <flux:label>Nama Jabatan</flux:label>
                <flux:input name="nama_jabatan" value="{{ old('nama_jabatan') }}" placeholder="Contoh: Staff IT" />
                <flux:error name="nama_jabatan" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan
                </flux:button>
                <flux:button href="{{ route('jabatan.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>