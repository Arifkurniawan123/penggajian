<?php

namespace App\Http\Controllers;

use App\Http\Validation\Karyawan\StoreKaryawanRequest;
use App\Http\Validation\Karyawan\UpdateKaryawanRequest;

use App\Models\Jabatan;
use App\Models\Departement;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::paginate(10)
        ];

        return view('karyawan.index', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Tambah Karyawan',
            'departement' => Departement::all(),
            'jabatan' => Jabatan::all()
        ];

        return view('karyawan.create', $data);
    }

    public function store(StoreKaryawanRequest $request)
    {

        Karyawan::create($request->validated());

        return redirect('/karyawan')->with('success', 'data karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {

        $karyawan = Karyawan::find($id);

        $data = [
            'title' => 'update Karyawan',
            'karyawan' => $karyawan,
            'departement' => Departement::all(),
            'jabatan' => Jabatan::all()
        ];

        return view('karyawan.update', $data);
    }

    public function update(UpdateKaryawanRequest $request, $id)
    {

        $karyawan = Karyawan::find($id);

        $karyawan->update($request->validated());

        return redirect('/karyawan')->with('success', 'data karyawan berhasil di update!');
    }

    public function destroy($id)
    {

        $karyawan = Karyawan::find($id);

        if ($karyawan->penggajian()->exists()) {
            return redirect('/karyawan')->with('error', 'Karyawan tidak bisa dihapus karena masih memiliki riwayat penggajian.');
        }

        $karyawan->delete();

        return redirect('/karyawan')->with('success', 'data karyawan berhasil dihapus!');
    }
}
