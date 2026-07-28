<?php

namespace App\Http\Validation\Karyawan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKaryawanRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        // Ambil {karyawan} dari parameter route, supaya unique-check
        // mengabaikan data milik karyawan yang sedang di-edit sendiri.
        $karyawanId = $this->route('karyawan');

        return [
            'id_karyawan'    => [
                'required',
                'string',
                'max:50',
                Rule::unique('karyawan', 'id_karyawan')->ignore($karyawanId),
            ],
            'nama'           => ['required', 'string', 'max:100'],
            'umur'           => ['required', 'integer', 'min:15', 'max:100'],
            'gender'         => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'pengalaman'     => ['required', 'integer', 'min:0'],
            'pendidikan'     => ['required', 'string', 'max:100'],
            'lokasi'         => ['required', 'string', 'max:100'],
            'gaji_pokok'     => ['required', 'numeric', 'min:0'],
            'departement_id' => ['required', 'integer', 'exists:departement,id'],
            'jabatan_id'     => ['required', 'integer', 'exists:jabatan,id'],
        ];
    }

    /**
     * Pesan error custom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'id_karyawan.required'    => 'ID karyawan wajib diisi.',
            'id_karyawan.unique'      => 'ID karyawan ini sudah digunakan.',
            'id_karyawan.max'         => 'ID karyawan maksimal 50 karakter.',

            'nama.required'           => 'Nama wajib diisi.',
            'nama.string'             => 'Nama harus berupa teks.',
            'nama.max'                => 'Nama maksimal 100 karakter.',

            'umur.required'           => 'Umur wajib diisi.',
            'umur.integer'            => 'Umur harus berupa angka.',
            'umur.min'                => 'Umur minimal 15 tahun.',
            'umur.max'                => 'Umur maksimal 100 tahun.',

            'gender.required'         => 'Jenis kelamin wajib diisi.',
            'gender.in'               => 'Jenis kelamin harus Laki-laki atau Perempuan.',

            'pengalaman.required'     => 'Pengalaman wajib diisi.',
            'pengalaman.integer'      => 'Pengalaman harus berupa angka.',
            'pengalaman.min'          => 'Pengalaman tidak boleh kurang dari 0.',

            'pendidikan.required'     => 'Pendidikan wajib diisi.',
            'pendidikan.max'          => 'Pendidikan maksimal 100 karakter.',

            'lokasi.required'         => 'Lokasi wajib diisi.',
            'lokasi.max'              => 'Lokasi maksimal 100 karakter.',

            'gaji_pokok.required'     => 'Gaji pokok wajib diisi.',
            'gaji_pokok.numeric'      => 'Gaji pokok harus berupa angka.',
            'gaji_pokok.min'          => 'Gaji pokok tidak boleh kurang dari 0.',

            'departement_id.required' => 'Departement wajib dipilih.',
            'departement_id.exists'   => 'Departement yang dipilih tidak valid.',

            'jabatan_id.required'     => 'Jabatan wajib dipilih.',
            'jabatan_id.exists'       => 'Jabatan yang dipilih tidak valid.',
        ];
    }
}