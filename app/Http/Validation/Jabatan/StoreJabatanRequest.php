<?php

namespace App\Http\Validation\Jabatan;

use Illuminate\Foundation\Http\FormRequest;

class StoreJabatanRequest extends FormRequest
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
        return [
            'nama_jabatan' => ['required', 'string', 'max:100', 'unique:jabatan,nama_jabatan'],
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
            'nama_jabatan.max'      => 'Nama jabatan maksimal 100 karakter.',
            'nama_jabatan.unique'   => 'Nama jabatan ini sudah ada.',
        ];
    }
}