<?php

namespace App\Http\Controllers;

use App\Http\Validation\Penggajian\StorePenggajianRequest;
use App\Http\Validation\Penggajian\UpdatePenggajianRequest;

use App\Models\Karyawan;
use App\Models\Penggajian;

class PenggajianController extends Controller
{
    public function index(){

        $data = [
            'title'=> 'Penggajian',
            'penggajian'=>Penggajian::paginate(10)];

        return view('penggajian.index',$data);

    }

    public function create(){

        $data = ['title' =>'Tambah Penggajian',
        'karyawan' => Karyawan::all()];

        return view('penggajian.create',$data);

    }

    public function store(StorePenggajianRequest $request ){

        $validated = $request->validated();

        // Cari data karyawan untuk mengambil gaji pokoknya
        $karyawan = Karyawan::find($validated['karyawan_id']);
        $gaji_pokok = $karyawan ? $karyawan->gaji_pokok : 0;

        // Hitung total gaji otomatis
        $validated['total_gaji'] = ($gaji_pokok + $validated['tunjangan'] + $validated['lembur']) - $validated['potongan_gaji'];

        Penggajian::create($validated);

        return redirect('/penggajian')->with('success','data penggajian berhasil ditambahkan!');

    }

    public function edit($id){

        $penggajian= Penggajian::find($id);

        $data = ['title'=> 'update Penggajian',
        'penggajian'=> $penggajian,
        'karyawan' => Karyawan::all()];

        return view('penggajian.update', $data);

    }

    public function update(UpdatePenggajianRequest $request, $id){

        $penggajian= Penggajian::find($id);

        $validated = $request->validated();

        // Cari data karyawan untuk mengambil gaji pokok terbaru
        $karyawan = Karyawan::find($validated['karyawan_id']);
        $gaji_pokok = $karyawan ? $karyawan->gaji_pokok : 0;

        // Hitung ulang total gaji otomatis saat update
        $validated['total_gaji'] = ($gaji_pokok + $validated['tunjangan'] + $validated['lembur']) - $validated['potongan_gaji'];

        $penggajian-> update($validated);

        return redirect('/penggajian')->with('success','data penggajian berhasil di update!');

    }

    public function destroy($id){

    $penggajian= Penggajian::find($id);

    $penggajian ->delete();

    return redirect('/penggajian')->with('success','data penggajian berhasil dihapus!');



    }

}