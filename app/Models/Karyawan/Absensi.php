<?php

namespace App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $guarded = [];

    public function karyawan()
    {
    	return $this->belongsTo(\App\Models\Karyawan\Karyawan::class, 'karyawan_id');
    }
}
