<div class="space-y-6">

    <flux:heading size="xl">Dashboard</flux:heading>
    <flux:text class="mt-1 mb-4">Ringkasan data karyawan dan penggajian.</flux:text>

    {{-- Kartu Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-5">
            <flux:text class="text-zinc-500">Total Karyawan</flux:text>
            <flux:heading size="lg" class="mt-1">{{ $totalKaryawan }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-5">
            <flux:text class="text-zinc-500">Total Departement</flux:text>
            <flux:heading size="lg" class="mt-1">{{ $totalDepartement }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-5">
            <flux:text class="text-zinc-500">Total Jabatan</flux:text>
            <flux:heading size="lg" class="mt-1">{{ $totalJabatan }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-5">
            <flux:text class="text-zinc-500">Total Penggajian</flux:text>
            <flux:heading size="lg" class="mt-1">{{ $totalPenggajian }}</flux:heading>
        </div>

    </div>

    {{-- Ringkasan gaji dibayar --}}
    <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 p-5">
        <flux:text class="text-zinc-500">Total Gaji Sudah Dibayar (status: lunas)</flux:text>
        <flux:heading size="lg" class="mt-1">
            Rp {{ number_format($totalGajiDibayar, 0, ',', '.') }}
        </flux:heading>
    </div>

    {{-- Tabel Penggajian Terbaru --}}
    <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 overflow-hidden">
        <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-700">
            <flux:heading size="lg">Penggajian Terbaru</flux:heading>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-zinc-500 border-b border-zinc-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-5 py-3 font-medium">Karyawan</th>
                        <th class="px-5 py-3 font-medium">Periode</th>
                        <th class="px-5 py-3 font-medium">Total Gaji</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($penggajianTerbaru as $item)
                        <tr>
                            <td class="px-5 py-3">{{ $item->karyawan->nama ?? '-' }}</td>
                            <td class="px-5 py-3">{{ $item->periode }}</td>
                            <td class="px-5 py-3">Rp {{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <flux:badge :color="$item->status === 'lunas' ? 'green' : 'amber'">
                                    {{ ucfirst($item->status) }}
                                </flux:badge>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-zinc-400">Belum ada data penggajian</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>