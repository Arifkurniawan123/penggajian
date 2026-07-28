<?php

namespace App\Http\Validation\Penggajian;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggajianRequest extends FormRequest
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
            'karyawan_id'        => ['required', 'integer', 'exists:karyawan,id'],
            'periode'            => ['required', 'string', 'max:20'],
            'tunjangan'          => ['required', 'numeric', 'min:0'],
            'lembur'             => ['required', 'numeric', 'min:0'],
            'potongan_gaji'      => ['required', 'numeric', 'min:0'],
            'tanggal_bayar'      => ['required', 'date'],
            'metode_pembayaran'  => ['required', 'string', 'in:Transfer,Cash'],
            'status'             => ['required', 'string', 'in:Belum Dibayar,Lunas'],
        ];
    }

    /**
     * Pesan error custom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'karyawan_id.required'       => 'Karyawan wajib dipilih.',
            'karyawan_id.exists'         => 'Karyawan yang dipilih tidak valid.',

            'periode.required'           => 'Periode wajib diisi.',
            'periode.max'                => 'Periode maksimal 20 karakter.',

            'tunjangan.required'         => 'Tunjangan wajib diisi.',
            'tunjangan.numeric'          => 'Tunjangan harus berupa angka.',
            'tunjangan.min'              => 'Tunjangan tidak boleh kurang dari 0.',

            'lembur.required'            => 'Lembur wajib diisi.',
            'lembur.numeric'             => 'Lembur harus berupa angka.',
            'lembur.min'                 => 'Lembur tidak boleh kurang dari 0.',

            'potongan_gaji.required'     => 'Potongan gaji wajib diisi.',
            'potongan_gaji.numeric'      => 'Potongan gaji harus berupa angka.',
            'potongan_gaji.min'          => 'Potongan gaji tidak boleh kurang dari 0.',

            'tanggal_bayar.required'     => 'Tanggal bayar wajib diisi.',
            'tanggal_bayar.date'         => 'Tanggal bayar harus berupa tanggal yang valid.',

            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in'       => 'Metode pembayaran yang dipilih tidak valid.',

            'status.required'            => 'Status wajib dipilih.',
            'status.in'                  => 'Status yang dipilih tidak valid.',
        ];
    }
}