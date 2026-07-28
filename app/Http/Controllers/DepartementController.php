<?php

namespace App\Http\Controllers;

use App\Http\Validation\Departement\StoreDepartementRequest;
use App\Http\Validation\Departement\UpdateDepartementRequest;

use App\Models\Departement;

class DepartementController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Departement',
            'departement' => Departement::paginate(10)
        ];

        return view('departement.index', $data);
    }

    public function create()
    {

        $data = ['title' => 'Tambah Departement'];

        return view('departement.create', $data);
    }

    public function store(StoreDepartementRequest $request)
    {

        Departement::create($request->validated());

        return redirect('/departement')->with('success', 'data departement berhasil ditambahkan!');
    }

    public function edit($id)
    {

        $departement = Departement::find($id);

        $data = [
            'title' => 'update Departement',
            'departement' => $departement
        ];

        return view('departement.update', $data);
    }

    public function update(UpdateDepartementRequest $request, $id)
    {

        $departement = Departement::find($id);

        $departement->update($request->validated());

        return redirect('/departement')->with('success', 'data departement berhasil di update!');
    }

    public function destroy($id)
    {

        $departement = Departement::find($id);

        if ($departement->karyawan()->exists()) {
            return redirect('/departement')->with('error', 'Departement tidak bisa dihapus karena masih memiliki karyawan.');
        }

        $departement->delete();

        return redirect('/departement')->with('success', 'data departement berhasil dihapus!');
    }
}
