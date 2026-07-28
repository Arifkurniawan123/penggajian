<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Departement;
use App\Models\Jabatan;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = [
        'id_karyawan',
        'nama',
        'umur',
        'gender',
        'pengalaman',
        'pendidikan',
        'lokasi',
        'gaji_pokok',
        'departement_id',
        'jabatan_id'
    ];

    public function departement()
    {

        return $this->belongsTo(Departement::class);
    }

    public function jabatan()
    {

        return $this->belongsTo(Jabatan::class);
    }
    public function penggajian()
    {
        return $this->hasMany(Penggajian::class);
    }
}
