<x-layouts::app :title="$title">
    <div class="max-w-xl space-y-6">

        <div>
            <flux:heading size="xl">Update Jabatan</flux:heading>
            <flux:text class="mt-1">Ubah nama jabatan.</flux:text>
        </div>

        <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>Nama Jabatan</flux:label>
                <flux:input name="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" />
                <flux:error name="nama_jabatan" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan Perubahan
                </flux:button>
                <flux:button href="{{ route('jabatan.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>