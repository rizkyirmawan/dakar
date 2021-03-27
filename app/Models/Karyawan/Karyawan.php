<?php

namespace App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $guarded = [];

    public function user()
    {
    	return $this->morphOne(\App\Models\Auth\User::class, 'userable');
    }

    public function bank()
    {
    	return $this->belongsTo(\App\Models\Master\Bank::class);
    }

    public function bagian()
    {
    	return $this->belongsTo(\App\Models\Master\Bagian::class, 'bagian_id');
    }

    public function absensi()
    {
        return $this->hasMany(\App\Models\Karyawan\Absensi::class);
    }

    public function slipGaji()
    {
        return $this->hasMany(\App\Models\Karyawan\SlipGaji::class);
    }
}
