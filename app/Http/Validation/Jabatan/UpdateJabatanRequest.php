<?php

namespace App\Http\Validation\Jabatan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJabatanRequest extends FormRequest
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
        // Ambil {jabatan} dari parameter route, supaya unique-check
        // mengabaikan data milik jabatan yang sedang di-edit sendiri.
        $jabatanId = $this->route('jabatan');

        return [
            'nama_jabatan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jabatan', 'nama_jabatan')->ignore($jabatanId),
            ],
        ];
    }

    /**
     * Pesan error custom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.string'   => 'Nama jabatan harus berupa teks.',
            'nama_jabatan.max'      => 'Nama jabatan maksimal 255 karakter.',
            'nama_jabatan.unique'   => 'Nama jabatan ini sudah ada.',
        ];
    }
}