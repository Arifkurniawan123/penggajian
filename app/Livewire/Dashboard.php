<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Karyawan;
use App\Models\Departement;
use App\Models\Jabatan;
use App\Models\Penggajian;

class Dashboard extends Component
{
    // === Tentukan layout di sini ===
    protected $layout = 'layouts.app';

    public function render()
    {
        // Ambil data statistik
        $totalKaryawan     = Karyawan::count();
        $totalDepartement  = Departement::count();
        $totalJabatan      = Jabatan::count();
        $totalPenggajian   = Penggajian::count();
        $totalGajiDibayar  = Penggajian::where('status', 'lunas')->sum('total_gaji');

        // 5 data penggajian terbaru
        $penggajianTerbaru = Penggajian::with('karyawan')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'totalKaryawan'      => $totalKaryawan,
            'totalDepartement'   => $totalDepartement,
            'totalJabatan'       => $totalJabatan,
            'totalPenggajian'    => $totalPenggajian,
            'totalGajiDibayar'   => $totalGajiDibayar,
            'penggajianTerbaru'  => $penggajianTerbaru,
        ]);
    }
}