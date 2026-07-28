<x-layouts::app :title="$title">
    <div class="max-w-2xl space-y-6">

        <div>
            <flux:heading size="xl">Tambah Penggajian</flux:heading>
            <flux:text class="mt-1">Isi data penggajian karyawan.</flux:text>
        </div>

        <form action="{{ route('penggajian.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Karyawan</flux:label>
                    <flux:select name="karyawan_id">
                        <option value="">Pilih karyawan</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}" @selected(old('karyawan_id') == $k->id)>{{ $k->nama }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="karyawan_id" />
                </flux:field>

                <!-- ✅ PERIODE -> type="date" -->
                <flux:field>
                    <flux:label>Periode</flux:label>
                    <flux:input type="date" name="periode" value="{{ old('periode') }}" />
                    <flux:error name="periode" />
                </flux:field>

                <flux:field>
                    <flux:label>Tanggal Bayar</flux:label>
                    <flux:input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar') }}" />
                    <flux:error name="tanggal_bayar" />
                </flux:field>

                <flux:field>
                    <flux:label>Tunjangan</flux:label>
                    <flux:input type="number" name="tunjangan" value="{{ old('tunjangan', 0) }}" min="0" />
                    <flux:error name="tunjangan" />
                </flux:field>

                <flux:field>
                    <flux:label>Lembur</flux:label>
                    <flux:input type="number" name="lembur" value="{{ old('lembur', 0) }}" min="0" />
                    <flux:error name="lembur" />
                </flux:field>

                <flux:field>
                    <flux:label>Potongan Gaji</flux:label>
                    <flux:input type="number" name="potongan_gaji" value="{{ old('potongan_gaji', 0) }}" min="0" />
                    <flux:error name="potongan_gaji" />
                </flux:field>

                <flux:field>
                    <flux:label>Total Gaji</flux:label>
                    <flux:input type="number" name="total_gaji" value="{{ old('total_gaji') }}" min="0" />
                    <flux:error name="total_gaji" />
                </flux:field>

                <flux:field>
                    <flux:label>Metode Pembayaran</flux:label>
                    <flux:select name="metode_pembayaran">
                        <option value="">Pilih metode</option>
                        <option value="Transfer" @selected(old('metode_pembayaran') === 'Transfer')>Transfer</option>
                        <option value="Cash" @selected(old('metode_pembayaran') === 'Cash')>Cash</option>
                    </flux:select>
                    <flux:error name="metode_pembayaran" />
                </flux:field>

                <flux:field>
                    <flux:label>Status</flux:label>
                    <flux:select name="status">
                        <option value="">Pilih status</option>
                        <option value="Belum Dibayar" @selected(old('status') === 'Belum Dibayar')>Belum Dibayar</option>
                        <option value="Lunas" @selected(old('status') === 'Lunas')>Lunas</option>
                    </flux:select>
                    <flux:error name="status" />
                </flux:field>
            </div>

            <div class="flex gap-2 pt-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan
                </flux:button>
                <flux:button href="{{ route('penggajian.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>