<?php

namespace App\Http\Controllers;

use App\Http\Validation\Jabatan\StoreJabatanRequest;
use App\Http\Validation\Jabatan\UpdateJabatanRequest;
use App\Models\Jabatan;


class JabatanController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => Jabatan::paginate(10)
        ];

        return view('jabatan.index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Jabatan'];

        return view('jabatan.create', $data);
    }

    public function store(StoreJabatanRequest $request)
    {

        Jabatan::create($request->validated());

        return redirect('/jabatan')->with('success', 'data jabatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);

        $data = [
            'title' => 'update Jabatan',
            'jabatan' => $jabatan
        ];

        return view('jabatan.update', $data);
    }

    public function update(UpdateJabatanRequest $request, $id)
    {
        $jabatan = Jabatan::find($id);

        $jabatan->update($request->validated());

        return redirect('/jabatan')->with('success', 'data jabatan berhasil diupdate!');
    }

    public function destroy($id)
    {

        $jabatan = Jabatan::find($id);

        if ($jabatan->karyawan()->exists()) {
            return redirect('/jabatan')->with('error', 'Jabatan tidak bisa dihapus karena masih memiliki karyawan.');
        }

        $jabatan->delete();

        return redirect('/jabatan')->with('success', 'data jabatan berhasil dihapus!');
    }
}
