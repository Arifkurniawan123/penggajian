<?php

namespace App\Http\Validation\Departement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartementRequest extends FormRequest
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
        // Ambil {departement} dari parameter route, supaya unique-check
        // mengabaikan data milik departement yang sedang di-edit sendiri.
        $departementId = $this->route('departement');

        return [
            'nama_departement' => [
                'required',
                'string',
                'max:100',
                Rule::unique('departement', 'nama_departement')->ignore($departementId),
            ],
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
            'nama_departement.max'      => 'Nama departement maksimal 255 karakter.',
            'nama_departement.unique'   => 'Nama departement ini sudah ada.',
        ];
    }
}