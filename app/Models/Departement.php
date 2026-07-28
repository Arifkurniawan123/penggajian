<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departement';
    protected $fillable = ['nama_departement'];

    public function karyawan(){
         return $this->hasMany(Karyawan::class);
    }
}
