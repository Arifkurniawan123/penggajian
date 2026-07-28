<x-layouts::app :title="$title">
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">Data Karyawan</flux:heading>
                <flux:text class="mt-1">Kelola daftar karyawan perusahaan.</flux:text>
            </div>
            <flux:button href="{{ route('karyawan.create') }}" wire:navigate icon="plus" variant="primary">
                Tambah Karyawan
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
                            <th class="px-5 py-3 font-medium">ID</th>
                            <th class="px-5 py-3 font-medium">Nama</th>
                            <th class="px-5 py-3 font-medium">Gender</th>
                            <th class="px-5 py-3 font-medium">Pendidikan</th>
                            <th class="px-5 py-3 font-medium">Departement</th>
                            <th class="px-5 py-3 font-medium">Jabatan</th>
                            <th class="px-5 py-3 font-medium">Lokasi</th>
                            <th class="px-5 py-3 font-medium">Gaji Pokok</th>
                            <th class="px-5 py-3 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($karyawan as $item)
                        <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800/60 transition-colors">
                            <td class="px-5 py-3 text-zinc-500">{{ $item->id_karyawan }}</td>
                            <td class="px-5 py-3 font-medium">{{ $item->nama }}</td>
                            <td class="px-5 py-3">{{ $item->gender }}</td>
                            <td class="px-5 py-3">{{ $item->pendidikan }}</td>
                            <td class="px-5 py-3">{{ $item->departement->nama_departement ?? '-' }}</td>
                            <td class="px-5 py-3">{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="px-5 py-3">{{ $item->lokasi }}</td>
                            <td class="px-5 py-3">Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-center gap-4">
                                    <flux:button size="sm" variant="ghost" icon="pencil" href="{{ route('karyawan.edit', $item->id) }}" wire:navigate>
                                        Edit
                                    </flux:button>
                                    <flux:button
                                        size="sm"
                                        variant="ghost"
                                        icon="trash"
                                        type="button"
                                        class="text-red-500"
                                        onclick="confirmDelete('{{ route('karyawan.destroy', $item->id) }}')">
                                        Hapus
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-5 py-10 text-center text-zinc-400">
                                Belum ada data karyawan
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
                        Menampilkan {{ $karyawan->firstItem() ?? 0 }} - {{ $karyawan->lastItem() ?? 0 }} dari {{ $karyawan->total() }} data
                    </div>
                    <div>
                        {{ $karyawan->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-layouts::app>