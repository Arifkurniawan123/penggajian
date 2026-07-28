<x-layouts::app :title="$title">
    <div class="max-w-xl space-y-6">

        <div>
            <flux:heading size="xl">Update Departement</flux:heading>
            <flux:text class="mt-1">Ubah nama departement.</flux:text>
        </div>

        <form action="{{ route('departement.update', $departement->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>Nama Departement</flux:label>
                <flux:input name="nama_departement" value="{{ old('nama_departement', $departement->nama_departement) }}" />
                <flux:error name="nama_departement" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan Perubahan
                </flux:button>
                <flux:button href="{{ route('departement.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>