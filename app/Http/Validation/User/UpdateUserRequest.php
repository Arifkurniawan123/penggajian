<?php

namespace App\Http\Validation\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        // Ambil {user} dari parameter route, supaya unique-check
        // mengabaikan data milik user yang sedang di-edit sendiri.
        $userId = $this->route('user');

        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            // Password opsional saat update, hanya divalidasi jika diisi.
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }

    /**
     * Pesan error custom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Nama wajib diisi.',
            'name.string'    => 'Nama harus berupa teks.',
            'name.max'       => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah terdaftar.',

            'password.min'   => 'Password minimal 6 karakter.',
        ];
    }
}