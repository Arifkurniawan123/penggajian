<?php

namespace App\Http\Validation\Departement;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartementRequest extends FormRequest
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
            'nama_departement' => ['required', 'string', 'max:100', 'unique:departement,nama_departement'],
        ];
    }

    /**
     * Pesan error custom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'nama_departement.required' => 'Nama departement wajib diisi.',
            'nama_departement.string'   => 'Nama departement harus berupa teks.',
            'nama_departement.max'      => 'Nama departement maksimal 100 karakter.',
            'nama_departement.unique'   => 'Nama departement ini sudah ada.',
        ];
    }
}