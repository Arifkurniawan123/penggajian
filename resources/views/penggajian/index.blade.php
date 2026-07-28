<x-layouts::app :title="$title">
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">Data Penggajian</flux:heading>
                <flux:text class="mt-1">Kelola data penggajian karyawan.</flux:text>
            </div>
            <flux:button href="{{ route('penggajian.create') }}" wire:navigate icon="plus" variant="primary">
                Tambah Penggajian
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
                            <th class="px-5 py-3 font-medium">Karyawan</th>
                            <th class="px-5 py-3 font-medium">Periode</th>
                            <th class="px-5 py-3 font-medium">Total Gaji</th>
                            <th class="px-5 py-3 font-medium">Tanggal Bayar</th>
                            <th class="px-5 py-3 font-medium">Metode</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($penggajian as $item)
                        <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800/60 transition-colors">
                            <td class="px-5 py-3 font-medium">{{ $item->karyawan->nama ?? '-' }}</td>
                            <td class="px-5 py-3">{{ $item->periode }}</td>
                            <td class="px-5 py-3">Rp {{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">{{ $item->tanggal_bayar }}</td>
                            <td class="px-5 py-3">{{ $item->metode_pembayaran }}</td>
                            <td class="px-5 py-3">
                                <flux:badge :color="$item->status === 'lunas' ? 'green' : 'amber'" size="sm">
                                    {{ ucfirst($item->status) }}
                                </flux:badge>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-center gap-4">
                                    <flux:button size="sm" variant="ghost" icon="pencil" href="{{ route('penggajian.edit', $item->id) }}" wire:navigate>
                                        Edit
                                    </flux:button>
                                    <flux:button
                                        size="sm"
                                        variant="ghost"
                                        icon="trash"
                                        type="button"
                                        class="text-red-500"
                                        onclick="confirmDelete('{{ route('penggajian.destroy', $item->id) }}')">
                                        Hapus
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-400">
                                Belum ada data penggajian
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <!-- ... isi tabel ... -->
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="px-5 py-4 border-t border-zinc-200 dark:border-zinc-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="text-sm text-zinc-500">
                        Menampilkan {{ $penggajian->firstItem() ?? 0 }} - {{ $penggajian->lastItem() ?? 0 }} dari {{ $penggajian->total() }} data
                    </div>
                    <div>
                        {{ $penggajian->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-layouts::app>