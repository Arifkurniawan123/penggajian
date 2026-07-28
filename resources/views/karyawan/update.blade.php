<x-layouts::app :title="$title">
    <div class="max-w-2xl space-y-6">

        <div>
            <flux:heading size="xl">Update Karyawan</flux:heading>
            <flux:text class="mt-1">Ubah data karyawan.</flux:text>
        </div>

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>ID Karyawan</flux:label>
                    <flux:input name="id_karyawan" value="{{ old('id_karyawan', $karyawan->id_karyawan) }}" />
                    <flux:error name="id_karyawan" />
                </flux:field>

                <flux:field>
                    <flux:label>Nama</flux:label>
                    <flux:input name="nama" value="{{ old('nama', $karyawan->nama) }}" />
                    <flux:error name="nama" />
                </flux:field>

                <flux:field>
                    <flux:label>Umur</flux:label>
                    <flux:input type="number" name="umur" value="{{ old('umur', $karyawan->umur) }}" min="17" max="70" />
                    <flux:error name="umur" />
                </flux:field>

                <flux:field>
                    <flux:label>Gender</flux:label>
                    <flux:select name="gender">
                        <option value="">Pilih gender</option>
                        <option value="Laki-laki" @selected(old('gender', $karyawan->gender) === 'Laki-Laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('gender', $karyawan->gender) === 'Perempuan')>Perempuan</option>
                    </flux:select>
                    <flux:error name="gender" />
                </flux:field>

                <flux:field>
                    <flux:label>Pengalaman (tahun)</flux:label>
                    <flux:input type="number" name="pengalaman" value="{{ old('pengalaman', $karyawan->pengalaman) }}" min="0" />
                    <flux:error name="pengalaman" />
                </flux:field>

                <flux:field>
                    <flux:label>Pendidikan</flux:label>
                    <flux:select name="pendidikan">
                        <option value="">Pilih pendidikan</option>
                        @foreach (['SMA/SMK', 'D3', 'S1', 'S2', 'S3'] as $p)
                            <option value="{{ $p }}" @selected(old('pendidikan', $karyawan->pendidikan) === $p)>{{ $p }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="pendidikan" />
                </flux:field>

                <flux:field>
                    <flux:label>Lokasi</flux:label>
                    <flux:input name="lokasi" value="{{ old('lokasi', $karyawan->lokasi) }}" />
                    <flux:error name="lokasi" />
                </flux:field>

                <flux:field>
                    <flux:label>Gaji Pokok</flux:label>
                    <flux:input type="number" name="gaji_pokok" value="{{ old('gaji_pokok', $karyawan->gaji_pokok) }}" min="0" />
                    <flux:error name="gaji_pokok" />
                </flux:field>

                <flux:field>
                    <flux:label>Departement</flux:label>
                    <flux:select name="departement_id">
                        <option value="">Pilih departement</option>
                        @foreach ($departement as $d)
                            <option value="{{ $d->id }}" @selected(old('departement_id', $karyawan->departement_id) == $d->id)>{{ $d->nama_departement }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="departement_id" />
                </flux:field>

                <flux:field>
                    <flux:label>Jabatan</flux:label>
                    <flux:select name="jabatan_id">
                        <option value="">Pilih jabatan</option>
                        @foreach ($jabatan as $j)
                            <option value="{{ $j->id }}" @selected(old('jabatan_id', $karyawan->jabatan_id) == $j->id)>{{ $j->nama_jabatan }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="jabatan_id" />
                </flux:field>
            </div>

            <div class="flex gap-2 pt-2">
                <flux:button type="submit" variant="primary" icon="check">
                    Simpan Perubahan
                </flux:button>
                <flux:button href="{{ route('karyawan.index') }}" wire:navigate>
                    Batal
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>