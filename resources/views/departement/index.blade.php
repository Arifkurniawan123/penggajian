<x-layouts::app :title="$title">
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">Data Departement</flux:heading>
                <flux:text class="mt-1">Kelola daftar departement perusahaan.</flux:text>
            </div>
            <flux:button href="{{ route('departement.create') }}" wire:navigate icon="plus" variant="primary">
                Tambah Departement
            </flux:button>
        </div>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">
                {{ session('success') }}
            </flux:callout>
        @endif

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-zinc-500 border-b border-zinc-200 dark:border-zinc-700">
                        <tr>
                            <th class="px-5 py-3 font-medium">No</th>
                            <th class="px-5 py-3 font-medium">Nama Departement</th>
                            <th class="px-5 py-3 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($departement as $item)
                            <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800/60 transition-colors">
                                <td class="px-5 py-3 text-zinc-500">
                                    {{ $loop->iteration + ($departement->currentPage() - 1) * $departement->perPage() }}
                                </td>
                                <td class="px-5 py-3 font-medium">{{ $item->nama_departement }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex justify-center gap-4">
                                        <flux:button size="sm" variant="ghost" icon="pencil" href="{{ route('departement.edit', $item->id) }}" wire:navigate>
                                            Edit
                                        </flux:button>
                                        <!-- ======================== -->
                                        <!-- BARIS INI YANG DIPERBAIKI -->
                                        <flux:button 
                                            size="sm" 
                                            variant="ghost" 
                                            icon="trash" 
                                            type="button" 
                                            class="text-red-500"
                                            onclick="confirmDelete('{{ route('departement.destroy', $item->id) }}')">
                                            Hapus
                                        </flux:button>
                                        <!-- ======================== -->
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-10 text-center text-zinc-400">
                                    Belum ada data departement
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="px-5 py-4 border-t border-zinc-200 dark:border-zinc-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-sm text-zinc-500">
                    Menampilkan {{ $departement->firstItem() ?? 0 }} - {{ $departement->lastItem() ?? 0 }} dari {{ $departement->total() }} data
                </div>
                <div>
                    {{ $departement->links() }}
                </div>
            </div>
        </div>

    </div>
</x-layouts::app>